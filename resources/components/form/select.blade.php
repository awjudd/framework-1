<select {{ $attributes->merge(['class' => "bg-white border h-10 px-3 rounded text-sm w-full dark:bg-gray-900 dark:border-gray-700 {$applyMargin()}"]) }}>
    {{ $slot }}
</select>
