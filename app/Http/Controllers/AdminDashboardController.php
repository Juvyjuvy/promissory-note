<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Models\PromissoryNote; // uncomment when you connect to DB

class AdminDashboardController extends Controller
{
    public function AdminDashboard()
    {
        // Dummy data for testing
        $stats = [
            'total'    => 5,
            'pending'  => 1,
            'approved' => 3,
            'rejected' => 1,
        ];

        $pendingRequests = collect([
            (object)[
                'id'           => 3,
                'note_code'    => 'PN-2024-003',
                'student_name' => 'John Doe',
                'student_no'   => '2021-12345',
                'gender'       => 'Male',
                'department'   => 'Computer Science',
                'amount'       => 7500,
                'reason'       => 'Tuition Fee',
                'submitted_at' => Carbon::parse('2024-01-22 09:45:00'),
            ],
        ]);

        return view('admin.admin-dashboard', compact('stats', 'pendingRequests'));
    }
}

