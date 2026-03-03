<a {{$attributes->merge([
        'class' => 'inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 
                    text-white text-sm font-semibold 
                    px-4 py-2 rounded-lg 
                    shadow-sm shadow-blue-200 hover:shadow-blue-300 
                    transition duration-200'
    ]) }}>
    {{$slot}}
</a>