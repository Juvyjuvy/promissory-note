@extends('layouts.layout')

    @section('content')
    @include('includes.TopNavbar')

    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Status Tracking</h1>

        {{-- Promissory Note Info (static demo only) --}}
        <div class="mb-6 rounded-xl bg-gray-50 p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Student Name</p>
                <p class="font-medium">{{ auth()->user()->name ?? 'Juan Dela Cruz' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Application ID</p>
                <p class="font-medium">PN-2025-001</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Submitted On</p>
                <p class="font-medium">Aug 17, 2025</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Balance</p>
                <p class="font-medium">₱15,000.00</p>
            </div>
        </div>

        {{-- Status Timeline --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold">Application Status</h2>

            <ol class="relative border-l border-gray-300 ml-4">
                {{-- Step 1: Submitted --}}
                <li class="mb-10 ml-6">
                    <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-green-500 ring-8 ring-white">
                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.172l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <h3 class="font-medium">Submitted</h3>
                    <p class="text-sm text-gray-500">Your promissory note was submitted successfully.</p>
                    <time class="text-xs text-gray-400">Aug 17, 2025, 10:15 AM</time>
                </li>

                {{-- Step 2: Under Review --}}
                <li class="mb-10 ml-6">
                    <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-yellow-500 ring-8 ring-white">
                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 3a7 7 0 100 14A7 7 0 0010 3zM9 9h2v4H9V9zm0-4h2v2H9V5z"/>
                        </svg>
                    </span>
                    <h3 class="font-medium">Under Review</h3>
                    <p class="text-sm text-gray-500">Your application is currently being reviewed by the administrator.</p>
                    <time class="text-xs text-gray-400">Aug 17, 2025, 11:00 AM</time>
                </li>

                {{-- Step 3: Decision --}}
                <li class="ml-6">
                    <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white">
                        <svg class="h-3 w-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4h2v2h-2v-2zm0-8h2v6h-2V6z"/>
                        </svg>
                    </span>
                    <h3 class="font-medium">Decision Pending</h3>
                    <p class="text-sm text-gray-500">You will be notified once a decision has been made.</p>
                </li>
            </ol>
        </div>
    </div>
@endsection
