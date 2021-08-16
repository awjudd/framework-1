<div {{ $attributes->merge(['class' => "bg-gray-200 p-8 rounded shadow dark:bg-gray-900 {$applyMargin()}"]) }}>
	{{ $slot }}
</div>
