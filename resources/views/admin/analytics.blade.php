@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- PAGE HEADER --}}
    <div class="max-w-7xl mx-auto px-6 pt-6 pb-2 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-3xl font-extrabold text-slate-800">Data Analytics &amp; Reporting</h1>

        <div class="flex items-center gap-3 mt-4 sm:mt-0">
            <a href="#"
               class="inline-flex items-center gap-2 bg-[#660809] hover:bg-[#000000] text-white px-4 py-2 rounded-xl shadow">
                <iconify-icon icon="mdi:download" class="text-lg"></iconify-icon>
                Export Report
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 text-[#660809] hover:text-[#000000] px-3 py-2 rounded-xl">
                <iconify-icon icon="mdi:arrow-left" class="text-lg"></iconify-icon>
                Back to Admin
            </a>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-6 pb-10">

        {{-- KPI CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 mb-6">
            <div class="rounded-2xl shadow bg-[#660809] from-red-800 to-red-600 text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:calendar-month-outline" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">This Term</p>
                        <p class="text-4xl font-extrabold mt-1">5</p>
                        <p class="text-sm mt-2 text-white/90">+12% from last term</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] from-red-800 to-red-600 text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:account-group" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Active Students</p>
                        <p class="text-4xl font-extrabold mt-1">2</p>
                        <p class="text-sm mt-2 text-white/90">With promissory notes</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] from-red-800 to-red-600 text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:cash-multiple" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Total Amount</p>
                        <p class="text-4xl font-extrabold mt-1">₱19,700</p>
                        <p class="text-sm mt-2 text-white/90">Outstanding balance</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl shadow bg-[#660809] from-red-800 to-red-600 text-white p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-white/15 rounded-xl p-3">
                        <iconify-icon icon="mdi:percent-outline" class="text-2xl"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg font-semibold">Approval Rate</p>
                        <p class="text-4xl font-extrabold mt-1">75%</p>
                        <p class="text-sm mt-2 text-white/90">Last 30 days</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHART GRID (placeholders for now) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-2xl bg-white shadow p-6 min-h-[260px]">
                <h3 class="text-xl font-semibold text-slate-800 mb-4">Promissory Notes by Term</h3>
                {{-- <canvas id="chartByTerm"></canvas> --}}
                <div class="h-[180px] rounded-lg bg-gray-50 border border-dashed"></div>
            </div>

            <div class="rounded-2xl bg-white shadow p-6 min-h-[260px]">
                <h3 class="text-xl font-semibold text-slate-800 mb-4">Reasons for Promissory Notes</h3>
                {{-- <canvas id="chartReasons"></canvas> --}}
                <div class="h-[180px] rounded-lg bg-gray-50 border border-dashed"></div>
            </div>

            <div class="rounded-2xl bg-white shadow p-6 min-h-[260px]">
                <h3 class="text-xl font-semibold text-slate-800 mb-4">Monthly Trends</h3>
                {{-- <canvas id="chartMonthly"></canvas> --}}
                <div class="h-[180px] rounded-lg bg-gray-50 border border-dashed"></div>
            </div>

            {{-- DEMOGRAPHICS CARD --}}
            <div class="rounded-2xl bg-white shadow p-6">
                <h3 class="text-xl font-semibold text-slate-800 mb-6">Student Demographics</h3>

                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-700">1st Year Students</span>
                            <span class="text-slate-500">35%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-3 bg-red-600 rounded-full" style="width:35%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-700">2nd Year Students</span>
                            <span class="text-slate-500">28%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-3 bg-red-600 rounded-full" style="width:28%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-700">3rd Year Students</span>
                            <span class="text-slate-500">22%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-3 bg-red-600 rounded-full" style="width:22%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-slate-700">4th Year Students</span>
                            <span class="text-slate-500">15%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-3 bg-red-600 rounded-full" style="width:15%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

{{-- ICONS --}}
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
@endsection
