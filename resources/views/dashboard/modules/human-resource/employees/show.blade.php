<x-app-layout title="AstraMC Trucks & Equipments">

{{-- ═══════════════════════════════════════════════════════════════════════════
 |  Employee Profile — Read-Only View
 |  Route:   employees.show
 |  Purpose: Display a single employee's full profile. No data is editable here.
 |           All mutation actions route to employees.edit.
 ══════════════════════════════════════════════════════════════════════════════ --}}

@php
    /**
     * Shared Tailwind class maps.
     * Centralised here so every field inherits the same look without duplication.
     */
    $ui = [
        'label'    => 'block text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 mb-1',
        'field'    => 'w-full px-3 py-2 text-xs rounded-lg border border-orange-200 bg-gray-100
                       text-gray-700 font-mono cursor-not-allowed select-none focus:outline-none',
        'badge'    => 'inline-flex items-center text-[0.6rem] font-semibold px-1.5 py-0.5 rounded',
        'section'  => 'text-[0.68rem] font-bold uppercase tracking-widest text-gray-400',
        'divider'  => 'flex-1 h-px bg-orange-200',
    ];

    /**
     * Leave-type definitions.
     * Extend this array to add new leave categories — no template changes needed.
     */
    $leaveTypes = [
        'vl' => ['label' => 'VL', 'note' => '5 converted to cash'],
        'sl' => ['label' => 'SL'],
        'bl' => ['label' => 'BL'],
        'el' => ['label' => 'EL'],
        'ml' => ['label' => 'ML'],
        'pl' => ['label' => 'PL'],
    ];

    /**
     * Healthcare availment fields.
     * Value keys map to $employees properties; label is the display string.
     */
    $healthcareFields = [
        ['label' => 'Dental',                    'key' => 'dental'],
        ['label' => 'Optical',                   'key' => 'optical'],
        ['label' => 'Medicines',                 'key' => 'medicines',   'note' => 'Balance: ₱8,000.00'],
        ['label' => 'Out-Patient Services',      'key' => 'out_patient'],
        ['label' => 'Hospitalization/Confinement','key' => 'confinement'],
    ];

    /**
     * Government ID fields.
     */
    $govtIds = [
        ['label' => 'Pag-IBIG',   'key' => 'pagibig'],
        ['label' => 'PhilHealth', 'key' => 'philhealth'],
        ['label' => 'SSS',        'key' => 'sss'],
        ['label' => 'TIN',        'key' => 'tin'],
    ];

    /**
     * Work-schedule days. Order reflects ISO week; Sunday sits last.
     */
    $workDays = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
@endphp


{{-- ── Breadcrumb ─────────────────────────────────────────────────────────── --}}
<div class="mb-5">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard',      'active' => false],
        ['label' => 'Human Resource', 'active' => false],
        ['label' => 'Employees',      'active' => true],
    ]" />
</div>


{{-- ═══════════════════════════════════════════════════════════════════════════
 |  Main content wrapper
 ══════════════════════════════════════════════════════════════════════════════ --}}
<div class="space-y-4">


    {{-- ══════════════════════════════════════════════════════════════════════
     |  SECTION 1 — Personal Background
     ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        {{-- Card header --}}
        <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-gray-100">

            <x-prev-link href="{{ route('employees.index') }}" aria-label="Back to Employees">
                <x-prevIcon />
            </x-prev-link>

            <div class="flex items-center gap-2.5">
                <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-500"
                      aria-hidden="true">
                    {{-- Person icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <div>
                    <h1 class="text-sm font-semibold text-gray-800 leading-tight">Imployee Information</h1>
                    <p class="text-[0.7rem] text-gray-400">View-only — all fields are read-only.</p>
                </div>
            </div>

            <x-badge.status color="yellow" label="{{ $employees->emp_status }}" class="ml-auto" />
        </div>

        {{-- Section label --}}
        {{-- <x-section-divider label="Personal Background" :styles="$ui" /> --}}

        <div class="flex items-center gap-3 px-6 pt-5 pb-2">
            <span class="text-[0.68rem] font-bold uppercase tracking-widest text-gray-400">
                Personal Background
            </span>
            <span class="flex-1 h-px bg-orange-200" aria-hidden="true"></span>
        </div>

        {{-- Fields --}}
        <div class="px-6 py-5">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Text fields grid --}}
                <div class="flex-1">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        {{-- Employee ID --}}
                        <div>
                            <label class="{{ $ui['label'] }}">
                                Employee ID
                                <span class="{{ $ui['badge'] }} ml-1 text-[0.6rem] font-normal normal-case tracking-normal text-blue-400 bg-blue-50 px-1.5 py-0.5 rounded">Auto-generated</span>
                            </label>
                            <input type="text" readonly value="{{ $employees->employee_id }}"
                                   class="{{ $ui['field'] }}" aria-label="Employee ID" />
                        </div>

                        @foreach([
                            'First Name'   => $employees->first_name,
                            'Middle Name'  => $employees->middle_name,
                            'Last Name'    => $employees->last_name,
                        ] as $fieldLabel => $fieldValue)
                            <div>
                                <label class="{{ $ui['label'] }}">{{ $fieldLabel }}</label>
                                <input type="text" readonly value="{{ $fieldValue }}"
                                       class="{{ $ui['field'] }}" aria-label="{{ $fieldLabel }}" />
                            </div>
                        @endforeach

                        {{-- Birthdate --}}
                        <div>
                            <label class="{{ $ui['label'] }}">Birthdate</label>
                            <input type="date" readonly value="{{ $employees->birthdate }}"
                                   class="{{ $ui['field'] }}" aria-label="Birthdate" />
                        </div>

                        {{-- Enum-style readonly selects — rendered as text to avoid dropdown UX --}}
                        @foreach([
                            'Gender'       => $employees->gender,
                            'Civil Status' => $employees->civil_status,
                            'Citizenship'  => $employees->citizenship,
                        ] as $enumLabel => $enumValue)
                            <div>
                                <label class="{{ $ui['label'] }}">{{ $enumLabel }}</label>
                                <input type="text" readonly value="{{ $enumValue ?? '—' }}"
                                       class="{{ $ui['field'] }}" aria-label="{{ $enumLabel }}" />
                            </div>
                        @endforeach

                        {{-- Contact & Email --}}
                        <div>
                            <label class="{{ $ui['label'] }}">Contact No.</label>
                            <input type="tel" readonly value="{{ $employees->contact_number }}"
                                   class="{{ $ui['field'] }}" aria-label="Contact Number" />
                        </div>

                        <div>
                            <label class="{{ $ui['label'] }}">Email</label>
                            <input type="email" readonly value="{{ $employees->email }}"
                                   class="{{ $ui['field'] }}" aria-label="Email" />
                        </div>

                        {{-- Address spans 2 columns --}}
                        <div class="sm:col-span-2">
                            <label class="{{ $ui['label'] }}">Complete Address</label>
                            <input type="text" readonly value="{{ $employees->address }}"
                                   class="{{ $ui['field'] }}" aria-label="Complete Address" />
                        </div>

                    </div>
                </div>

                {{-- Profile photo — display only --}}
                <div class="w-full lg:w-48 flex-shrink-0">
                    <div class="border border-orange-200 rounded-lg p-3 flex flex-col items-center bg-gray-50">
                        <img src="{{ $employees->profile_image
                                        ? asset('storage/' . $employees->profile_image)
                                        : asset('assets/img/avatar5.png') }}"
                             class="w-32 h-32 object-cover rounded mb-2"
                             alt="{{ $employees->first_name }} profile photo" />
                        <span class="{{ $ui['field'] }} text-gray-400 bg-gray-100 text-[0.6rem] mt-1">
                            Read-only
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- /personal background --}}


    {{-- ══════════════════════════════════════════════════════════════════════
     |  SECTION 2 — Employment Information
     ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <x-cards.accent-header icon="lock" title="Employment Information" />

        <div class="px-6 pt-5 pb-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-6 gap-4">

                {{-- Scalar employment fields --}}
                @foreach([
                    'Date Hired'         => $employees->date_hired,
                    'Company'            => $employees->company,
                    'Designation'        => $employees->branch,
                    'Level'              => $employees->level,
                    'Position'           => $employees->position,
                    'Sub-Designation'    => $employees->sub_branch,
                    'Status'             => $employees->emp_status,
                    'Date Status'        => $employees->date_status,
                    'Assigned Location'  => $employees->assigned_location,
                ] as $empLabel => $empValue)
                    <div>
                        <label class="{{ $ui['label'] }}">{{ $empLabel }}</label>
                        <input type="text" readonly value="{{ $empValue ?? '—' }}"
                               class="{{ $ui['field'] }}" aria-label="{{ $empLabel }}" />
                    </div>
                @endforeach

                {{-- Leave credits —  3 columns on XL screens --}}
                <div class="xl:col-span-3">
                    <div class="grid grid-cols-6 gap-1">
                        @foreach ($leaveTypes as $key => $leave)
                            <div>
                                <label for="leave_{{ $key }}"
                                       class="text-[10px] font-semibold text-gray-600 uppercase mb-1 block">
                                    {{ $leave['label'] }}
                                </label>
                                <input id="leave_{{ $key }}" type="number" readonly
                                       value="{{ $employees->{'leave_' . $key} ?? 0 }}"
                                       class="w-full px-2 py-1 text-xs border rounded bg-gray-100
                                              border-orange-200 text-gray-500 cursor-not-allowed"
                                       aria-label="{{ $leave['label'] }} leave credits" />
                                @isset($leave['note'])
                                    <span class="{{ $ui['badge'] }} mt-0.5 text-blue-400 bg-blue-50
                                                text-[0.6rem] leading-tight">
                                        {{ $leave['note'] }}
                                    </span>
                                @endisset
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- /employment information --}}


    {{-- ══════════════════════════════════════════════════════════════════════
     |  SECTION 3 — Healthcare Availment
     ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <x-cards.accent-header icon="lock" title="Healthcare Availment" />

        <div class="px-6 pt-5 pb-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-5 gap-4">

                @foreach ($healthcareFields as $hf)
                    <div>
                        <label class="{{ $ui['label'] }}">{{ $hf['label'] }}</label>
                        <input type="text" readonly
                               value="{{ number_format($employees->{$hf['key']} ?? 0, 2) }}"
                               class="{{ $ui['field'] }}"
                               aria-label="{{ $hf['label'] }}" />
                        @isset($hf['note'])
                            <span class="{{ $ui['badge'] }} mt-0.5 text-blue-400 bg-blue-50 text-[0.7rem]">
                                {{ $hf['note'] }}
                            </span>
                        @endisset
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- /healthcare availment --}}


    {{-- ══════════════════════════════════════════════════════════════════════
     |  SECTION 4 — Government Identification
     ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <x-cards.accent-header icon="lock" title="Government Identification" />

        <div class="px-6 pt-5 pb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                @foreach ($govtIds as $id)
                    <div>
                        <label class="{{ $ui['label'] }}">{{ $id['label'] }}</label>
                        <input type="text" readonly
                               value="{{ $employees->{$id['key']} ?? '—' }}"
                               class="{{ $ui['field'] }}"
                               aria-label="{{ $id['label'] }} number" />
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- /government identification --}}


    {{-- ══════════════════════════════════════════════════════════════════════
     |  SECTION 5 — Work Schedule
     ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <x-cards.accent-header icon="lock" title="Work Schedule" />

        <div class="px-6 pt-5 pb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Monday</th>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Tuesday</th>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Wednesday</th>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Thursday</th>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Friday</th>
                            <th class="p-4 text-left text-sm font-semibold text-slate-900">Saturday</th>
                        </tr>
                    </thead>

                    <tbody class="border border-gray-200">
                        <tr class="odd:bg-blue-50">
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                            <td class="p-4 text-xs text-slate-600 font-medium">In 08:00 | 06:00 Out</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    {{-- /work schedule --}}


    {{-- ── Footer Actions ─────────────────────────────────────────────────── --}}
    <div class="flex items-center justify-end gap-3 pt-1 pb-4">

        <a href="{{ route('employees.index') }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-600
                  bg-white border border-gray-200 rounded-lg shadow-sm transition
                  hover:bg-gray-50 active:scale-[0.98]">
            ← Back
        </a>

        <a href="{{ route('employees.edit', $employees->id) }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white
                  bg-blue-600 rounded-lg shadow-sm shadow-blue-200 transition
                  hover:bg-blue-700 hover:shadow-blue-300 active:scale-[0.98]">
            ✎ Edit Employee
        </a>

    </div>

</div>
{{-- /main content wrapper --}}

</x-app-layout>
