@extends('layouts.layout')
@section('title', 'Login')
@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
   <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md text-center">

     <img src="/images/logo1.png" alt="Logo" class="mx-auto mb-4 w-24 h-24 rounded-full">

     <h2 class="text-xl font-bold">
        <span class="text-black hover:underline hover:text-green-700">My.SPC</span> <span class="text-black">» Sign In</span>
     </h2>

      <form action="{{ route('login.store') }}" class="mt-6 text-left" method="POST">
     @csrf
      <input type="text" name="email" placeholder="Email" 
         class="mt-1 mb-3 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      <input type="password" name="password" placeholder="Password" 
        class="mt-1 mb-3 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      <button type="submit" 
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg mx-auto block">
        Sign In
      </button>
        </form>

        <div class="border-t border-gray-500 my-6"></div>

        <p class="text-sm text-left">
            No account yet? 
            
            <a href="register" class="text-black hover:underline hover:text-green-700">Sign Up here.</a>
        </p>
        <p class="text-sm mt-2 text-left">
            Forgot Password? Email 
            <a href="mailto:spcportal@spc.edu.ph" class="text-black hover:underline hover:text-green-700">spcportal@spc.edu.ph</a>
        </p>
   </div>
 </div>

 <footer class="mt-6 text-center text-sm">
    <a href="#" class="text-green-700 hover:underline">My.SPC</a> · 
    <a href="#" class="text-green-700 hover:underline">St. Peter’s College, Inc.</a>
</footer>
@endsection
