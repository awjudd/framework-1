<h{{ $level }} {{ $attributes->merge(['class' => "font-bold mb-6 {$applyLevel()}"]) }}>
	{{ $content ?? $slot }}
</h{{ $level }}>
