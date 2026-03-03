<a {{$attributes->merge([
        'class' => 'inline-flex items-center justify-center 
         w-9 h-9 text-white bg-blue-600 rounded-lg 
         transition shrink-0 hover:bg-blue-700'
    ]) }}>
    {{$slot}}
</a>