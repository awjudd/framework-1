<thead {{ $attributes->merge(['class' => "bg-gray-200 text-gray-600 text-sm dark:bg-gray-900 dark:text-gray-300"]) }}>
	<x-haunt::table.row>
    	{{ $slot }}
	</x-haunt::table.row>
</thead>
