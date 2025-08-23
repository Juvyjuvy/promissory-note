<?php

namespace App\Http\Controllers;

use App\Models\PromissoryNote;
use App\Models\Evaluation;
use App\Notifications\PromissoryNoteEvaluated;
use Illuminate\Http\Request;

class AdminPromissoryNoteController extends Controller
{
    public function approve(PromissoryNote $note)
    {
        $note->update(['status' => 'approved']);

        Evaluation::create([
            'pn_id'        => $note->pn_id,
            'evaluator_id' => auth()->id(),
            'decision'     => 'approved',
            'reason'       => null,
        ]);

        $note->user?->notify(new PromissoryNoteEvaluated($note, 'approved'));

        return back()->with('success', 'Request approved.');
    }

    public function reject(Request $request, PromissoryNote $note)
    {
        $data = $request->validate(['reason' => 'required|string|max:255']);

        $note->update(['status' => 'rejected']);

        Evaluation::create([
            'pn_id'        => $note->pn_id,
            'evaluator_id' => auth()->id(),
            'decision'     => 'rejected',
            'reason'       => $data['reason'],
        ]);

        $note->user?->notify(new PromissoryNoteEvaluated($note, 'rejected', $data['reason']));

        return back()->with('success', 'Request rejected.');
    }
}
