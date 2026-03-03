@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'readonly' => false, // 👈 add this
    'styles' => [
        'label' => '',
        'input' => '',
        'compact' => '',
        'error' => '',
        'readonly' => ''
    ]
])

<div>
    <label for="{{ $name }}" class="{{ $styles['label'] }}">
        {{ $label }}
    </label>

    <input 
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($readonly) readonly @endif
        class="{{ $styles['input'] }} 
               {{ $styles['compact'] }} 
               {{ $readonly ? $styles['readonly'] : '' }}" />

    @error($name)
        <p class="{{ $styles['error'] }}">{{ $message }}</p>
    @enderror
</div>