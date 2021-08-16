<div {{ $attributes->merge(['class' => "mt-1 text-xs dark:text-gray-400"]) }}>
	{{ $content ?? $slot }}
</div>
