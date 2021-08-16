<div {{ $attributes->merge(['class' => "gap-4 grid mb-4 md:grid-cols-12"]) }}>
	<div class="col-span-12 md:col-span-4">
		@if($showSearch)
			<x-haunt::options.search />
		@endif
	</div>
	<div class="col-span-12 text-right md:col-span-8">
		@if($slot->toHtml() !== '')
			{{ $slot }}
		@else
			@if($buttonUrl !== '')
				<x-haunt::form.button :href="$buttonUrl" :theme="$buttonTheme">{{ $buttonText }}</x-form.button>
			@endif
		@endif
	</div>
</div>
