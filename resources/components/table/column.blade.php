<{{ $type === 'head' ? 'th' : 'td'}} {{ $attributes->merge(['class' => "border px-4 py-2 whitespace-nowrap {$applyType()}"]) }}>
    {{ $content ?? $slot }}
</{{ $type === 'head' ? 'th' : 'td'}}>
