<x-app-layout title="AstraMC Trucks & Equipments">

    {{-- ── Breadcrumb ────────────────────────────────────────────────────── --}}
    <div class="mb-5">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard',     'active' => false],
            ['label' => 'Administrator', 'active' => false],
            ['label' => 'User Accounts', 'active' => true],
        ]" />
    </div>

    {{-- ── Shared style tokens (referenced via $ui throughout the view) ──── --}}
    @php
        $ui = [
            'label'    => 'block text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 mb-1',
            'input'    => 'w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 bg-white text-gray-800
                           transition duration-150 focus:outline-none focus:border-blue-500 focus:ring-2
                           focus:ring-blue-100 placeholder:text-gray-300',
            'readonly' => 'w-full px-3 py-2.5 text-sm rounded-lg border border-orange-300 bg-gray-100
                           text-gray-400 font-mono cursor-not-allowed focus:outline-none select-none',
            'compact'  => 'h-8 text-xs',
            'error'    => 'border-red-500 text-red-500 text-[10px] mt-0.5 leading-none',
        ];

        /**
         * Preline HS-Select config shared by every multi-select in this view.
         *
         * IMPORTANT: Template strings must stay on a single line — JSON does not
         * allow literal newlines inside string values, and the attribute is bound
         * with single quotes so the JSON's double quotes pass through unescaped.
         */
        $hsSelectConfig = json_encode([
            'placeholder'      => 'Select...',
            'mode'             => 'tags',
            'wrapperClasses'   => 'relative ps-0.5 pe-9 min-h-[2.875rem] flex items-center flex-wrap text-nowrap w-full bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-700',
            'dropdownClasses'  => 'mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-transparent rounded-lg shadow-xl overflow-hidden overflow-y-auto',
            'optionClasses'    => 'py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-blue-100 rounded-lg focus:outline-none',
            'tagsItemTemplate' => '<div class="flex flex-nowrap items-center relative z-10 bg-white border border-gray-200 rounded-full p-1 m-1"><div class="whitespace-nowrap text-gray-800" data-title></div><div class="inline-flex shrink-0 justify-center items-center size-5 ms-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm cursor-pointer" data-remove><svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></div></div>',
            'tagsInputClasses' => 'py-2.5 px-2 min-w-20 rounded-lg order-1 bg-transparent border-transparent text-gray-800 placeholder:text-gray-400 focus:ring-0 text-sm outline-none',
            'optionTemplate'   => '<div class="flex items-center"><div class="text-sm text-gray-800" data-title></div><div class="ms-auto"><span class="hidden hs-selected:block"><svg class="shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/></svg></span></div></div>',
            'extraMarkup'      => '<div class="absolute top-1/2 end-3 -translate-y-1/2"><svg class="shrink-0 size-3.5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg></div>',
        ]);
    @endphp

    {{-- ── Page-level scripts ──────────────────────────────────────────────── --}}
    <script>
        /**
         * Preview a selected profile / signature image before upload.
         * Triggered by the file <input> onchange event.
         *
         * @param {Event} event
         */
        function previewProfileImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = ({ target }) => {
                document.getElementById('profile-preview').src = target.result;
            };
            reader.readAsDataURL(file);
        }

        document.addEventListener('DOMContentLoaded', () => {

            /* ── Branch multi-select: log selected values on change ── */
            document.getElementById('branch-select')
                .addEventListener('change', function () {
                    const selectedIds = Array.from(this.selectedOptions).map(o => o.value);
                    console.log('Selected branch IDs:', selectedIds);
                });

            /* ── Permissions modal ── */
            const permissionsModal   = document.getElementById('permissions-modal');
            const openModalBtn       = document.getElementById('open-permissions-modal');
            const closeModalIcon     = document.getElementById('close-modal-icon');
            const closeModalBtn      = document.getElementById('close-modal-btn');

            const openModal  = () => permissionsModal.classList.remove('hidden');
            const closeModal = () => permissionsModal.classList.add('hidden');

            openModalBtn.addEventListener('click', openModal);
            closeModalIcon.addEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            /* Close when the dark backdrop (not the dialog panel) is clicked */
            permissionsModal.addEventListener('click', ({ target }) => {
                if (target === permissionsModal) closeModal();
            });
        });
    </script>


    <div class="space-y-4">

        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- Card 1 · Personal Background                                       --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        <div x-data="{ editing: false }"
             class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <form action=""
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ── Card header ──────────────────────────────────────────── --}}
                <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-gray-100">

                    <x-prev-link href="{{ route('user-accounts.index') }}" aria-label="Back to User Accounts">
                        <x-prevIcon />
                    </x-prev-link>

                    <div class="flex items-center gap-2.5">
                        {{-- Icon badge --}}
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-500"
                              aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>

                        <div>
                            <h1 class="text-sm font-semibold text-gray-800 leading-tight">
                                Edit User Information
                            </h1>
                            <p class="text-[0.7rem] text-gray-400">
                                Fill in the details below to update the account
                            </p>
                        </div>
                    </div>

                    <x-badge.status color="yellow"
                                    label="{{ $employees->emp_status }}"
                                    class="ml-auto" />
                </div>

                {{-- ── Section heading ──────────────────────────────────────── --}}
                <div class="flex items-center gap-3 px-6 pt-5 pb-2">
                    <span class="text-[0.68rem] font-bold uppercase tracking-widest text-gray-400">
                        Personal Background
                    </span>
                    <span class="flex-1 h-px bg-orange-200" aria-hidden="true"></span>
                </div>

                {{-- ── Fields ───────────────────────────────────────────────── --}}
                <div class="px-6 py-5">
                    <div class="flex flex-col lg:flex-row gap-6">

                        {{-- Text fields grid --}}
                        <div class="flex-1">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                                {{-- Position --}}
                                <div>
                                    <label class="{{ $ui['label'] }}">Employee name</label>
                                    <input type="text"
                                           name="employee_name"
                                           value="{{ $employees->first_name }} {{ $employees->last_name }}"
                                           x-bind:disabled="!editing"
                                           :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                           class="{{ $ui['readonly'] }} {{ $ui['compact'] }}" />
                                </div>

                                {{-- Employee ID (read-only, system-generated) --}}
                                <div>
                                    <label class="{{ $ui['label'] }}">
                                        Employee ID
                                        <span class="ml-1 text-[0.6rem] font-normal normal-case tracking-normal
                                                      text-blue-400 bg-blue-50 px-1.5 py-0.5 rounded">
                                            Auto-generated
                                        </span>
                                    </label>
                                    <input type="text"
                                           name="employee_id"
                                           value="{{ $employees->employee_id }}"
                                           readonly
                                           class="{{ $ui['readonly'] }} {{ $ui['compact'] }}" />
                                </div>

                                {{-- Position --}}
                                <div>
                                    <label class="{{ $ui['label'] }}">Position</label>
                                    <input type="text"
                                           name="position"
                                           value="{{ $employees->position->position_description }}"
                                           x-bind:disabled="!editing"
                                           :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                           class="{{ $ui['readonly'] }} {{ $ui['compact'] }}" />
                                </div>

                                {{-- Role --}}
                                <div class="flex flex-col gap-1">
                                    <label class="{{ $ui['label'] }}">Role</label>
                                    <x-forms.select-field name="role" class="{{ $ui['compact'] }}">
                                        <option value="">Select Role</option>
                                        @foreach ($user_roles as $role)
                                            <option value="{{ $role->role_id }}"
                                                    @selected(old('role') == $role->role_id)>
                                                {{ $role->role_description }}
                                            </option>
                                        @endforeach
                                    </x-forms.select-field>
                                </div>

                                {{-- Company (system-derived, not editable) --}}
                            <div class="flex flex-col gap-4 sm:col-span-4">
                                <label class="{{ $ui['label'] }}">Company</label>
                                <x-forms.select-field name="company_id" class="{{ $ui['compact'] }}">
                                    <option value="">Select Company</option>

                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_id }}"
                                            @selected(old('company_id', $employees->company_id) == $company->company_id)>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach

                                </x-forms.select-field>
                            </div>

                                {{-- Branch (multi-select via Preline HS-Select) --}}
                                <div class="flex flex-col gap-4 sm:col-span-4">
                                    <label class="{{ $ui['label'] }}">Branch</label>
                                    <select id="branch-select"
                                            name="branch_ids[]"
                                            multiple
                                            class="hidden"
                                            data-hs-select='{{ $hsSelectConfig }}'>
                                        <option value="">Select branch...</option>
                                        @foreach ($branches as $branchId => $branchName)
                                            <option value="{{ $branchId }}"
                                                    @selected(in_array($branchId, old('branch_ids', [])))>
                                                {{ $branchName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>{{-- /grid --}}
                        </div>{{-- /text fields --}}

                        {{-- ── Profile photo / signature uploader ────────────── --}}
                        <div class="w-full lg:w-48 flex-shrink-0">
                            <div class="border border-gray-300 rounded p-2 flex flex-col items-center">

                                <div class="w-32 h-32 mb-4 rounded overflow-hidden bg-gray-100">
                                    <img id="profile-preview"
                                         src="{{ $employees->profile_image
                                                    ? asset('storage/' . $employees->profile_image)
                                                    : '' }}"
                                         alt="Employee signature preview"
                                         class="opacity-80 w-full h-full object-cover" />
                                </div>

                                <input type="file"
                                       id="signature-file-input"
                                       name="esignature_image"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewProfileImage(event)" />

                                <button type="button"
                                        x-bind:disabled="!editing"
                                        @click="editing && document.getElementById('signature-file-input').click()"
                                        :class="editing
                                            ? 'bg-orange-500 hover:bg-orange-600 text-white'
                                            : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                                        class="w-full py-2 rounded text-sm font-medium transition">
                                    Upload Signature
                                </button>

                            </div>
                        </div>

                    </div>
                </div>{{-- /fields --}}

                {{-- ── Save / Cancel actions (visible only in edit mode) ─────── --}}
                <div x-show="editing"
                     x-transition
                     class="flex justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">

                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 text-sm font-semibold text-white
                                   bg-orange-500 rounded-lg shadow-sm shadow-orange-200 transition
                                   hover:bg-orange-600 active:scale-[0.98]">
                        ✓ Save Changes
                    </button>

                </div>

            </form>
        </div>{{-- /card: personal background --}}


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- Card 2 · Login Credentials                                         --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        <div x-data="{ editing: false }"
             class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <form action=""
                  method="POST">
                @csrf
                @method('PUT')

                <x-cards.accent-header icon="lock" title="Login Credentials" />

                <div class="px-6 pt-5 pb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                        <div>
                            <label class="{{ $ui['label'] }}">Username</label>
                            <input type="text"
                                   name="username"
                                   value="{{ old('username', $employees->username) }}"
                                   x-bind:disabled="!editing"
                                   :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                   class="{{ $ui['input'] }} {{ $ui['compact'] }}" />
                        </div>

                        <div>
                            <label class="{{ $ui['label'] }}">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   autocomplete="current-password"
                                   x-bind:disabled="!editing"
                                   :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                   class="{{ $ui['input'] }} {{ $ui['compact'] }}" />
                        </div>

                        <div>
                            <label class="{{ $ui['label'] }}">New Password</label>
                            <input type="password"
                                   name="new_password"
                                   autocomplete="new-password"
                                   x-bind:disabled="!editing"
                                   :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                   class="{{ $ui['input'] }} {{ $ui['compact'] }}" />
                        </div>

                        <div>
                            <label class="{{ $ui['label'] }}">Confirm New Password</label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   autocomplete="new-password"
                                   x-bind:disabled="!editing"
                                   :class="editing ? '' : 'bg-gray-50 text-gray-400 cursor-not-allowed'"
                                   class="{{ $ui['input'] }} {{ $ui['compact'] }}" />
                        </div>

                    </div>
                </div>

                {{-- Save / Cancel (visible only in edit mode) --}}
                <div x-show="editing"
                     x-transition
                     class="flex justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">

                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 text-sm font-semibold text-white
                                   bg-orange-500 rounded-lg shadow-sm shadow-orange-200 transition
                                   hover:bg-orange-600 active:scale-[0.98]">
                        ✓ Save Changes
                    </button>

                </div>

            </form>
        </div>{{-- /card: login credentials --}}


        {{-- ══════════════════════════════════════════════════════════════════ --}}
        {{-- Card 3 · Permissions                                               --}}
        {{-- ══════════════════════════════════════════════════════════════════ --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <x-cards.accent-header icon="shield" title="Permissions" />

            <div class="px-6 pt-5 pb-6">
                <button id="open-permissions-modal"
                        type="button"
                        class="mt-4 mx-auto block px-4 py-2 rounded-lg text-white text-sm font-medium
                               tracking-wide bg-orange-500 hover:bg-blue-700 active:bg-blue-600 transition">
                    Edit Permissions
                </button>
            </div>

        </div>{{-- /card: permissions --}}

    </div>{{-- /space-y-4 --}}


    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- Permissions Modal (hoisted outside card so z-index stacking is clean)  --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div id="permissions-modal"
         class="hidden fixed inset-0 z-[1000] flex items-center justify-center
                bg-black/50 overflow-auto p-4"
         role="dialog"
         aria-modal="true"
         aria-labelledby="permissions-modal-title">

        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">

            {{-- Modal header --}}
            <div class="flex items-center pb-3 border-b border-gray-300">
                <h3 id="permissions-modal-title"
                    class="text-slate-900 text-xl font-semibold flex-1">
                    Edit Permission
                </h3>

                <button id="close-modal-icon"
                        type="button"
                        aria-label="Close modal"
                        class="ml-2 p-1 rounded hover:bg-gray-100 transition">
                    <svg class="w-3.5 h-3.5 fill-gray-400 hover:fill-red-500"
                         viewBox="0 0 320.591 320.591"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973
                                 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424
                                 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366
                                 0 0 1-21.256 7.288z"/>
                        <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078
                                 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504
                                 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958
                                 -1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"/>
                    </svg>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="my-6 space-y-4">

                {{-- Module selector --}}
                <div class="flex flex-col gap-2">
                    <label class="{{ $ui['label'] }}">Module</label>
                    <select id="module-select"
                            name="module_ids[]"
                            class="hidden"
                            data-hs-select='{{ $hsSelectConfig }}'>
                        <option value="">Select Module...</option>
                        {{-- Populated dynamically or via @foreach --}}
                    </select>
                </div>

                {{-- Sub-module selector --}}
                <div class="flex flex-col gap-2">
                    <label class="{{ $ui['label'] }}">Sub Module</label>
                    <select id="submodule-select"
                            name="submodule_ids[]"
                            class="hidden"
                            data-hs-select='{{ $hsSelectConfig }}'>
                        <option value="">Select Sub Module...</option>
                        {{-- Populated dynamically or via @foreach --}}
                    </select>
                </div>

                {{-- Permissions table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                {{-- Select-all checkbox --}}
                                <th class="pl-4 w-8">
                                    <input id="select-all-permissions"
                                           type="checkbox"
                                           class="hidden peer" />
                                    <label for="select-all-permissions"
                                           class="relative flex items-center justify-center p-0.5
                                                  peer-checked:before:hidden before:block before:absolute
                                                  before:w-full before:h-full before:bg-white
                                                  w-5 h-5 cursor-pointer bg-blue-500 border border-gray-400
                                                  rounded overflow-hidden">
                                        <x-checkIcon class="w-full fill-white" />
                                    </label>
                                </th>
                                <th class="p-4 text-left text-[13px] font-semibold text-slate-900 whitespace-nowrap">
                                    Module
                                </th>
                                <th class="p-4 text-left text-[13px] font-semibold text-slate-900 whitespace-nowrap">
                                    Permission
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- TODO: Replace static row with @foreach over $permissions --}}
                            <tr class="odd:bg-blue-50 whitespace-nowrap">
                                <td class="pl-4 w-8">
                                    <input id="permission-row-1"
                                           type="checkbox"
                                           class="hidden peer" />
                                    <label for="permission-row-1"
                                           class="relative flex items-center justify-center p-0.5
                                                  peer-checked:before:hidden before:block before:absolute
                                                  before:w-full before:h-full before:bg-white
                                                  w-5 h-5 cursor-pointer bg-blue-500 border border-gray-400
                                                  rounded overflow-hidden">
                                        <x-checkIcon class="w-full fill-white" />
                                    </label>
                                </td>
                                <td class="p-4 text-sm text-slate-900 font-medium">
                                    {{-- Module name from data --}}
                                </td>
                                <td class="p-4 text-sm text-slate-900">
                                    {{-- Permission label from data --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>{{-- /modal body --}}

            {{-- Modal footer --}}
            <div class="border-t border-gray-300 pt-6 flex justify-end gap-4">
                <button id="close-modal-btn"
                        type="button"
                        class="px-4 py-2 rounded-lg text-slate-900 text-sm font-medium
                               bg-gray-200 hover:bg-gray-300 active:bg-gray-200 transition">
                    Close
                </button>
                <button type="button"
                        class="px-4 py-2 rounded-lg text-white text-sm font-medium
                               bg-blue-600 hover:bg-blue-700 active:bg-blue-600 transition">
                    Update
                </button>
            </div>

        </div>{{-- /dialog panel --}}
    </div>{{-- /permissions modal --}}

</x-app-layout>
