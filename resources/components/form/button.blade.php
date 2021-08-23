@if(!$attributes['href'])
    <button {{ $attributes->merge(['class' => "border inline-flex font-bold items-center justify-center rounded text-sm tracking-wide uppercase {$applyDensity('p-1', 'h-10 px-3')} {$applyTheme()} {$applyThemeHover()} {$applyFullWidth()}"]) }}>
        {{ $content ?? $slot }}
    </button>
@else
    <a {{ $attributes->merge(['class' => "border inline-flex font-bold items-center justify-center rounded text-sm tracking-wide uppercase {$applyDensity('px-1', 'h-10 px-3')} {$applyTheme()} {$applyThemeHover()} {$applyFullWidth()}"]) }} style="appearance: button">
        {{ $content ?? $slot }}
    </a>
@endif
