<x-haunt::table.column>
	<div {{ $attributes->merge(['class' => "inline-flex items-center justify-end space-x-1"]) }}>
		@if($see !== '')
			<x-haunt::link :href="$see">
				<x-heroicon-o-eye class="h-4 text-blue-500 w-4" />
			</x-haunt::link>
		@endif

		<x-haunt::link :href="$edit">
			<x-heroicon-o-cog class="h-4 text-yellow-500 w-4" />
		</x-haunt::link>

		@if($delete !== '')
			<x-haunt::form.delete :action="$delete" />
		@endif
	</div>
</x-haunt::table.column>
