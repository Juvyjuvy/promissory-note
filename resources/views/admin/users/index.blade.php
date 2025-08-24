@extends('layouts.layout')
@section('title', 'Manage Users')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <div class="px-6 py-4 border-b flex items-center justify-between">
            <h3 class="text-lg font-semibold">User Management</h3>

            <div class="flex gap-3">
                <a href="#"
                   class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:plus"></iconify-icon> Add User
                </a>

                <a href="#"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <iconify-icon icon="mdi:select-multiple"></iconify-icon> Bulk Operations
                </a>

                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900">
                    <iconify-icon icon="mdi:arrow-left"></iconify-icon> Back
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="py-3 px-6 border-b">Name</th>
                        <th class="py-3 px-6 border-b">Email</th>
                        <th class="py-3 px-6 border-b">Student ID</th>
                        <th class="py-3 px-6 border-b">Role</th>
                        <th class="py-3 px-6 border-b">Status</th>
                        <th class="py-3 px-6 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 border-b">John Doe</td>
                        <td class="py-4 px-6 border-b">john.doe@university.edu</td>
                        <td class="py-4 px-6 border-b">2021-12345</td>
                        <td class="py-4 px-6 border-b">Student</td>
                        <td class="py-4 px-6 border-b">
                            <span class="inline-block bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Active</span>
                        </td>
                        <td class="py-4 px-6 border-b">
                            <div class="flex gap-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <iconify-icon icon="mdi:pencil"></iconify-icon>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-800" title="Delete">
                                    <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 border-b">Jane Smith</td>
                        <td class="py-4 px-6 border-b">jane.smith@university.edu</td>
                        <td class="py-4 px-6 border-b">2021-67890</td>
                        <td class="py-4 px-6 border-b">Student</td>
                        <td class="py-4 px-6 border-b">
                            <span class="inline-block bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Active</span>
                        </td>
                        <td class="py-4 px-6 border-b">
                            <div class="flex gap-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <iconify-icon icon="mdi:pencil"></iconify-icon>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-800" title="Delete">
                                    <iconify-icon icon="mdi:trash-can-outline"></iconify-icon>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
