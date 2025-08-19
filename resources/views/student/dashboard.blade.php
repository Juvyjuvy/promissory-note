@extends('layouts.layout')

@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- HEADER / NAVBAR -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-red-700">DDPNMINAS</h1>
            <p class="text-sm text-gray-600">Promissory Note Management System</p>
        </div>

        <!-- Right Side (Notification, User, Logout) -->
        <div class="flex items-center gap-6">
            <!-- Notifications -->
            <button class="relative text-gray-700 hover:text-red-700">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>

            <!-- User -->
            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">Juvy E. Aballe Jr</span>
            </div>

            <!-- Logout -->
            <button class="text-red-600 hover:text-red-800 flex items-center gap-1">
                <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
            </button>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="p-6 max-w-6xl mx-auto w-full">

        <!-- Greeting -->
        <h2 class="text-xl font-bold mb-4">Student Portal</h2>

        <!-- Stats Cards (Admin-style icons) -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            
            <!-- Total Notes -->
            <div class="bg-red-600 text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:file-document-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Notes</p>
                        <p class="text-3xl font-bold">3</p>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-yellow-600 text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:clock-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Pending</p>
                        <p class="text-3xl font-bold">2</p>
                    </div>
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-green-600 text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:check-circle-outline" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Approved</p>
                        <p class="text-3xl font-bold">1</p>
                    </div>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="bg-red-800 text-white p-6 rounded-xl shadow flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex rounded-xl bg-white/20 p-3">
                        <iconify-icon icon="mdi:currency-php" class="text-2xl"></iconify-icon>
                    </span>
                    <div>
                        <p class="text-sm/5 opacity-90">Total Amount</p>
                        <p class="text-2xl font-bold">₱15,500</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Promissory Note Button -->
        <div class="mb-6">
            <a href="{{ url('http://127.0.0.1:8000/student/promissory-note-form') }}" 
            class="bg-red-700 hover:bg-red-800 text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                <iconify-icon icon="mdi:plus-circle-outline" class="text-lg"></iconify-icon>
                New Promissory Note
            </a>
        </div>

        <!-- Promissory Notes Table -->
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
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-001</td>
                        <td class="py-2 px-4 border">₱5,000</td>
                        <td class="py-2 px-4 border">Tuition Fee</td>
                        <td class="py-2 px-4 border text-green-600 font-semibold">Approved</td>
                        <td class="py-2 px-4 border">2024-01-15</td>
                        <td class="py-2 px-4 border text-blue-600 cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-002</td>
                        <td class="py-2 px-4 border">₱3,000</td>
                        <td class="py-2 px-4 border">Laboratory Fee</td>
                        <td class="py-2 px-4 border text-yellow-600 font-semibold">Pending</td>
                        <td class="py-2 px-4 border">2024-01-20</td>
                        <td class="py-2 px-4 border text-blue-600 cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">PN-2024-003</td>
                        <td class="py-2 px-4 border">₱7,500</td>
                        <td class="py-2 px-4 border">Tuition Fee</td>
                        <td class="py-2 px-4 border text-yellow-600 font-semibold">Pending</td>
                        <td class="py-2 px-4 border">2024-01-22</td>
                        <td class="py-2 px-4 border text-blue-600 cursor-pointer flex items-center gap-1">
                            <iconify-icon icon="mdi:eye-outline"></iconify-icon> View
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- ICONIFY SCRIPT -->
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

@endsection
