<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PromissoryNote;

class StudentDashboardController extends Controller
{
   public function StudentDashboard()
{
    $notes = PromissoryNote::where('user_id', Auth::id())->latest()->get();

    $total       = $notes->count();
    $pending     = $notes->where('status','pending')->count();
    $approved    = $notes->where('status','approved')->count();
    $totalAmount = $notes->sum(fn($n)=> (float) ($n->amount ?? 0));

    return view('student.dashboard', compact('notes','total','pending','approved','totalAmount'));
}
    public function PromissoryNote()
    {
        return view('student.promissory-notes-form');
    }

    public function StatusTracking()
    {
        return view('student.status-tracking');
    }

    public function PaymentHistory()
    {
        return view('student.payment-history');
    }
}
