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
                <span class="font-medium">Admin User</span>
            </div>

            <!-- Logout -->
            <button class="text-[#660809] hover:text-[#000000] flex items-center gap-1" title="Logout">
                <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                Logout
            </button>
        </div>
    </header>


    <main class="p-6 max-w-7xl mx-auto w-full">

        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold">Admin Dashboard</h2>

            <div class="flex gap-3 mt-4 sm:mt-0">
                <a href="analytics"
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
                        <p class="text-3xl font-bold">5</p>
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
                        <p class="text-3xl font-bold">1</p>
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
                        <p class="text-3xl font-bold">3</p>
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
                        <p class="text-3xl font-bold">1</p>
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
                        <!-- Sample row -->
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 border-b font-medium">PN-2024-003</td>

                            <td class="py-4 px-6 border-b">
                                <div class="font-semibold">John Doe</div>
                                <div class="text-gray-500 text-xs">2021-12345 • Male</div>
                            </td>

                            <td class="py-4 px-6 border-b">
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                    Computer Science
                                </span>
                            </td>

                            <td class="py-4 px-6 border-b font-semibold">₱7,500.00</td>
                            <td class="py-4 px-6 border-b">Tuition Fee</td>

                            <td class="py-4 px-6 border-b">
                                <div>2024-01-22</div>
                                <div class="text-gray-500 text-xs">1/22/2024, 9:45:00 AM</div>
                            </td>

                            <td class="py-4 px-6 border-b">
                                <div class="flex items-center gap-2">
                                    <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-600 hover:bg-green-700 text-white" title="Approve">
                                        <iconify-icon icon="mdi:check"></iconify-icon>
                                    </button>

                                    <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-600 hover:bg-red-700 text-white" title="Reject">
                                        <iconify-icon icon="mdi:close"></iconify-icon>
                                    </button>

                                    <button class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 hover:bg-blue-700 text-white" title="View">
                                        <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Placeholder row -->
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500">
                                Add more rows or connect to your backend later.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- ICONIFY -->
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
