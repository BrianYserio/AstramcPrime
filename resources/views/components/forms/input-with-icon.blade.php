@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
])

<div>
    <label class="text-slate-900 text-sm font-medium mb-2 block">
        {{ $label }}
    </label>

    <div class="relative flex items-center">
        <input
            name="{{ $name }}"
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-orange-600'
            ]) }}
        />

        @if($icon)
            {{ $icon }}
        @endif

         {{-- 🔴 Reusable Error Message --}}
        @error($name)
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>
</div>
