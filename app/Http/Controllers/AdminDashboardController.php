<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        $q = PromissoryNote::query()->with('user');

        if ($request->filled('status'))     $q->where('status', $request->status);
        if ($request->filled('department')) $q->where('department', $request->department);
        if ($request->filled('from'))       $q->whereDate('created_at', '>=', $request->date('from'));
        if ($request->filled('to'))         $q->whereDate('created_at', '<=', $request->date('to'));

        $pendingNotes = (clone $q)->where('status', 'pending')->latest()->get();

        $stats = [
            'total'    => PromissoryNote::count(),
            'pending'  => PromissoryNote::where('status','pending')->count(),
            'approved' => PromissoryNote::where('status','approved')->count(),
            'rejected' => PromissoryNote::where('status','rejected')->count(),
        ];

        return view('admin.dashboard', compact('pendingNotes','stats'));
    }

    public function AdminAnalytic()
    {
        $thisTerm = PromissoryNote::where('created_at','>=', now()->startOfQuarter())->count();
        $activeStudents = PromissoryNote::distinct('user_id')->count('user_id');
        $totalAmount = (float) PromissoryNote::sum(DB::raw('COALESCE(amount,0) - COALESCE(down_payment,0)'));
        $decidedLast30 = PromissoryNote::whereIn('status',['approved','rejected'])
            ->where('updated_at','>=', now()->subDays(30))->count();
        $approvedLast30 = PromissoryNote::where('status','approved')
            ->where('updated_at','>=', now()->subDays(30))->count();
        $approvalRate = $decidedLast30 ? round($approvedLast30/$decidedLast30*100) : 0;

        $kpis = compact('thisTerm','activeStudents','totalAmount','approvalRate');

        return view('admin.analytics', compact('kpis'));
    }
}
