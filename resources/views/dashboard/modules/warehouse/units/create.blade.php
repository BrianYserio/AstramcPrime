<x-app-layout title="AstraMC Trucks & Equipments">

    {{-- ── Breadcrumb ──────────────────────────────────────────────────────── --}}
    <div class="mb-5">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard',      'active' => false],
            ['label' => 'Warehouse', 'active' => false],
            ['label' => 'Units',      'active' => true],
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
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                // FIX 2: targets the img by id="profile-preview"
                document.getElementById('profile-preview').src = e.target.result;
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
    </script>

    <form action="{{ route('units.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">

            {{-- ══════════════════════════════════════════════════════════════ --}}
            {{-- Card: Personal Background                                      --}}
            {{-- ══════════════════════════════════════════════════════════════ --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-gray-100">

                    <x-prev-link href="{{ route('units.index') }}" aria-label="Back to Employees">
                        <x-prevIcon />
                    </x-prev-link>

                    <div class="flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <div>
                            <h1 class="text-sm font-semibold text-gray-800 leading-tight">New Units</h1>
                            <p class="text-[0.7rem] text-gray-400">Fill in the details below to add new units</p>
                        </div>
                    </div>

                    <x-badge.status color="yellow" label="Pending" class="ml-auto" />
                </div>

                <div class="flex items-center gap-3 px-6 pt-5 pb-2">
                    <span class="text-[0.68rem] font-bold uppercase tracking-widest text-gray-400">
                        Unit Information
                    </span>
                    <span class="flex-1 h-px bg-orange-200" aria-hidden="true"></span>
                </div>

                <div class="px-6 py-5">
                    <div class="flex flex-col lg:flex-row gap-6">

                        <div class="flex-1">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">

                                <div>
                                    <label class="{{ $styles['label'] }}">
                                        Unit ID
                                        <span class="ml-1 text-[0.6rem] font-normal normal-case tracking-normal text-blue-400 bg-blue-50 px-1.5 py-0.5 rounded">Auto-generated</span>
                                    </label>
                                    <input type="text" name="employee_id" value="{{--  --}}" readonly
                                           class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">Cabin Type</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Cabin Type</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">Unit Type</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Unit Type</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">No. of Wheels</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select No. of Wheels</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">Make</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Make</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>


                                <div>
                                    <label class="{{ $styles['label'] }}">Condition</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Condition</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>


                                <div>
                                    <label class="{{ $styles['label'] }}">Body Type</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Body Type</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>


                                <div>
                                    <label class="{{ $styles['label'] }}">
                                        GVW (Kg)
                                    </label>
                                    <input type="text" name="GVW" value="{{--  --}}"
                                           class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">Horse Power</label>
                                    <x-forms.select-field name="gender" class="{{ $styles['compact'] }}">
                                        <option value="">Select Horse Power</option>

                                        {{-- @foreach($credentials['genders'] as $gender)
                                            <option value="{{ $gender }}"
                                                @selected(old('gender', $employees->gender ?? '') == $gender)>
                                                {{ $gender }}
                                            </option>
                                        @endforeach --}}

                                    </x-forms.select-field>
                                </div>


                                <div>
                                    <label class="{{ $styles['label'] }}">
                                        Prepared By:
                                        <span class="ml-1 text-[0.6rem] font-normal normal-case tracking-normal text-blue-400 bg-blue-50 px-1.5 py-0.5 rounded">Auto-generated from user</span>
                                    </label>
                                    <input type="text" name="employee_id" value="{{--  --}}" readonly
                                           class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                                </div>

                                <div>
                                    <label class="{{ $styles['label'] }}">
                                        Engine Series
                                    </label>
                                    <input type="text" name="Engine" value="{{--  --}}"
                                           class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            {{-- ── Footer Actions ──────────────────────────────────────────── --}}
            <div class="flex items-center justify-end gap-2 pt-1 pb-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-7 py-2.5 text-sm font-semibold text-white
                               bg-blue-600 rounded-lg shadow-sm shadow-blue-200 transition
                               hover:bg-blue-700 hover:shadow-blue-300 active:scale-[0.98]">
                    Save Unit
                </button>
            </div>

        </div>{{-- /space-y-4 --}}

    </form>

</x-app-layout>
