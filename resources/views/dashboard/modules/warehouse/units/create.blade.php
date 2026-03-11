<x-app-layout title="AstraMC Trucks & Equipments">

    {{-- ── Breadcrumb ──────────────────────────────────────────────────────────── --}}
    <div class="mb-5">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'active' => false],
            ['label' => 'Warehouse', 'active' => false],
            ['label' => 'Units',     'active' => true],
        ]" />
    </div>

    @php
        $inputBase = 'w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 bg-white text-gray-800
                      transition duration-150 focus:outline-none focus:border-blue-500 focus:ring-2
                      focus:ring-blue-100 placeholder:text-gray-300';

        $styles = [
            'label'    => 'block text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 mb-1',
            'input'    => $inputBase,
            'readonly' => 'w-full px-3 py-2.5 text-sm rounded-lg border border-orange-300 bg-gray-100
                           text-gray-400 font-mono cursor-not-allowed focus:outline-none select-none',
            'compact'  => 'h-8 text-xs',
        ];

        $autoBadge = '<span class="ml-1 text-[0.6rem] font-normal normal-case tracking-normal
                           text-blue-400 bg-blue-50 px-1.5 py-0.5 rounded">Auto-generated</span>';
    @endphp

    <form action="{{ route('units.store') }}" method="POST" novalidate>
        @csrf

        <div class="space-y-4">

            {{-- ── Card: Unit Information ──────────────────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="flex flex-wrap items-center gap-3 px-6 py-4 border-b border-gray-100">
                    <x-prev-link href="{{ route('units.index') }}" aria-label="Back to Units">
                        <x-prevIcon />
                    </x-prev-link>

                    <div class="flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-50 text-orange-500"
                              aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <div>
                            <h1 class="text-sm font-semibold text-gray-800 leading-tight">New Unit</h1>
                            <p class="text-[0.7rem] text-gray-400">Fill in the details below to add a new unit</p>
                        </div>
                    </div>

                    <x-badge.status color="yellow" label="Pending" class="ml-auto" />
                </div>

                {{-- Section Divider --}}
                <div class="flex items-center gap-3 px-6 pt-5 pb-2">
                    <span class="text-[0.68rem] font-bold uppercase tracking-widest text-gray-400">
                        Unit Information
                    </span>
                    <span class="flex-1 h-px bg-orange-200" aria-hidden="true"></span>
                </div>

                {{-- Form Fields --}}
                <div class="px-6 py-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Unit ID (read-only) --}}
                        <div>
                            <label class="{{ $styles['label'] }}">
                                Unit ID {!! $autoBadge !!}
                            </label>
                            <input type="text" name="unit_id" value="{{ $unitIdPreview }}" readonly
                                   class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                        </div>

                        {{-- Cabin Type --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Cabin Type</label>
                            <x-forms.select-field name="cabin_type" class="{{ $styles['compact'] }}">
                                <option value="">Select Cabin Type</option>
                                @foreach ($cabins as $cabin)
                                    <option value="{{ $cabin->row_id }}" @selected(old('cabin_type') == $cabin->row_id)>
                                        {{ $cabin->cdescription }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- Unit Type --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Unit Type</label>
                            <x-forms.select-field name="unit_type" class="{{ $styles['compact'] }}">
                                <option value="" disabled selected>Select Unit Type</option>
                                @foreach ($units['units_assembly'] as $unitType)
                                    <option value="{{ $unitType }}"
                                            @selected(old('unit_type', $selectedUnitType ?? '') === $unitType)>
                                        {{ $unitType }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- No. of Wheels --}}
                        <div>
                            <label class="{{ $styles['label'] }}">No. of Wheels</label>
                            <x-forms.select-field name="wheels" class="{{ $styles['compact'] }}">
                                <option value="">Select No. of Wheels</option>
                                @foreach ($wheels as $wheel)
                                    <option value="{{ $wheel->row_id }}"
                                            @selected(old('wheels', $selectedWheel ?? '') == $wheel->row_id)>
                                        {{ $wheel->cdescription }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- Make --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Make</label>
                            <x-forms.select-field name="make" class="{{ $styles['compact'] }}">
                                <option value="">Select Make</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->row_id }}"
                                            @selected(old('make', $selectedMake ?? '') == $make->row_id)>
                                        {{ $make->cdescription }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- Condition --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Condition</label>
                            <x-forms.select-field name="condition" class="{{ $styles['compact'] }}">
                                <option value="">Select Condition</option>
                                @foreach ($conditions['condition'] as $condition)
                                    <option value="{{ $condition }}"
                                            @selected(old('condition', $selectedCondition ?? '') === $condition)>
                                        {{ $condition }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- Body Type --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Body Type</label>
                            <x-forms.select-field name="body_type" class="{{ $styles['compact'] }}">
                                <option value="" disabled selected>Select Body Type</option>
                                @foreach ($bodies as $body)
                                    <option value="{{ $body->row_id }}"
                                            @selected(old('body_type', $selectedBodyType ?? '') == $body->row_id)>
                                        {{ $body->cdescription }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- GVW --}}
                        <div>
                            <label class="{{ $styles['label'] }}">GVW (Kg)</label>
                            <input type="text" name="gvw" value="{{ old('gvw') }}"
                                   placeholder="e.g. 12000"
                                   class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                        </div>

                        {{-- Horse Power --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Horse Power</label>
                            <x-forms.select-field name="horse_power" class="{{ $styles['compact'] }}">
                                <option value="">Select Horse Power</option>
                                @foreach ($powers as $power)
                                    <option value="{{ $power->row_id }}"
                                            @selected(old('horse_power', $selectedHorsePower ?? '') == $power->row_id)>
                                        {{ $power->cdescription }}
                                    </option>
                                @endforeach
                            </x-forms.select-field>
                        </div>

                        {{-- Prepared By (read-only from auth) --}}
                        <div>
                            <label class="{{ $styles['label'] }}">
                                Prepared By
                                {!! $autoBadge !!}
                            </label>
                            <input type="text" name="user_name" value="{{ auth()->user()->name ?? '' }}" readonly
                                   class="{{ $styles['readonly'] }} {{ $styles['compact'] }}" />
                        </div>

                        {{-- Engine Series --}}
                        <div>
                            <label class="{{ $styles['label'] }}">Engine Series</label>
                            <input type="text" name="engine" value="{{ old('engine') }}"
                                   placeholder="e.g. 6HK1"
                                   class="{{ $styles['input'] }} {{ $styles['compact'] }}" />
                        </div>

                    </div>{{-- /grid --}}
                </div>{{-- /form fields --}}

            </div>{{-- /card --}}

            {{-- ── Footer Actions ──────────────────────────────────────────────── --}}
            <div class="flex items-center justify-end gap-2 pb-4">
                <a href="{{ route('units.index') }}"
                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-600 bg-white
                          border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </a>
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
