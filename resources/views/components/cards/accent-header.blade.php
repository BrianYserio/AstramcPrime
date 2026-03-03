@props(['title' => ""])
{{-- Accent header --}}
<div class="flex items-center gap-2.5 px-6 py-2 bg-green-500">
                    
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
    </svg>
    <span class="text-xs font-bold uppercase tracking-widest text-white">{{$title}}</span>
</div>