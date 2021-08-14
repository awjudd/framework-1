<label {{ $attributes->merge(['class' => "font-bold text-sm {$applyInline()}"]) }}>
    {{ $slot }}
</label>
