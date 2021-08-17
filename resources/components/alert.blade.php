<div {{ $attributes->merge(['class' => "mb-4 p-4 rounded text-sm {$applyTheme()}"]) }}>
	{{ $content ?? $slot }}
</div>
