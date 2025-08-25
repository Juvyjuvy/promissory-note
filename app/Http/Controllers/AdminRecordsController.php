<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;   // 👈 add this
use App\Models\PromissoryNote;
use Illuminate\Support\Facades\Schema;

class AdminRecordsController extends Controller
{
    public function index()
    {
        $hasArchived = Schema::hasColumn('promissory_notes','archived');

        $summary = [
            'total'    => PromissoryNote::count(),
            'archived' => $hasArchived ? PromissoryNote::where('archived', true)->count() : 0,
            'recent'   => PromissoryNote::where('created_at','>=', now()->subDays(30))->count(),
        ];

        $records = PromissoryNote::with('user')->latest()->paginate(20);

        $noteDetails = $records->keyBy('pn_id')->map(function ($n) {
            return [
                'pn_id'      => $n->pn_id,
                'amount'     => (float) ($n->amount ?? 0),
                'reason'     => $n->reason,
                'term'       => $n->term,
                'acad_year'  => $n->academic_year,
                'due_date'   => optional($n->due_date)->toDateString(),
                'status'     => ucfirst($n->status ?? 'pending'),
                'submitted'  => optional($n->created_at)->format('Y-m-d H:i:s'),

                'name'       => $n->student_name,
                'student_id' => $n->student_id,
                'email'      => $n->email,
                'phone'      => $n->phone,
                'gender'     => $n->gender,
                'department' => $n->department,
                'year_level' => $n->year_level,
            ];
        })->toArray();

        return view('admin.records.index', compact('summary','records','noteDetails'));
    }
}
