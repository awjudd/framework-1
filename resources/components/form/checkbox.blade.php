<input type="hidden" name="{{ $attributes['name'] }}" value="off">
<input
	{{ $attributes->merge(['class' => "align-middle appearance-none border border-gray-400 cursor-pointer h-5 inline-block rounded w-5 {$applyContent()}"]) }}
	@if($checked) checked @endif
	type="checkbox"
/>

@if($content !== '')
	<x-haunt::form.label :content="$content" inline/>
@endif
