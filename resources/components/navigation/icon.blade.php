<a {{ $attributes->merge(['class' => "p-2 rounded {$applyActive('bg-gray-200 text-primary dark:bg-gray-900', 'text-gray-400 hover:text-gray-500 dark:hover:text-gray-300')}"]) }}>
    {{ $slot }}
</a>
