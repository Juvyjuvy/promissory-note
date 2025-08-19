@extends('layouts.layout')

@section('content')

<div class="min-h-screen bg-gray-100 flex flex-col">


    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#660809] ">MY.SPC</h1>
            <p class="text-sm text-[#000000] ">Promissory Note Management System</p>
        </div>

   
        <div class="flex items-center gap-6">
            <button class="relative text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:bell-outline" class="text-2xl"></iconify-icon>
            </button>
            <div class="flex items-center gap-2">
                <iconify-icon icon="mdi:account-circle" class="text-2xl text-gray-700"></iconify-icon>
                <span class="font-medium">Juvy E. Aballe Jr</span>
            </div>
            <button class="text-[#660809]  hover:text-[#000000]  flex items-center gap-1">
                <iconify-icon icon="mdi:logout" class="text-xl"></iconify-icon>
            </button>
        </div>
    </header>


    <main class="p-6 max-w-5xl mx-auto w-full">
       
        <div class="mb-4">
            <a href="{{ url('http://127.0.0.1:8000/student/dashboard') }}" class="flex items-center gap-2 text-[#660809]  hover:text-[#000000] ">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Back to Dashboard
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-6">Submit New Promissory Note</h2>

            <form id="promissoryForm" action="{{ url('promissory-note-submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              
                    <div>
                        <label class="block text-sm font-medium mb-1">Student Name</label>
                        <input type="text" name="student_name" value="John Doe"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600" readonly>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Student ID</label>
                        <input type="text" name="student_id" value="2021-12345"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600" readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Gender</label>
                        <select name="gender" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

         
                    <div>
                        <label class="block text-sm font-medium mb-1">Department</label>
                        <select name="department" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option>Select Department</option>
                            <option>College of Computer Studies</option>
                            <option>College of Education</option>
                            <option>College of Business</option>
                        </select>
                    </div>

               
                    <div>
                        <label class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63 912 345 6789"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

            
                    <div>
                        <label class="block text-sm font-medium mb-1">Year Level</label>
                        <select name="year_level" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option>Select Year</option>
                            <option>1st Year</option>
                            <option>2nd Year</option>
                            <option>3rd Year</option>
                            <option>4th Year</option>
                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-medium mb-1">Amount (₱)</label>
                        <input type="number" name="amount" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

                
                    <div>
                        <label class="block text-sm font-medium mb-1">Reason</label>
                        <select name="reason" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option>Select Reason</option>
                            <option>Tuition Fee</option>
                            <option>Laboratory Fee</option>
                            <option>Other</option>
                        </select>
                    </div>

    
                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                            <option>Select Term</option>
                            <option>1st Term</option>
                            <option>2nd Term</option>
                        </select>
                    </div>

                  
                    <div>
                        <label class="block text-sm font-medium mb-1">Academic Year</label>
                        <input type="text" name="academic_year" value="2023-2024"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

              
                    <div>
                        <label class="block text-sm font-medium mb-1">Down Payment (₱)</label>
                        <input type="number" name="down_payment"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>

               
                    <div>
                        <label class="block text-sm font-medium mb-1">Payment Due Date</label>
                        <input type="date" name="due_date"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600">
                    </div>
                </div>

    
                <div>
                    <label class="block text-sm font-medium mb-1">Additional Notes</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-600"></textarea>
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
        let data = new FormData(form);

        let reviewHTML = "";
        for (let [key, value] of data.entries()) {
            if (key !== "attachments[]") {
                reviewHTML += `<p><strong>${key}:</strong> ${value}</p>`;
            }
        }

        let files = data.getAll('attachments[]');
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
