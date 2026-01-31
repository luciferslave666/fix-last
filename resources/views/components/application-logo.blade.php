@props(['size' => '60', 'color' => 'currentColor'])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}>
    {{-- Icon SVG --}}
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
        {{-- Briefcase background --}}
        <rect x="15" y="35" width="70" height="50" rx="4" fill="{{ $color }}" opacity="0.1"/>
        
        {{-- Briefcase main --}}
        <path d="M20 40 h60 v40 a5 5 0 0 1 -5 5 h-50 a5 5 0 0 1 -5 -5 v-40 z" 
              fill="{{ $color }}" opacity="0.2"/>
        
        {{-- Briefcase top --}}
        <rect x="20" y="35" width="60" height="8" rx="2" fill="{{ $color }}"/>
        
        {{-- Handle --}}
        <path d="M35 35 v-8 a5 5 0 0 1 5 -5 h20 a5 5 0 0 1 5 5 v8" 
              stroke="{{ $color }}" 
              stroke-width="3" 
              fill="none"
              stroke-linecap="round"/>
        
        {{-- Lock/Clasp --}}
        <rect x="47" y="40" width="6" height="4" rx="1" fill="{{ $color }}" opacity="0.6"/>
        
        {{-- Person Icon (stylized K) --}}
        <g transform="translate(42, 52)">
            {{-- Head --}}
            <circle cx="8" cy="5" r="4" fill="white"/>
            {{-- Body as K shape --}}
            <path d="M5 11 v12 M5 15 l6 -4 M5 17 l6 6" 
                  stroke="white" 
                  stroke-width="2.5" 
                  stroke-linecap="round"
                  stroke-linejoin="round"/>
        </g>
        
        {{-- Accent dots (representing opportunities) --}}
        <circle cx="28" cy="55" r="2" fill="{{ $color }}" opacity="0.4"/>
        <circle cx="72" cy="60" r="2" fill="{{ $color }}" opacity="0.4"/>
        <circle cx="28" cy="70" r="2" fill="{{ $color }}" opacity="0.4"/>
    </svg>
    
    {{-- Text Logo --}}
    <div class="flex flex-col leading-none">
        <span class="font-bold text-2xl tracking-tight" style="color: {{ $color }}">
            Kerjaku
        </span>
        <span class="text-xs text-gray-500 font-medium tracking-wide">
            Peluang UMKM
        </span>
    </div>
</div>