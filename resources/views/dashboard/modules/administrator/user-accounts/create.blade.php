<x-app-layout title="AstraMC Trucks & Equipments">

    {{-- ── Breadcrumb ──────────────────────────────────────────────────────── --}}
    <div class="mb-5">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard',      'active' => false],
            ['label' => 'Human Resource', 'active' => false],
            ['label' => 'Employees',      'active' => true],
        ]" />
    </div>

    @php
        $styles = [
            'label'    => 'block text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 mb-1',
            'input'    => 'w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 bg-white text-gray-800
                           transition duration-150 focus:outline-none focus:border-blue-500 focus:ring-2
                           focus:ring-blue-100 placeholder:text-gray-300',
            'readonly' => 'w-full px-3 py-2.5 text-sm rounded-lg border border-orange-300 bg-gray-100
                           text-gray-400 font-mono cursor-not-allowed focus:outline-none select-none',
            'compact'  => 'h-8 text-xs',
            'error' => 'border-red-500 text-red-500 text-[10px] mt-0.5 leading-none',
        ];

        $leaveTypes = [
            'vl' => ['label' => 'VL'],
            'sl' => ['label' => 'SL'],
            'bl' => ['label' => 'BL'],
            'el' => ['label' => 'EL'],
            'ml' => ['label' => 'ML'],
            'pl' => ['label' => 'PL'],
        ];

        $workDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp

    {{-- ── FIX 1: previewImage() defined here ─────────────────────────────── --}}
    <script>
        function previewSignature(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const preview     = document.getElementById('profile-preview');
                const placeholder = document.getElementById('signature-placeholder');

                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        // FIX 3: Select-All properly dispatches 'change' so CSS peer state updates
        function toggleAllDays(checked) {
            document.querySelectorAll('.day-checkbox').forEach(cb => {
                if (cb.checked !== checked) {
                    cb.checked = checked;
                    cb.dispatchEvent(new Event('change'));
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const select = document.getElementById("branch-select");

            select.addEventListener("change", function () {
                const selectedValues = Array.from(select.selectedOptions).map(option => option.value);

                console.log(selectedValues); // array of selected branch ids
            });
        });

     function onChangeValue() {
        const select = document.getElementById('selectedValue');
        const selectedOption = select.options[select.selectedIndex];

        if (selectedOption && selectedOption.value !== "") {
            const { employeeId, status, position, company, name } = selectedOption.dataset;

            document.getElementById("employeeInput").value = employeeId;
            document.getElementById("statusValue").textContent = status;
            document.getElementById("positionInput").value = position;
            document.getElementById("companyInput").value = company;
            //default login details
            document.getElementById("employeeName").value = name;
            document.getElementById("employeePass").value = employeeId;
        }
        else {
            document.getElementById("employeeInput").value = "--";
            document.getElementById("statusValue").textContent = "--";
            document.getElementById("positionInput").value = "--";
            document.getElementById("companyInput").value = "--";
            //default login details
            document.getElementById("employeeName").value = "--";
            document.getElementById("employeePass").value = "";
        }
    }
    </script>

    <form action="{{ route('user-accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4"> 

            {{-- ══════════════════════════════════════════════════════════════ --}}
            {{-- Card: Personal Background                                      --}}
            {{-- ══════════════════════════════════════════════════════════════ --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                {{-- ── Header ─────────────────────────────────────────────────────────── --}}
                <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/60">

                    <x-prev-link href="{{ route('user-accounts.index') }}" aria-label="Back to Users Table">
                        <x-prevIcon />
                    </x-prev-link>

                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-orange-50 text-orange-500 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <div>
                            <h1 class="text-sm font-semibold text-gray-800 leading-tight">New User Account</h1>
                            <p class="text-[0.7rem] text-gray-400 mt-0.5">Fill in the details below to create an account</p>
                        </div>
                    </div>

                    <x-badge.status id="statusValue" color="yellow" label="Pending" class="ml-auto" />
                </div>

                {{-- ── Section Label ────────────────────────────────────────────────────── --}}
                <div class="flex items-center gap-3 px-6 pt-6 pb-1">
                    <span class="text-[0.65rem] font-bold uppercase tracking-widest text-gray-400 whitespace-nowrap">
                        User Information
                    </span>
                    <span class="flex-1 h-px bg-orange-200" aria-hidden="true"></span>
                </div>

                {{-- ── Form Body ────────────────────────────────────────────────────────── --}}
                <div class="px-6 py-5">
                    <div class="flex flex-col lg:flex-row gap-6">
                        {{-- ── Left: Fields Grid ──────────────────────────────────────── --}}
                        <div class="flex-1 min-w-0">
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-4 gap-y-4">
                                {{-- Employee Name --}}
                                <div class="flex flex-col gap-1">
                                    <label class="{{ $styles['label'] }}">Employee Name</label>

                                    <x-forms.select-field id="selectedValue" onchange="onChangeValue()" name="employee_name" class="{{ $styles['compact'] }}">
                                        <option value="">Select Employee</option>

                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->employee_id }}"
                                                data-employee-id="{{ $employee->employee_id }}"
                                                data-status="{{ $employee->emp_status }}"
                                                data-position="{{ $employee->position }}"
                                                data-company="{{ $employee->company }}"
                                                data-name="{{ $employee->first_name }} {{ $employee->last_name }}">
                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </x-forms.select-field>
                                </div>

                                {{-- Employee ID (read-only) --}}
                                <div class="flex flex-col gap-1">
                                    <label class="{{ $styles['label'] }}">
                                        Employee ID
                                        <span class="ml-1 text-[0.58rem] font-medium normal-case tracking-normal
                                                    text-blue-500 bg-blue-50 px-1.5 py-0.5 rounded-full">
                                            Auto-generated
                                        </span>
                                    </label>
                                    <input id="employeeInput" type="text" name="employee_id" readonly
                                        class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                                </div>

                                {{-- Position (read-only) --}}
                                <div class="flex flex-col gap-1">
                                    <label class="{{ $styles['label'] }}">
                                        Position
                                        <span class="ml-1 text-[0.58rem] font-medium normal-case tracking-normal
                                                    text-blue-500 bg-blue-50 px-1.5 py-0.5 rounded-full">
                                            Auto-generated
                                        </span>
                                    </label>
                                    <input id="positionInput" input="selected-position" type="text" name="position" readonly
                                        placeholder="—"
                                        class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                                </div>

                                {{-- Role --}}
                                <div class="flex flex-col gap-1">
                                    <label class="{{ $styles['label'] }}">Role</label>
                                    <x-forms.select-field name="role" class="{{ $styles['compact'] }}">
                                        <option value="">Select Role</option>
                                        @foreach($user_roles as $roles)
                                            <option value="{{ $roles->role_id }}">
                                                {{ $roles->role_description }}
                                            </option>
                                        @endforeach
                                    </x-forms.select-field>
                                </div>

                                {{-- Company (multi-select, spans 2 cols) --}}
                                <div class="flex flex-col gap-1 sm:col-span-4">
                                    <label class="{{ $styles['label'] }}">
                                        Company
                                        <span class="ml-1 text-[0.58rem] font-medium normal-case tracking-normal
                                                    text-blue-500 bg-blue-50 px-1.5 py-0.5 rounded-full">
                                            Auto-generated
                                        </span>
                                    </label>
                                    <input id="companyInput" type="text" name="position" value="" readonly
                                        placeholder="—"
                                        class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                                </div>

                                {{-- Branch (spans 2 cols) --}}
                                <div class="flex flex-col gap-1 sm:col-span-4">
                                    <label class="{{ $styles['label'] }}">Branch</label>
                                    <x-forms.select-field
                                        id="branch-select"
                                        name="branch_ids[]"
                                        multiple
                                        class="{{ $styles['compact'] }}"
                                    >
                                        @foreach($branches as $id => $branch)
                                            <option value="{{ $id }}"
                                                @selected(in_array($id, old('branch_ids', [])))>
                                                {{ $branch }}
                                            </option>
                                        @endforeach
                                    </x-forms.select-field>
                                </div>

                            </div>
                        </div>

                        {{-- ── Right: Signature Upload ────────────────────────────────── --}}
                        <div class="w-full lg:w-44 flex-shrink-0">
                            <div class="border border-dashed border-gray-300 rounded-xl p-3 flex flex-col items-center gap-3
                                        bg-gray-50/50 hover:bg-orange-50/30 hover:border-orange-300 transition-colors duration-200">

                                {{-- Preview area --}}
                                <div id="signature-preview-wrapper"
                                    class="w-full h-32 rounded-lg bg-white border border-gray-200 flex items-center justify-center overflow-hidden">
                                    <img id="profile-preview"
                                        src=""
                                        alt="Signature preview"
                                        class="hidden w-full h-full object-contain p-1" />
                                    <span id="signature-placeholder" class="flex flex-col items-center gap-1 text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13.828A4 4 0 019 15H7v-2a4 4 0 012.172-3.586z" />
                                        </svg>
                                        <span class="text-[0.65rem] text-center leading-tight text-gray-400">
                                            No signature<br>uploaded
                                        </span>
                                    </span>
                                </div>

                                {{-- Hidden file input --}}
                                <input type="file"
                                    name="esignature"
                                    id="esignature"
                                    accept="image/*"
                                    class="hidden"
                                    onchange="previewSignature(event)" />

                                {{-- Upload button --}}
                                <button type="button"
                                        onclick="document.getElementById('esignature').click()"
                                        class="w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700
                                            text-white text-xs font-semibold py-2 px-3 rounded-lg
                                            transition-colors duration-150 flex items-center justify-center gap-1.5 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Upload Signature
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /card: personal background --}}


            {{-- ══════════════════════════════════════════════════════════════ --}}
            {{-- Card: Employment Information                                   --}}
            {{-- ══════════════════════════════════════════════════════════════ --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <x-cards.accent-header icon="lock" title="Login Credentials" badge="EMP-RECORD" />
            <div class="px-6 pt-5 pb-6 space-y-6">
                {{-- Section: Tenure --}}
                <div>
                    {{-- <x-cards.section-label label="Tenure" /> --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-3">
                        <div class="flex flex-col gap-1">
                            <label class="{{ $styles['label'] }}">
                                username
                            </label>
                            <input id="employeeName" type="text" name="name"
                                class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                            @error('name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="{{ $styles['label'] }}">
                                password
                            </label>
                            <input id="employeePass" type="password" name="password"
                                class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="{{ $styles['label'] }}">
                                confirm password
                            </label>
                            <input type="password" name="confirm_password"
                                class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                            @error('confirm_password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

            {{-- /card: employment information --}}


            {{-- ── Footer Actions ──────────────────────────────────────────── --}}
            <div class="flex items-center justify-end gap-2 pt-1 pb-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-7 py-2.5 text-sm font-semibold text-white
                               bg-blue-600 rounded-lg shadow-sm shadow-blue-200 transition
                               hover:bg-blue-700 hover:shadow-blue-300 active:scale-[0.98]">
                    Save User Account
                </button>
            </div>
        </div>{{-- /space-y-4 --}}
    </form>

</x-app-layout>
