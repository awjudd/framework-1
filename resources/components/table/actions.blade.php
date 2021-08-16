<x-haunt::table.column>
	<div {{ $attributes->merge(['class' => "inline-flex items-center justify-end space-x-1"]) }}>
		@if($see !== '')
			<x-haunt::link :href="$see">
				<x-dynamic-component
					:component="'heroicon-o-'.$seeIcon"
					class="h-4 text-blue-500 w-4"
				/>
			</x-haunt::link>
		@endif

		<x-haunt::link :href="$edit">
			<x-dynamic-component
				:component="'heroicon-o-'.$editIcon"
				class="h-4 text-yellow-500 w-4"
			/>
		</x-haunt::link>

		@if($delete !== '')
			<x-haunt::form.delete :action="$delete">
				<x-dynamic-component
					:component="'heroicon-o-'.$deleteIcon"
					class="h-4 text-red-500 w-4"
				/>
			</x-haunt::form.delete>
		@endif
	</div>
</x-haunt::table.column>
