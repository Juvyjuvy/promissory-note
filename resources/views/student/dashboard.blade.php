@extends('layouts.layout')
@section('title', 'Student Dashboard')

@section('content')
@php
    // safe defaults so view renders even without controller vars
    $total        = $total        ?? 0;
    $pending      = $pending      ?? 0;
    $approved     = $approved     ?? 0;
    $totalAmount  = $totalAmount  ?? 0;
    $notes        = $notes        ?? collect();

    $user = auth()->user();
    $unread = ($user && method_exists($user, 'unreadNotifications'))
        ? $user->unreadNotifications()->count()
        : 0;
@endphp

<div class="min-h-screen bg-gray-100 flex flex-col">

    {{-- Navbar (MY.SPC branding, maroon, hover = black) --}}
    <header class="bg-[#660809] text-white px-6 py-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-center">
                <h1 class="text-3xl font-bold">MY.SPC</h1>
                <p class="text-sm font-medium text-gray-200">Promissory Note Management System</p>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ route('student.notifications') }}"
                   class="relative hover:text-gray-200" title="Notifications">
                    <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                    @if($unread > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 min-w-[20px] px-1 grid place-items-center">
                            {{ $unread }}
                        </span>
                    @endif
                </a>

                <div class="flex items-center gap-2">
                    <iconify-icon icon="mdi:account-circle" class="text-2xl"></iconify-icon>
                    <span class="font-medium">{{ $user->fullname ?? 'Student' }}</span>
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

    <main class="p-6 max-w-7xl mx-auto w-full">

        {{-- flash success --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- page title + action --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
            <h2 class="text-3xl font-bold text-gray-800">Student Dashboard</h2>

            <a href="{{ route('student.promissory-note') }}"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg shadow">
                <iconify-icon icon="mdi:plus-circle-outline" class="text-lg"></iconify-icon>
                New Promissory Note
            </a>
        </div>

        {{-- stats (keep student content, admin color family) --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-[#660809] text-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">{{ $total }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#7a0a0d] text-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending</p>
                        <p class="text-3xl font-bold">{{ $pending }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#8b0b0f] text-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">{{ $approved }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#991010] text-white p-6 rounded-xl shadow">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Amount</p>
                        <p class="text-2xl font-extrabold">₱{{ number_format($totalAmount, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="bg-white shadow rounded-2xl overflow-hidden border">
            <div class="px-6 py-4 bg-[#660809] text-white border-b">
                <h3 class="text-lg font-semibold">My Promissory Notes</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="py-3 px-6 border-b">Note ID</th>
                            <th class="py-3 px-6 border-b">Amount</th>
                            <th class="py-3 px-6 border-b">Reason</th>
                            <th class="py-3 px-6 border-b">Status</th>
                            <th class="py-3 px-6 border-b">Date</th>
                            <th class="py-3 px-6 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @forelse($notes as $note)
                            @php
                                $status = strtolower($note->status ?? 'pending');
                                $badge = [
                                    'approved' => 'bg-green-100 text-green-700',
                                    'pending'  => 'bg-yellow-100 text-yellow-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ][$status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-6 border-b">
                                    PN-{{ str_pad((string)($note->pn_id ?? $note->id ?? 0), 6, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-3 px-6 border-b">₱{{ number_format((float)($note->amount ?? 0), 2) }}</td>
                                <td class="py-3 px-6 border-b">{{ $note->reason ?? '—' }}</td>
                                <td class="py-3 px-6 border-b">
                                    <span class="inline-flex items-center text-xs px-3 py-1 rounded-full {{ $badge }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 border-b">{{ optional($note->created_at)->format('Y-m-d') }}</td>
                                <td class="py-3 px-6 border-b">
                                    <a href="#"
                                       class="inline-flex items-center gap-1 text-white bg-[#660809] hover:bg-black px-3 py-1.5 rounded-md">
                                        <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-6 px-6 border-b text-center text-gray-500" colspan="6">
                                    No promissory notes yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

{{-- Iconify --}}
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
