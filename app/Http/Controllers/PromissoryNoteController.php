<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PromissoryNoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'   => ['required','string','max:255'],
            'student_id'     => ['required','string','max:50'],
            'gender'         => ['nullable', Rule::in(['Male','Female'])],
            'department'     => ['nullable','string','max:255'],
            'phone'          => ['nullable','string','max:30'],
            'year_level'     => ['nullable','string','max:20'],
            'amount'         => ['nullable','numeric','min:0'],
            'reason'         => ['nullable','string','max:255'],
            'term'           => ['nullable','string','max:50'],
            'academic_year'  => ['nullable','string','max:20'],
            'down_payment'   => ['nullable','numeric','min:0'],
            'due_date'       => ['nullable','date'],
            'notes'          => ['nullable','string','max:5000'],
            'attachments'    => ['sometimes','array'],
            'attachments.*'  => ['file','mimes:pdf,jpg,jpeg,png,doc,docx','max:5120'], // 5MB each
        ]);

        // Handle file uploads
        $paths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file && $file->isValid()) {
                    // Store to storage/app/promissory_attachments/{year}/{id}
                    $paths[] = $file->store('promissory_attachments');
                }
            }
        }

        $validated['attachments'] = $paths;

        PromissoryNote::create($validated);

        return back()->with('success', 'Promissory note submitted successfully.');
    }
}