<div {{ $attributes->merge(['class' => "hide-scrollbar {$applyInline()} {$applyDirection()}"]) }}>
	{{ $slot }}
</div>
