@extends('layouts.layout') 
@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809]">MY.SPC</h1>
            <p class="text-sm text-[#000000]">Promissory Note Management System</p>
        </div>

        <div class="flex items-center gap-6">
            <button class="relative text-[#660809] hover:text-[#000000]" title="Notifications">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>

            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">{{ auth()->check() ? (auth()->user()->fullname ?? 'Admin') : '' }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1" title="Logout">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="p-6 max-w-7xl mx-auto w-full">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold">Admin Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">
                <a href="{{ route('admin.analytics') }}"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
                   title="View analytics and reports">
                    <iconify-icon icon="mdi:chart-line"></iconify-icon>
                    Analytics
                </a>

                <a href="#"
                   class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-lg shadow"
                   title="Manage user accounts">
                    <iconify-icon icon="mdi:account-multiple-outline"></iconify-icon>
                    Manage Users
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending Review</p>
                        <p class="text-3xl font-bold">{{ $stats['pending'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">{{ $stats['approved'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809] text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:close-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Rejected</p>
                        <p class="text-3xl font-bold">{{ $stats['rejected'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Pending Requests</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm">
                        <tr>
                            <th class="py-3 px-6 border-b">Note ID</th>
                            <th class="py-3 px-6 border-b">Student Info</th>
                            <th class="py-3 px-6 border-b">Department</th>
                            <th class="py-3 px-6 border-b">Amount</th>
                            <th class="py-3 px-6 border-b">Reason</th>
                            <th class="py-3 px-6 border-b">Submitted</th>
                            <th class="py-3 px-6 border-b">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-800">
                        @forelse ($pendingNotes as $note)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 border-b font-medium">{{ $note->pn_id ?? $note->id }}</td>

                                <td class="py-4 px-6 border-b">
                                    <div class="font-semibold">{{ $note->student_name }}</div>
                                    <div class="text-gray-500 text-xs">{{ $note->student_id }} • {{ $note->gender ?? '—' }}</div>
                                </td>

                                <td class="py-4 px-6 border-b">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ $note->department ?? '—' }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 border-b font-semibold">
                                    ₱{{ number_format((float)($note->amount ?? 0), 2) }}
                                </td>

                                <td class="py-4 px-6 border-b">
                                    {{ $note->reason ?? '—' }}
                                </td>

                                <td class="py-4 px-6 border-b">
                                    <div>{{ optional($note->created_at)->toDateString() }}</div>
                                    <div class="text-gray-500 text-xs">
                                        {{ optional($note->created_at)->format('n/j/Y, g:i:s A') }}
                                    </div>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="py-4 px-6 border-b">
                                    <div class="flex items-center gap-2">

                                        <form method="POST" action="{{ route('admin.pn.approve', $note->pn_id ?? $note->id) }}">
                                            @csrf
                                            <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Approve">
                                                <iconify-icon icon="mdi:check"></iconify-icon>
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.pn.reject', $note->pn_id ?? $note->id) }}">
                                            @csrf
                                            <input type="hidden" name="reason" value="Insufficient requirement(s)">
                                            <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Reject">
                                                <iconify-icon icon="mdi:close"></iconify-icon>
                                            </button>
                                        </form>

                                        <a href="#" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">
                                    No pending requests.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
