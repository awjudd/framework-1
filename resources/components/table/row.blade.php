<tr {{ $attributes->merge(['class' => "{$applyHover('hover:bg-gray-100 dark:hover:bg-gray-900')}"]) }}>
    {{ $slot }}
</tr>
