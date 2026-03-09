@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'flex items-center gap-3 bg-orange-400 text-white px-4 py-3 rounded-lg border border-orange-500'
    ]) }}>
        
        <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5 shrink-0" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke="currentColor">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  stroke-width="2" 
                  d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
        </svg>

        <!-- Message -->
        <span class="text-sm font-medium">
            {{ $status }}
        </span>

    </div>
@endif