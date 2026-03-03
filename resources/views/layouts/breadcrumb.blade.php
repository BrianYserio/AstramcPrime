@props(['items' => []])

<ul class="bg-white rounded-full py-0.5 px-2 -space-x-2 w-max flex items-center mb-1 text-xs">
    @foreach($items as $index => $item)
        @php
            $isActive = $item['active'] ?? false;
            $bgColor = $isActive ? ($item['bg_color'] ?? 'bg-orange-500') : ($item['bg_color'] ?? 'bg-gray-100');
            $textColor = $isActive ? ($item['text_color'] ?? 'text-white') : ($item['text_color'] ?? 'text-gray-600');
            $rounded = $index === 0 ? 'rounded-l-full' : ($index === count($items)-1 ? 'rounded-r-full' : '');
        @endphp

        <li class="{{ $bgColor }} {{ $textColor }} {{ $rounded }}
                   z-{{ 40 - $index*5 }}
                   px-4 py-1.5
                   font-medium
                   cursor-pointer
                   shadow-sm">
            {{ $item['label'] }}
        </li>
    @endforeach
</ul>
