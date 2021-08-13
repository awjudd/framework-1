<a {{ $attributes->merge(['class' => "font-semibold text-sm {$applyActive('text-primary', 'text-gray-500')} hover:text-primary"]) }}>
    {{ $slot }}
</a>
