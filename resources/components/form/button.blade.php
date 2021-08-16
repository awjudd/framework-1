@if(!$attributes['href'])
    <button {{ $attributes->merge(['class' => "border inline-flex font-bold h-10 items-center justify-center px-3 rounded text-sm tracking-wide uppercase {$applyTheme()} {$applyThemeHover()} {$applyFullWidth()}"]) }}>
        {{ $content ?? $slot }}
    </button>
@else
    <a {{ $attributes->merge(['class' => "border inline-flex font-bold h-10 items-center justify-center px-3 rounded text-sm tracking-wide uppercase {$applyTheme()} {$applyThemeHover()} {$applyFullWidth()}"]) }} style="appearance: button">
        {{ $content ?? $slot }}
    </a>
@endif
