@extends('layouts.layout')
@section('title', 'Register')
@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Register</h2>

    @if ($errors->any())
      <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-3 text-sm text-red-700">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="fullname" class="block text-md font-medium text-black">Full Name</label>
        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      </div>

      <div class="mb-4">
        <label for="email" class="block text-md font-medium text-black">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      </div>

      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label for="course" class="block text-md font-medium text-black">Course</label>
          <input type="text" id="course" name="course" value="{{ old('course') }}" required
                 class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
        <div>
          <label for="year_level" class="block text-md font-medium text-black">Year</label>
          <select id="year_level" name="year_level" required
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="" disabled {{ old('year_level') ? '' : 'selected' }}>Select your year</option>
            <option value="1" {{ old('year_level')=='1' ? 'selected' : '' }}>1st Year</option>
            <option value="2" {{ old('year_level')=='2' ? 'selected' : '' }}>2nd Year</option>
            <option value="3" {{ old('year_level')=='3' ? 'selected' : '' }}>3rd Year</option>
            <option value="4" {{ old('year_level')=='4' ? 'selected' : '' }}>4th Year</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label for="college" class="block text-md font-medium text-black">College</label>
          <select id="college" name="college" required
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
            <option value="" disabled {{ old('college') ? '' : 'selected' }}>Select your college</option>
            <option value="College of Arts and Sciences" {{ old('college')=='College of Arts and Sciences' ? 'selected' : '' }}>College of Arts and Sciences</option>
            <option value="College of Engineering" {{ old('college')=='College of Engineering' ? 'selected' : '' }}>College of Engineering</option>
            <option value="College of Business Administration" {{ old('college')=='College of Business Administration' ? 'selected' : '' }}>College of Business Administration</option>
            <option value="College of Education" {{ old('college')=='College of Education' ? 'selected' : '' }}>College of Education</option>
            <option value="College of Computer Studies" {{ old('college')=='College of Computer Studies' ? 'selected' : '' }}>College of Computer Studies</option>
            <option value="College of Criminology" {{ old('college')=='College of Criminology' ? 'selected' : '' }}>College of Criminology</option>
          </select>
        </div>
        <div>
          <label for="gender" class="block text-md font-medium text-black">Gender</label>
          <input type="text" id="gender" name="gender" value="{{ old('gender') }}" required
                 class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
        </div>
      </div>

      <div class="mb-4">
        <label for="password" class="block text-md font-medium text-black">Password</label>
        <input type="password" id="password" name="password" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="block text-md font-medium text-black">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-600 focus:border-green-600 sm:text-sm">
      </div>

      <button type="submit" class="w-full bg-[#660809] text-white py-2 px-4 rounded-md hover:bg-[#000000] focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
        Register
      </button>
    </form>

    <p class="mt-4 text-md text-gray-600 text-center">
      Already have an account? <a href="{{ route('login') }}" class="text-[#660809] hover:underline">Login</a>
    </p>
  </div>
</div>
@endsection
