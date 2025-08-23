@extends('layouts.layout')
@section('title', 'Student Dashboard')
@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809] ">MY.SPC</h1>
            <p class="text-sm text-[#000000] ">Promissory Note Management System</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="flex items-center gap-6">
                <button class="relative text-[#660809] hover:text-[#000000] ">
                    <a href="{{ route('student.notifications') }}" class="relative text-[#660809] hover:text-[#000000]" title="Notifications">
                       <iconify-icon icon="mdi:bell-outline" class="text-2xl">{{ auth()->user()->unreadNotifications()->count() }}</iconify-icon>
                      
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
                </button>

                <div class="flex items-center gap-2">
                    <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                    <span class="font-medium">{{ auth()->user()->fullname ?? 'Student' }}" </span>
                </div>

                <button type="submit" class="text-[#660809] hover:text-[#000000] flex items-center gap-1">
                    <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                    Logout
                </button>
            </div>
        </form>
    </header>

    <main class="p-6 max-w-6xl mx-auto w-full">

        {{-- Optional flash success after submit --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-bold mb-4">Student Portal</h2>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">{{ $total ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending</p>
                        <p class="text-3xl font-bold">{{ $pending ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">{{ $approved ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#660809]  text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Amount</p>
                        <p class="text-2xl font-bold">₱{{ number_format($totalAmount ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <a href="{{ route('student.promissory-note') }}"
               class="bg-[#660809]  hover:bg-[#000000]  text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                <iconify-icon icon="mdi:plus-circle-outline" class="text-lg"></iconify-icon>
                New Promissory Note
            </a>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">My Promissory Notes</h3>
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">Note ID</th>
                        <th class="py-2 px-4 border">Amount</th>
                        <th class="py-2 px-4 border">Reason</th>
                        <th class="py-2 px-4 border">Status</th>
                        <th class="py-2 px-4 border">Date</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
@forelse($notes as $note)
    <tr>
        <td class="py-2 px-4 border">PN-{{ str_pad($note->pn_id, 6, '0', STR_PAD_LEFT) }}</td>
        <td class="py-2 px-4 border">₱{{ number_format((float)($note->amount ?? 0), 2) }}</td>
        <td class="py-2 px-4 border">{{ $note->reason ?? '—' }}</td>
        <td class="py-2 px-4 border {{ $note->status === 'approved' ? 'text-[#660809]' : 'text-[#000000]' }} font-semibold">
            {{ ucfirst($note->status ?? 'pending') }}
        </td>
        <td class="py-2 px-4 border">{{ optional($note->created_at)->format('Y-m-d') }}</td>
        <td class="py-2 px-4 border text-[#660809] cursor-pointer flex items-center gap-1">
            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
        </td>
    </tr>
@empty
    <tr>
        <td class="py-6 px-4 border text-center text-gray-500" colspan="6">
            No promissory notes yet.
        </td>
    </tr>
@endforelse
</tbody>
            </table>
        </div>
    </main>
</div>

<!-- ICONIFY SCRIPT -->
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

@endsection
