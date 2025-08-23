<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromissoryNoteController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Always use the web guard explicitly
        $user   = auth('web')->user();
        $userId = auth('web')->id();

        // ✅ If not logged in (or wrong guard), stop here
        if (!$user || !$userId) {
            return redirect()->route('login')->with('error', 'Your session expired. Please log in again.');
        }

        // validate only form fields (we override name/id from Auth)
        $data = $request->validate([
            'gender'         => 'nullable|string|in:Male,Female',
            'department'     => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'year_level'     => 'nullable|string|max:50',
            'amount'         => 'nullable|numeric',
            'reason'         => 'nullable|string|max:255',
            'term'           => 'nullable|string|max:50',
            'academic_year'  => 'nullable|string|max:20',
            'down_payment'   => 'nullable|numeric',
            'due_date'       => 'nullable|date',
            'notes'          => 'nullable|string',
            'attachments.*'  => 'file|max:5120',
        ]);

        // Build Student ID like 2025-01044 (YYYY-#####)
        $year = $user->admission_year
            ?? ($user->created_at ? $user->created_at->format('Y') : now()->format('Y'));
        $generatedId = $year . '-' . str_pad((string) $userId, 5, '0', STR_PAD_LEFT);
        $studentId = $user->student_id ?? $generatedId;

        // attachments -> store paths
        $paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('promissory_attachments', 'public');
            }
        }

        PromissoryNote::create([
            'user_id'       => $userId,
            'student_name'  => $user->fullname,  // you use fullname on registration
            'student_id'    => $studentId,

            'gender'        => $data['gender'] ?? null,
            'department'    => $data['department'] ?? null,
            'phone'         => $data['phone'] ?? null,
            'year_level'    => $data['year_level'] ?? null,
            'amount'        => $data['amount'] ?? null,
            'reason'        => $data['reason'] ?? null,
            'term'          => $data['term'] ?? null,
            'academic_year' => $data['academic_year'] ?? null,
            'down_payment'  => $data['down_payment'] ?? null,
            'due_date'      => $data['due_date'] ?? null,
            'notes'         => $data['notes'] ?? null,
            'attachments'   => $paths,
            'status'        => 'pending',
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Promissory note submitted.');
    }
}
