{{-- resources/views/components/badges/status.blade.php --}}

@props(['label', 'color' => 'gray'])

@php
    $styles = [
        'yellow' => 'bg-yellow-100 text-yellow-700 border-yellow-200 [--dot:theme(colors.yellow.500)]',
        'green'  => 'bg-green-100  text-green-700  border-green-200  [--dot:theme(colors.green.500)]',
        'red'    => 'bg-red-100    text-red-700    border-red-200    [--dot:theme(colors.red.500)]',
        'gray'   => 'bg-gray-100   text-gray-700   border-gray-200   [--dot:theme(colors.gray.400)]',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold uppercase tracking-widest rounded-full border ' . ($styles[$color] ?? $styles['gray'])]) }}>
    <span class="inline-block w-1.5 h-1.5 rounded-full bg-[--dot]" aria-hidden="true"></span>
    {{ $label }}
</span>