@extends('layouts.layout')
@section('title', 'Downpayment Tracking')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <main class="p-6 max-w-7xl mx-auto w-full">
        {{-- ===================== Downpayment Tracking ===================== --}}
        @php
            // demo placeholders (para mu-render bisan walay controller data)
            $payments = $payments ?? [
                'total_collected' => 245000,
                'avg_down'        => 52,
                'pending'         => 15,
                'overdue'         => 3,
            ];
            $paymentRows = $paymentRows ?? collect([
                (object)[
                    'pn_id'        => 'PN-2024-001',
                    'student_name' => 'John Doe',
                    'student_id'   => '2021-12345',
                    'total_amount' => 5000,
                    'down_payment' => 2250,
                    'down_rate'    => 45,
                    'remaining'    => 2750,
                    'due_date'     => '2024-03-15',
                    'status'       => 'Overdue',
                ],
                (object)[
                    'pn_id'        => 'PN-2024-004',
                    'student_name' => 'Jane Smith',
                    'student_id'   => '2021-67890',
                    'total_amount' => 4200,
                    'down_payment' => 2310,
                    'down_rate'    => 55,
                    'remaining'    => 1890,
                    'due_date'     => '2024-03-15',
                    'status'       => 'Overdue',
                ],
            ]);
        @endphp

        {{-- Header --}}
        <div class="px-6 py-4 border-b flex items-center justify-between bg-white shadow rounded-xl mb-6">
            <h3 class="text-lg font-semibold">Downpayment Tracking</h3>
            <div class="flex items-center gap-3">
                <a href="#" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:plus"></iconify-icon> Record Payment
                </a>
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900">
                    <iconify-icon icon="mdi:arrow-left"></iconify-icon> Back
                </a>
            </div>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="rounded-xl bg-white border shadow-sm p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-green-100 text-green-700">
                    <iconify-icon icon="mdi:cash-multiple" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Total Collected</p>
                    <p class="text-2xl font-extrabold text-green-700">₱{{ number_format($payments['total_collected'],0) }}</p>
                </div>
            </div>
            <div class="rounded-xl bg-white border shadow-sm p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-blue-100 text-blue-700">
                    <iconify-icon icon="mdi:percent-outline" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Avg Down Payment</p>
                    <p class="text-2xl font-extrabold text-blue-700">{{ $payments['avg_down'] }}%</p>
                </div>
            </div>
            <div class="rounded-xl bg-white border shadow-sm p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-orange-100 text-orange-700">
                    <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Pending Payments</p>
                    <p class="text-2xl font-extrabold text-orange-700">{{ $payments['pending'] }}</p>
                </div>
            </div>
            <div class="rounded-xl bg-white border shadow-sm p-5 flex items-center gap-3">
                <span class="inline-flex rounded-xl p-3 bg-red-100 text-red-700">
                    <iconify-icon icon="mdi:alert-circle-outline" class="text-2xl"></iconify-icon>
                </span>
                <div>
                    <p class="text-sm text-gray-600">Overdue</p>
                    <p class="text-2xl font-extrabold text-red-700">{{ $payments['overdue'] }}</p>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-5 py-3 border-b bg-gray-50">
                <h4 class="font-semibold">Payment Compliance Monitoring</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-50 text-gray-700 text-sm">
                        <tr>
                            <th class="py-3 px-5 border-b">Note ID</th>
                            <th class="py-3 px-5 border-b">Student</th>
                            <th class="py-3 px-5 border-b">Total Amount</th>
                            <th class="py-3 px-5 border-b">Down Payment</th>
                            <th class="py-3 px-5 border-b">Remaining</th>
                            <th class="py-3 px-5 border-b">Due Date</th>
                            <th class="py-3 px-5 border-b">Status</th>
                            <th class="py-3 px-5 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @forelse($paymentRows as $p)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="py-4 px-5 font-medium">{{ $p->pn_id }}</td>
                                <td class="py-4 px-5">
                                    <div class="font-semibold">{{ $p->student_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $p->student_id }}</div>
                                </td>
                                <td class="py-4 px-5 font-semibold">₱{{ number_format($p->total_amount,0) }}</td>
                                <td class="py-4 px-5 text-green-600">
                                    ₱{{ number_format($p->down_payment,0) }} ({{ $p->down_rate }}%)
                                </td>
                                <td class="py-4 px-5 text-orange-600">₱{{ number_format($p->remaining,0) }}</td>
                                <td class="py-4 px-5">{{ $p->due_date }}</td>
                                <td class="py-4 px-5">
                                    <span class="inline-block bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="flex gap-2">
                                        <button class="w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white grid place-items-center">
                                            <iconify-icon icon="mdi:plus"></iconify-icon>
                                        </button>
                                        <button class="w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white grid place-items-center">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </button>
                                        <button class="w-9 h-9 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white grid place-items-center">
                                            <iconify-icon icon="mdi:history"></iconify-icon>
                                        </button>
                                        <button class="w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white grid place-items-center">
                                            <iconify-icon icon="mdi:bell-alert-outline"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-gray-500">No payment rows.</td>
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
