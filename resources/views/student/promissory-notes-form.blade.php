@extends('layouts.layout')

@section('content')
@php
    $u = auth()->user();

    // Build Student ID like 2025-01044 (YYYY-#####)
    $year = $u->admission_year ?? ($u && $u->created_at ? $u->created_at->format('Y') : now()->format('Y'));
    $generatedId = $year . '-' . str_pad((string) ($u->id ?? 0), 5, '0', STR_PAD_LEFT);
    $studentId = $u->student_id ?? $generatedId;
@endphp

<div class="min-h-screen bg-gray-100 flex flex-col">

    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809] ">MY.SPC</h1>
            <p class="text-sm text-[#000000] ">Promissory Note Management System</p>
        </div>
 <form method="POST" action="{{ route('logout') }}">
      @csrf
        <div class="flex items-center gap-6">
            <button class="relative text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
            </button>
            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                {{-- dynamic user name (uses users.fullname) --}}
                <span class="font-medium">{{ $u->fullname ?? 'Student' }}</span>
            </div>
            <button class="text-[#660809]  hover:text-[#000000]  flex items-center gap-1">
                <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
                Logout
            </button>
        </div>
         </form>
    </header>

    <main class="p-6 max-w-5xl mx-auto w-full">

        <div class="mb-4">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 text-[#660809] hover:text-[#000000]">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>

            {{-- MAIN FORM (wraps all inputs, no nested forms) --}}
            <form id="promissoryForm"
                  action="{{ route('promissory-notes.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Student Name (readonly) --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Student Name</label>
                        <input type="text" name="student_name"
                               value="{{ $u->fullname ?? '' }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600" readonly>
                    </div>

                    {{-- Student ID (readonly, format YYYY-#####) --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Student ID</label>
                        <input type="text" name="student_id"
                               value="{{ $studentId }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600" readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Gender</label>
                        <select name="gender" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option value="">Select Gender</option>
                            <option value="Male"   @selected(old('gender')==='Male')>Male</option>
                            <option value="Female" @selected(old('gender')==='Female')>Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Department</label>
                        <select name="department" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option value="">Select Department</option>
                            <option value="College of Computer Studies" @selected(old('department')==='College of Computer Studies')>College of Computer Studies</option>
                            <option value="College of Education"        @selected(old('department')==='College of Education')>College of Education</option>
                            <option value="College of Business"         @selected(old('department')==='College of Business')>College of Business</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63 912 345 6789"
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Year Level</label>
                        <select name="year_level" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option value="">Select Year</option>
                            <option value="1st Year" @selected(old('year_level')==='1st Year')>1st Year</option>
                            <option value="2nd Year" @selected(old('year_level')==='2nd Year')>2nd Year</option>
                            <option value="3rd Year" @selected(old('year_level')==='3rd Year')>3rd Year</option>
                            <option value="4th Year" @selected(old('year_level')==='4th Year')>4th Year</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Amount (₱)</label>
                        <input type="number" name="amount" value="{{ old('amount') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Reason</label>
                        <select name="reason" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option value="">Select Reason</option>
                            <option value="Tuition Fee"     @selected(old('reason')==='Tuition Fee')>Tuition Fee</option>
                            <option value="Laboratory Fee"  @selected(old('reason')==='Laboratory Fee')>Laboratory Fee</option>
                            <option value="Other"           @selected(old('reason')==='Other')>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option value="">Select Term</option>
                            <option value="1st Term" @selected(old('term')==='1st Term')>1st Term</option>
                            <option value="2nd Term" @selected(old('term')==='2nd Term')>2nd Term</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Academic Year</label>
                        <input type="text" name="academic_year"
                               value="{{ old('academic_year','2023-2024') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
                        <input type="number" name="down_payment" value="{{ old('down_payment') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Additional Notes</label>
                    <textarea name="notes" rows="3"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">{{ old('notes') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Upload Supporting Documents</label>
                    <input type="file" name="attachments[]" multiple
                           class="w-full px-4 py-2 border rounded-lg bg-gray-50">
                    <p class="text-xs text-gray-500 mt-1">Attach ID, proof of hardship, etc.</p>
                </div>

                <div class="pt-4">
                    <button type="button" onclick="reviewApplication()"
                            class="bg-[#660809]  hover:bg-[#000000]  text-white px-6 py-2 rounded-lg shadow">
                        Review Application
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- Review Modal (no nested form) --}}
<div id="reviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-6 relative">
        <button onclick="document.getElementById('reviewModal').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✖</button>

        <h3 class="text-lg font-bold mb-4">Review Application</h3>
        <div id="reviewContent" class="space-y-3 text-sm"></div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" onclick="document.getElementById('reviewModal').classList.add('hidden')"
                    class="px-5 py-2 bg-[#660809]  rounded-lg hover:bg-[#000000] text-white">Cancel</button>
            <button type="button" onclick="submitFinal()"
                    class="bg-[#660809]  hover:bg-[#000000] text-white px-6 py-2 rounded-lg">
                Submit
            </button>
        </div>
    </div>
</div>

<!-- ICONIFY SCRIPT -->
<script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>

<script>
    function reviewApplication() {
        const form = document.getElementById('promissoryForm');
        const data = new FormData(form);

        let reviewHTML = "";
        for (let [key, value] of data.entries()) {
            if (key !== "attachments[]") {
                reviewHTML += `<p><strong>${key}:</strong> ${value}</p>`;
            }
        }

        const files = data.getAll('attachments[]');
        if (files.length > 0 && files[0].name) {
            reviewHTML += "<p><strong>Attached Files:</strong></p><ul class='list-disc pl-5'>";
            files.forEach(f => reviewHTML += `<li>${f.name}</li>`);
            reviewHTML += "</ul>";
        }

        document.getElementById('reviewContent').innerHTML = reviewHTML;
        document.getElementById('reviewModal').classList.remove('hidden');
    }

    function submitFinal() {
        document.getElementById('promissoryForm').submit();
    }
</script>

@endsection
