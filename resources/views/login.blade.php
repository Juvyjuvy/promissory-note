@extends('layouts.layout')

@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809]">MY.SPC</h1>
            <p class="text-sm text-gray-600">Promissory Note Management System</p>
        </div>
        <button onclick="document.getElementById('loginModal').classList.remove('hidden')" 
           class="bg-[#660809] text-white px-4 py-2 rounded-lg shadow hover:bg-[#000000] flex items-center gap-2">
            <iconify-icon icon="mdi:login" class="text-xl"></iconify-icon>
            Login
        </button>
    </header>

    <!-- Main Section -->
    <main class="flex flex-col items-center justify-center py-16 px-6">
        
        <div class=" text-red-700 p-4 rounded-full mb-4">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-16">
        </div>

        <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome to My.SPC</h2>
        <p class="text-gray-600 mb-10">Data-Driven Promissory Note Management System</p>

        <div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">
           
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:school-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Student Portal</h3>
                <p class="text-sm mb-4">Submit promissory notes, track status, and manage payments</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

         
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:shield-account-outline" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Admin Dashboard</h3>
                <p class="text-sm mb-4">Manage records, approve requests, and handle user accounts</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>

            
            <div class="bg-[#660809] text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
                <div class="flex justify-center mb-4">
                    <iconify-icon icon="mdi:chart-line" class="text-4xl"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-2">Analytics & Reports</h3>
                <p class="text-sm mb-4">Track trends, demographics, and generate comprehensive reports</p>
                <a href="#" class="text-sm underline">Click to learn more →</a>
            </div>
        </div>
    </main>

</div>


<!-- LOGIN MODAL -->
<div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-8 relative">
    
        <button onclick="document.getElementById('loginModal').classList.add('hidden')" 
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            ✖
        </button>

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/spc-logo.png') }}" alt="Logo" class="h-16">
        </div>

        <!-- Title -->
        <h2 class="text-center text-xl font-bold text-gray-800 mb-6">My.SPC » Sign In</h2>

        <form class="space-y-4">
            <input type="text" placeholder="Username" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">

            <input type="password" placeholder="Password" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">

            <button type="button" onclick="alert('Front-end only, no backend yet')" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Sign In
            </button>
        </form>

        <!-- Footer Links -->
        <div class="mt-6 text-center text-sm text-gray-600">
            No account yet? <a href="register" class="text-blue-600 hover:underline">Sign Up here.</a> <br>
            Forgot Password? Email <a href="mailto:spcportal@spc.edu.ph" class="text-blue-600 hover:underline">spcportal@spc.edu.ph</a>
        </div>
    </div>
</div>

@endsection
