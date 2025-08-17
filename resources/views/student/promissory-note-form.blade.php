
@extends('layouts.layout')

@section('content')
    @include('includes.TopNavbar')

    <div class="max-w-4xl mx-auto p-6">
     
        <div x-data="{ show:false }" x-show="show" x-transition
             class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-green-800"
             x-init="$root.addEventListener('mock-submitted', () => { show=true; setTimeout(()=>show=false, 2500) })">
        
        </div>

        <h1 class="text-2xl font-semibold mb-6"> Promissory Note</h1>

        {{-- Student Snapshot (read-only; replace sample with real user fields if you have them) --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 rounded-xl p-4">
            <div>
                <p class="text-sm text-gray-500">Student Name</p>
                <p class="font-medium">{{ auth()->user()->name ?? 'Juan Dela Cruz' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Course</p>
                <p class="font-medium">{{ auth()->user()->course ?? 'BSIT' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Year Level</p>
                <p class="font-medium">{{ auth()->user()->year_level ?? '3rd Year' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">College</p>
                <p class="font-medium">{{ auth()->user()->college ?? 'CCS' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Gender</p>
                <p class="font-medium">{{ auth()->user()->gender ?? 'Male' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ auth()->user()->email ?? 'juan@email.com' }}</p>
            </div>
        </div>

        {{-- PURE FRONTEND FORM (no action/route) --}}
        <form x-data="promissoryForm()" x-on:submit.prevent="submit" class="space-y-8">

            {{-- Financial Details --}}
            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Financial Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Due Date</label>
                        <input type="date" x-model="due_date"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Total Balance (₱)</label>
                        <input type="number" step="0.01" min="0" x-model="total_balance"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="0.00">
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <input id="partial_payment" type="checkbox" x-model="partial"
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="partial_payment" class="text-sm text-gray-700">I will make a partial down payment</label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="partial" x-cloak>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Partial Payment Amount (₱)</label>
                        <input type="number" step="0.01" min="0" x-model="partial_amount"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Partial Payment Status</label>
                        <select x-model="partial_status"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="none">None</option>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                </div>
            </section>

            {{-- Reason for Promissory Note --}}
            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Reason for Promissory Note</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Category</label>
                        <select x-model="reason_category"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="reason1">Reason 1 (e.g., delayed remittance)</option>
                            <option value="reason2">Reason 2 (e.g., family emergency)</option>
                            <option value="others">Others (specify)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-600 mb-1">Explanation</label>
                        <textarea rows="4" x-model="reason_text"
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Briefly explain your situation..."></textarea>
                    </div>
                </div>
            </section>

            {{-- Period --}}
            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Period</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Term</label>
                        <select x-model="term" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Semester</label>
                        <select x-model="semester" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="First Semester">First Semester</option>
                            <option value="Second Semester">Second Semester</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">School Year (YYYY-YYYY)</label>
                        <input type="text" x-model="school_year"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="2025-2026">
                    </div>
                </div>
            </section>

            {{-- Supporting Documents (frontend only) --}}
            <section class="space-y-4" x-data>
                <h2 class="text-lg font-semibold">Supporting Documents (optional)</h2>
                <p class="text-sm text-gray-500">Add up to 6 files (PDF, JPG, PNG, WEBP, max 4MB each).</p>

                <div class="space-y-3">
                    <template x-for="(row, idx) in docs" :key="row.id">
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-3 items-end">
                            <div class="md:col-span-2">
                                <label class="block text-sm text-gray-600 mb-1">Document Type</label>
                                <select x-model="row.type"
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select...</option>
                                    <option value="ID">Valid ID</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Financial">Financial</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-sm text-gray-600 mb-1">File</label>
                                <input type="file"
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-1 flex items-center gap-2">
                                <button type="button" @click="addDoc()"
                                        class="w-full rounded-lg border border-indigo-200 px-3 py-2 text-sm hover:bg-indigo-50">
                                    + Add
                                </button>
                                <button type="button" @click="removeDoc(idx)"
                                        class="w-full rounded-lg border border-red-200 px-3 py-2 text-sm hover:bg-red-50">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </section>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <button type="reset" class="rounded-lg border px-4 py-2 text-sm">Cancel</button>
                <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    Submit Promissory Note
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    {{-- Include Alpine via CDN if your layout doesn’t already load it --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function promissoryForm() {
            return {
                // fields (frontend only)
                due_date: '',
                total_balance: '',
                partial: false,
                partial_amount: '',
                partial_status: 'none',
                reason_category: 'reason1',
                reason_text: '',
                term: '1st',
                semester: 'First Semester',
                school_year: '',
                docs: [{ id: Date.now(), type: '' }],

                addDoc() {
                    if (this.docs.length >= 6) return;
                    this.docs.push({ id: Date.now() + this.docs.length, type: '' });
                },
                removeDoc(i) {
                    if (this.docs.length <= 1) return;
                    this.docs.splice(i, 1);
                },
                submit() {
                    // FRONTEND ONLY: show a toast and print to console
                    window.dispatchEvent(new CustomEvent('mock-submitted'));
                    console.log('Form (frontend only):', {
                        due_date: this.due_date,
                        total_balance: this.total_balance,
                        partial: this.partial,
                        partial_amount: this.partial_amount,
                        partial_status: this.partial_status,
                        reason_category: this.reason_category,
                        reason_text: this.reason_text,
                        term: this.term,
                        semester: this.semester,
                        school_year: this.school_year,
                        docs: this.docs
                    });
                }
            }
        }
    </script>
@endpush