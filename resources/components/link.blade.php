<a {{ $attributes->merge(['class' => "inline-block text-primary"]) }}>
    {{ $content ?? $slot }}
</a>
