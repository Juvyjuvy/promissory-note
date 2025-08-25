@extends('layouts.layout') 
@section('title', 'Admin Dashboard')

@section('content')
@php
    $stats        = $stats        ?? ['total'=>127,'pending'=>23,'approved'=>89,'rejected'=>15];
    $pendingNotes = $pendingNotes ?? collect();
@endphp

<div class="min-h-screen bg-gray-100 flex flex-col">

    {{-- Top Navbar --}}
    <header class="bg-[#660809] text-white px-6 py-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-center">
                <h1 class="text-3xl font-bold">DDPNMINAS</h1>
                <p class="text-sm font-medium text-gray-200">Promissory Note Management System</p>
            </div>

            <div class="flex items-center gap-6">
                <button class="relative hover:text-gray-200" title="Notifications">
                    <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 grid place-items-center">3</span>
                </button>

                <div class="flex items-center gap-2">
                    <iconify-icon icon="mdi:account-circle" class="text-2xl"></iconify-icon>
                    <span class="font-medium">{{ auth()->check() ? (auth()->user()->fullname ?? 'Admin') : 'Admin' }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 hover:text-gray-200" title="Logout">
                        <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Page --}}
    <main class="p-6 max-w-7xl mx-auto w-full">

        {{-- Title + Quick actions --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-3">
            <h2 class="text-3xl font-bold text-gray-800">Administrator/Secretary Dashboard</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.records.index') }}" class="bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg font-medium text-sm inline-flex items-center gap-2">
                    <iconify-icon icon="mdi:folder-open"></iconify-icon> Manage Records
                </a>
                <a href="{{ route('admin.analytics') }}" class="bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg font-medium text-sm inline-flex items-center gap-2">
                    <iconify-icon icon="mdi:chart-bar"></iconify-icon> Analytics
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg font-medium text-sm inline-flex items-center gap-2">
                    <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon> Manage Users
                </a>
                <a href="{{ route('admin.payments.index') }}" class="bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg font-medium text-sm inline-flex items-center gap-2">
                    <iconify-icon icon="mdi:money-check"></iconify-icon> Payment Tracking
                </a>
            </div>
        </div>

        {{-- Stat Cards (maroon theme) --}}
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg">
                <iconify-icon icon="mdi:file-document-outline" class="text-3xl mb-3"></iconify-icon>
                <h3 class="text-lg font-semibold">Total Notes</h3>
                <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg">
                <iconify-icon icon="mdi:clock-outline" class="text-3xl mb-3"></iconify-icon>
                <h3 class="text-lg font-semibold">Pending Review</h3>
                <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
            </div>
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg">
                <iconify-icon icon="mdi:check-circle-outline" class="text-3xl mb-3"></iconify-icon>
                <h3 class="text-lg font-semibold">Approved</h3>
                <p class="text-3xl font-bold">{{ $stats['approved'] }}</p>
            </div>
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow-lg">
                <iconify-icon icon="mdi:close-circle-outline" class="text-3xl mb-3"></iconify-icon>
                <h3 class="text-lg font-semibold">Rejected</h3>
                <p class="text-3xl font-bold">{{ $stats['rejected'] }}</p>
            </div>
        </div>

        {{-- Pending Requests --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white border-b">
                <h3 class="text-xl font-bold">Pending Requests</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Note ID</th>
                            <th class="px-6 py-3 text-left font-semibold">Student Info</th>
                            <th class="px-6 py-3 text-left font-semibold">Department</th>
                            <th class="px-6 py-3 text-left font-semibold">Amount</th>
                            <th class="px-6 py-3 text-left font-semibold">Reason</th>
                            <th class="px-6 py-3 text-left font-semibold">Submitted</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @forelse ($pendingNotes as $note)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">{{ $note->pn_id ?? $note->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold">{{ $note->student_name }}</div>
                                    <div class="text-gray-500 text-xs">{{ $note->student_id }} • {{ $note->gender ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-gray-200 text-gray-800 text-xs px-3 py-1 rounded-full">
                                        {{ $note->department ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format((float)($note->amount ?? 0), 2) }}</td>
                                <td class="px-6 py-4">{{ $note->reason ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div>{{ optional($note->created_at)->toDateString() }}</div>
                                    <div class="text-gray-500 text-xs">{{ optional($note->created_at)->format('n/j/Y, g:i:s A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#660809] hover:bg-black text-white" title="Approve">
                                            <iconify-icon icon="mdi:check"></iconify-icon>
                                        </a>
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#660809] hover:bg-black text-white" title="Reject">
                                            <iconify-icon icon="mdi:close"></iconify-icon>
                                        </a>
                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#660809] hover:bg-black text-white" title="View">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">No pending requests.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
