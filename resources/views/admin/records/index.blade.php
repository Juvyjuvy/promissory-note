@extends('layouts.layout')
@section('title','Manage Records')

@section('content')
@php
    $summary = $summary ?? ['total'=>127, 'archived'=>89, 'recent'=>23];

    $records = $records ?? collect([
        (object)[
            'pn_id' => 'PN-2024-001', 'student_name' => 'John Doe', 'student_id'=>'2021-12345',
            'amount' => 5000, 'status'=>'Approved', 'created_at'=>'2024-01-15', 'updated_at'=>'2024-01-15'
        ],
        (object)[
            'pn_id' => 'PN-2024-002', 'student_name' => 'John Doe', 'student_id'=>'2021-12345',
            'amount' => 3000, 'status'=>'Pending', 'created_at'=>'2024-01-20', 'updated_at'=>'2024-01-20'
        ],
    ]);

    $noteDetails = $noteDetails ?? [];
@endphp

<div class="min-h-screen bg-gray-100" x-data="{ open:false, note:{} }">
    <main class="p-6 max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold">Centralized Record Management</h2>
            <div class="flex items-center gap-3">
                <a href="#" class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:download"></iconify-icon> Export Records
                </a>
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 bg-[#660809] hover:bg-black text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:arrow-left"></iconify-icon> Back
                </a>
            </div>
        </div>

        {{-- Top mini metrics --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-blue-100 text-blue-700">
                    <iconify-icon icon="mdi:database" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Total Records</p>
                    <p class="text-3xl font-bold text-blue-700">{{ $summary['total'] }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-green-100 text-green-700">
                    <iconify-icon icon="mdi:archive-outline" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Archived</p>
                    <p class="text-3xl font-bold text-green-700">{{ $summary['archived'] }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow border p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-orange-100 text-orange-700">
                    <iconify-icon icon="mdi:clock-time-four-outline" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Recent Activity</p>
                    <p class="text-3xl font-bold text-orange-700">{{ $summary['recent'] }}</p>
                </div>
            </div>
        </div>

        {{-- Records table --}}
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <div class="px-6 py-4 bg-[#660809] text-white border-b">
                <h3 class="text-lg font-semibold">All Promissory Note Records</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-700 text-sm">
                        <tr>
                            <th class="py-3 px-6 border-b">Record ID</th>
                            <th class="py-3 px-6 border-b">Student Info</th>
                            <th class="py-3 px-6 border-b">Amount</th>
                            <th class="py-3 px-6 border-b">Status</th>
                            <th class="py-3 px-6 border-b">Date Created</th>
                            <th class="py-3 px-6 border-b">Last Modified</th>
                            <th class="py-3 px-6 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @forelse ($records as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 border-b font-semibold">{{ $r->pn_id }}</td>
                            <td class="py-4 px-6 border-b">
                                <div class="font-medium">{{ $r->student_name }}</div>
                                <div class="text-xs text-gray-500">{{ $r->student_id }}</div>
                            </td>
                            <td class="py-4 px-6 border-b font-semibold text-green-700">
                                ₱{{ number_format((float)$r->amount, 0) }}
                            </td>
                            <td class="py-4 px-6 border-b">
                                @php
                                    $badge = [
                                        'Approved' => 'bg-green-100 text-green-700',
                                        'Pending'  => 'bg-yellow-100 text-yellow-700',
                                        'Rejected' => 'bg-red-100 text-red-700',
                                    ][$r->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="inline-flex items-center text-xs px-3 py-1 rounded-full {{ $badge }}">
                                    {{ $r->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 border-b">{{ $r->created_at }}</td>
                            <td class="py-4 px-6 border-b">{{ $r->updated_at }}</td>
                            <td class="py-4 px-6 border-b">
                                <div class="flex items-center gap-2">
                                    {{-- VIEW --}}
                                    <button
                                        class="w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white"
                                        title="View"
                                        @click="open=true; note={{ json_encode($noteDetails[$r->pn_id] ?? []) }}">
                                        <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                    </button>
                                    <a href="#" class="w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white" title="Archive">
                                        <iconify-icon icon="mdi:archive-arrow-down-outline"></iconify-icon>
                                    </a>
                                    <a href="#" class="w-9 h-9 grid place-items-center rounded-lg bg-[#660809] hover:bg-black text-white" title="Download">
                                        <iconify-icon icon="mdi:download"></iconify-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="7" class="py-8 text-center text-gray-500">No records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- Modal --}}
    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 bg-black/40 grid place-items-center p-4">
        <div x-transition class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b flex items-center justify-between">
                <h3 class="text-2xl font-extrabold text-slate-800">Promissory Note Details</h3>
                <button class="text-slate-600 hover:text-slate-900" @click="open=false">
                    <iconify-icon icon="mdi:close" class="text-2xl"></iconify-icon>
                </button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- left col --}}
                <div>
                    <h4 class="font-semibold text-lg mb-3">Student Information</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2"><span>Name:</span><span class="font-semibold" x-text="note.name"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Student ID:</span><span class="font-semibold" x-text="note.student_id"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Email:</span><span class="font-semibold" x-text="note.email"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Phone:</span><span class="font-semibold" x-text="note.phone"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Gender:</span><span class="font-semibold" x-text="note.gender"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Department:</span><span class="font-semibold" x-text="note.department"></span></div>
                        <div class="flex justify-between"><span>Year Level:</span><span class="font-semibold" x-text="note.year_level"></span></div>
                    </div>
                </div>

                {{-- right col --}}
                <div>
                    <h4 class="font-semibold text-lg mb-3">Promissory Note Details</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2"><span>Note ID:</span><span class="font-semibold" x-text="note.pn_id"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Amount:</span><span class="font-extrabold text-emerald-600">₱<span x-text="Number(note.amount||0).toLocaleString()"></span></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Reason:</span><span class="font-semibold" x-text="note.reason"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Term:</span><span class="font-semibold" x-text="note.term"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Academic Year:</span><span class="font-semibold" x-text="note.acad_year"></span></div>
                        <div class="flex justify-between border-b pb-2"><span>Due Date:</span><span class="font-semibold" x-text="note.due_date ?? 'N/A'"></span></div>
                        <div class="flex justify-between border-b pb-2 items-center">
                            <span>Status:</span>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                                  :class="{
                                      'bg-green-100 text-green-700': note.status === 'Approved',
                                      'bg-yellow-100 text-yellow-700': note.status === 'Pending',
                                      'bg-red-100 text-red-700': note.status === 'Rejected'
                                  }" x-text="note.status">
                            </span>
                        </div>
                        <div class="flex justify-between"><span>Submitted:</span><span class="font-semibold" x-text="note.submitted"></span></div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t flex items-center justify-end gap-3">
                <button class="px-4 py-2 rounded-lg bg-[#660809] hover:bg-black text-white" @click="note.status='Approved'">
                    Approve
                </button>
                <button class="px-4 py-2 rounded-lg bg-[#660809] hover:bg-black text-white" @click="note.status='Rejected'">
                    Reject
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
