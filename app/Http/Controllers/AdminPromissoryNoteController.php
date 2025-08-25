<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromissoryNote;
use Illuminate\Http\Request;

class PromissoryNoteAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = PromissoryNote::with('user')
            ->when($request->filled('status'), fn($s) => $s->where('status', $request->status))
            ->latest()
            ->paginate(20);

        return view('admin.promissory.index', ['notes' => $q]);
    }

    public function show(PromissoryNote $promissoryNote)
    {
        $promissoryNote->load('user');
        return view('admin.promissory.show', compact('promissoryNote'));
    }

    public function updateStatus(Request $request, PromissoryNote $promissoryNote)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $promissoryNote->update(['status' => $data['status']]);

        return back()->with('success', 'Status updated.');
    }
}
