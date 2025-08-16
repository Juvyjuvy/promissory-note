@extends('layouts.layout')

@section('content')

@include('includes.TopNavbar')

    <!-- Main Content -->
    <div class="p-6 max-w-6xl mx-auto">
        <!-- Greeting -->
        <h2 class="text-lg font-bold mb-1">Good morning, Juvy Jr. Aballe!</h2>

        <!-- Section Title -->
        <p class="text-sm text-gray-700 font-medium mb-6">SPC Apps</p>
        <p class="text-sm text-gray-500 font-medium mb-6">Student</p>

        <!-- App Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <a href="promissory-note-form" class="bg-white shadow rounded-lg p-6 flex flex-col items-center hover:shadow-lg transition">
                <img src="https://img.icons8.com/ios/100/000000/document--v1.png" alt="Promissory" class="mb-4">
                <p class="text-center font-medium text-sm">Promissory Note Form</p>
            </a>

            <!-- Card 2 -->
            <a href="status-tracking" class="bg-white shadow rounded-lg p-6 flex flex-col items-center hover:shadow-lg transition">
                <img src="https://img.icons8.com/ios/100/000000/combo-chart--v1.png" alt="Status Tracking" class="mb-4">
                <p class="text-center font-medium text-sm">Application Status Tracking</p>
            </a>

            <!-- Card 3 -->
            <a href="payment-history" class="bg-white shadow rounded-lg p-6 flex flex-col items-center hover:shadow-lg transition">
                <img src="https://img.icons8.com/ios/100/000000/bill--v1.png" alt="Digital Ledger" class="mb-4">
                <p class="text-center font-medium text-sm">Payment History Digital Ledger</p>
            </a>
        </div>
    </div>

</body>
</html>
