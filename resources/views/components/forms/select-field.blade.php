@props(['placeholder' => null])

<div>
    <div class="relative">
        <select
            {{ $attributes->merge([
                'class' =>
                    'w-full appearance-none px-3 py-2 pr-8 text-sm rounded-lg border bg-white text-gray-700 cursor-pointer transition focus:outline-none focus:ring-2 ' .
                    ($errors->has($attributes->get('name'))
                        ? 'border-red-500 focus:ring-red-100'
                        : 'border-gray-200 focus:border-blue-500 focus:ring-blue-100')
            ]) }}
        >
            @if ($placeholder)
                <option value="" disabled>{{ $placeholder }}</option>
            @endif

            {{ $slot }}
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    @error($attributes->get('name'))
        <p class="border-red-500 text-red-500 text-[10px] mt-0.5 leading-none">{{ $message }}</p>
    @enderror
</div>