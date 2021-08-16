<label {{ $attributes->merge(['class' => "font-bold text-sm {$applyInline()}"]) }}>
    {{ $content ?? $slot }}
</label>
