<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromissoryNoteController extends Controller
{
    public function store(Request $request)
    {
        $user   = auth('web')->user();
        $userId = auth('web')->id();

        if (!$user || !$userId) {
            return redirect()->route('login')->with('error', 'Your session expired. Please log in again.');
        }

        $data = $request->validate([
            'gender'         => 'nullable|string|in:Male,Female',
            'department'     => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'year_level'     => 'nullable|string|max:50',
            'amount'         => 'required|numeric|min:0',
            'reason'         => 'required|string|max:255',
            'term'           => 'required|string|max:50',
            'academic_year'  => 'required|string|max:20', // e.g. 2023-2024
            'down_payment'   => 'nullable|numeric|min:0',
            'due_date'       => 'nullable|date',
            'notes'          => 'nullable|string',
            'attachments'    => 'nullable|array',
            'attachments.*'  => 'file|max:10240',
        ]);

        // Student ID (YYYY-#####) if wala sa profile
        $yearFromUser = $user->admission_year
            ?? ($user->created_at ? $user->created_at->format('Y') : now()->format('Y'));
        $generatedId  = $yearFromUser . '-' . str_pad((string) $userId, 5, '0', STR_PAD_LEFT);
        $studentId    = $user->student_id ?? $generatedId;

        // Upload files → store meta (public disk)
        $filesMeta = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if (!$file) continue;
                $path = $file->store('promissory_attachments', 'public');
                $filesMeta[] = [
                    'original' => $file->getClientOriginalName(),
                    'path'     => $path,
                    'size'     => $file->getSize(),
                    'mime'     => $file->getMimeType(),
                ];
            }
        }

        // Create note with generated PN code guarded by a transaction
        $note = DB::transaction(function () use ($user, $userId, $studentId, $data, $filesMeta) {
            $year = now()->format('Y');

            // get last PN for this year and lock
            $last = DB::table('promissory_notes')
                ->whereYear('created_at', now()->year)
                ->where('pn_id', 'LIKE', "PN-$year-%")
                ->select('pn_id')
                ->orderByDesc('pn_id')
                ->lockForUpdate()
                ->first();

            $seq = 1;
            if ($last && preg_match('/^PN-\d{4}-(\d{3})$/', $last->pn_id, $m)) {
                $seq = (int) $m[1] + 1;
            }
            $pnId = sprintf('PN-%s-%03d', $year, $seq);

            return PromissoryNote::create([
                'user_id'       => $userId,
                'student_name'  => $user->fullname ?? $user->name,
                'student_id'    => $studentId,
                'email'         => $user->email,

                'gender'        => $data['gender'] ?? null,
                'department'    => $data['department'] ?? null,
                'phone'         => $data['phone'] ?? null,
                'year_level'    => $data['year_level'] ?? null,
                'amount'        => $data['amount'],
                'reason'        => $data['reason'],
                'term'          => $data['term'],
                'academic_year' => $data['academic_year'],
                'down_payment'  => $data['down_payment'] ?? null,
                'due_date'      => $data['due_date'] ?? null,
                'notes'         => $data['notes'] ?? null,

                'attachments'   => $filesMeta, // json (cast to array in model)
                'status'        => 'pending',
                'pn_id'         => $pnId,
            ]);
        });

        return redirect()
            ->route('student.dashboard')
            ->with('success', "Promissory note submitted. Your Note ID is {$note->pn_id}.");
    }
}
