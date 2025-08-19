<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY.SPC</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-white shadow p-4 flex justify-between items-center">
    <div>
      <h1 class="text-2xl font-bold text-red-700">MY.SPC</h1>
      <p class="text-sm text-gray-600">Promissory Note Management System</p>
    </div>
    <a href="#login" class="bg-red-700 text-white px-4 py-2 rounded-lg shadow hover:bg-red-800 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l4-4m-4 4l4 4m6-4h8" />
      </svg>
      Login
    </a>
  </header>

  <!-- Main Section -->
  <main class="flex flex-col items-center justify-center py-16 px-6">
    <!-- Icon -->
    <div class="bg-red-100 text-red-700 p-4 rounded-full mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>

    <!-- Title -->
    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome to MY.SPC</h2>
    <p class="text-gray-600 mb-10">Data-Driven Promissory Note Management System</p>

    <!-- Feature Cards -->
    <div class="grid md:grid-cols-3 gap-6 w-full max-w-5xl">
      <!-- Student Portal -->
      <div class="bg-red-700 text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-7" />
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2">Student Portal</h3>
        <p class="text-sm mb-4">Submit promissory notes, track status, and manage payments</p>
        <a href="#" class="text-sm underline">Click to learn more →</a>
      </div>

      <!-- Admin Dashboard -->
      <div class="bg-red-700 text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.5 0 4.5-2 4.5-4.5S14.5 3 12 3 7.5 5 7.5 7.5 9.5 12 12 12zm0 0v7m0 0h7m-7 0H5" />
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2">Admin Dashboard</h3>
        <p class="text-sm mb-4">Manage records, approve requests, and handle user accounts</p>
        <a href="#" class="text-sm underline">Click to learn more →</a>
      </div>

      <!-- Analytics & Reports -->
      <div class="bg-red-700 text-white rounded-xl p-6 shadow-lg hover:scale-105 transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17l3-3 4 4 5-5" />
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2">Analytics & Reports</h3>
        <p class="text-sm mb-4">Track trends, demographics, and generate comprehensive reports</p>
        <a href="#" class="text-sm underline">Click to learn more →</a>
      </div>
    </div>
  </main>
</body>
</html>
