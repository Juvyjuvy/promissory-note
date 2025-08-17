@extends('layouts.layout')

@section('content')
@include('includes.TopNavbar')
<div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Payment History Ledger</h1>

        {{-- Student Info Header --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 rounded-xl p-4">
            <div>
                <p class="text-sm text-gray-500">Student Name</p>
                <p class="font-medium">{{ auth()->user()->name ?? 'Juan Dela Cruz' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Course & Year</p>
                <p class="font-medium">{{ auth()->user()->course ?? 'BSIT' }} - {{ auth()->user()->year_level ?? '3rd Year' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">College</p>
                <p class="font-medium">{{ auth()->user()->college ?? 'CCS' }}</p>
            </div>
        </div>

        {{-- Ledger Table --}}
        <div class="overflow-x-auto rounded-lg shadow bg-white">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Reference ID</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3 text-right">Debit (₱)</th>
                        <th scope="col" class="px-6 py-3 text-right">Credit (₱)</th>
                        <th scope="col" class="px-6 py-3 text-right">Balance (₱)</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Row 1 --}}
                    <tr class="border-b">
                        <td class="px-6 py-4">Aug 01, 2025</td>
                        <td class="px-6 py-4">PN-2025-001</td>
                        <td class="px-6 py-4">Promissory Note - Initial Balance</td>
                        <td class="px-6 py-4 text-right">₱15,000.00</td>
                        <td class="px-6 py-4 text-right">—</td>
                        <td class="px-6 py-4 text-right">₱15,000.00</td>
                        <td class="px-6 py-4"><span class="rounded bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">Pending</span></td>
                    </tr>
                    {{-- Row 2 --}}
                    <tr class="border-b">
                        <td class="px-6 py-4">Aug 10, 2025</td>
                        <td class="px-6 py-4">PAY-1001</td>
                        <td class="px-6 py-4">Partial Payment</td>
                        <td class="px-6 py-4 text-right">—</td>
                        <td class="px-6 py-4 text-right">₱7,500.00</td>
                        <td class="px-6 py-4 text-right">₱7,500.00</td>
                        <td class="px-6 py-4"><span class="rounded bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">Posted</span></td>
                    </tr>
                    {{-- Row 3 --}}
                    <tr>
                        <td class="px-6 py-4">Aug 20, 2025</td>
                        <td class="px-6 py-4">PAY-1002</td>
                        <td class="px-6 py-4">Final Payment</td>
                        <td class="px-6 py-4 text-right">—</td>
                        <td class="px-6 py-4 text-right">₱7,500.00</td>
                        <td class="px-6 py-4 text-right">₱0.00</td>
                        <td class="px-6 py-4"><span class="rounded bg-green-100 px-2 py-1 text-xs font-medium text-green-800">Cleared</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Legend --}}
        <div class="mt-6 text-sm text-gray-500">
            <p><span class="inline-block w-3 h-3 rounded bg-yellow-100 mr-1"></span> Pending = Awaiting confirmation</p>
            <p><span class="inline-block w-3 h-3 rounded bg-blue-100 mr-1"></span> Posted = Payment recorded</p>
            <p><span class="inline-block w-3 h-3 rounded bg-green-100 mr-1"></span> Cleared = Fully paid</p>
        </div>
    </div>
@endsection
