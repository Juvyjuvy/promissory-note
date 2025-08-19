@extends('layouts.layout')

@section('content')


<div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-8 relative">
        
      
        <button onclick="document.getElementById('loginModal').classList.add('hidden')" 
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            ✖
        </button>

        
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/spc-logo.png') }}" alt="Logo" class="h-16">
        </div>

       
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

        <div class="mt-6 text-center text-sm text-gray-600">
            No account yet? <a href="register" class="text-blue-600 hover:underline">Sign Up here.</a> <br>
            Forgot Password? Email <a href="mailto:spcportal@spc.edu.ph" class="text-blue-600 hover:underline">spcportal@spc.edu.ph</a>
        </div>
    </div>
</div>
@endsection
