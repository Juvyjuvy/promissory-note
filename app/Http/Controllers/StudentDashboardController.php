<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class StudentDashboardController extends Controller
{
    public function StudentDashboard()
    {
    return view('student.dashboard');
    }

      public function PromissoryNote()
    {
    return view('student.promissory-note-form');
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
