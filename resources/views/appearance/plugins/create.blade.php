<x-haunt::layout>
	<!-- direct install -->
	<x-haunt::grid.container>
		<x-haunt::grid.column class="md:col-span-6" />
		<x-haunt::grid.column class="md:col-span-6">
			<form method="POST" action="{{ route('admin.appearance.plugins.store') }}">
				@csrf
				@method('POST')
				<div class="flex items-end space-x-4">
					<div class="flex-grow">
						<x-haunt::form.label for="package" :content="__('haunt::appearance/plugins.fields.package')" />
						<x-haunt::form.input name="package" type="text" />
					</div>
					<div>
						<x-haunt::form.button theme="success" :content="__('haunt::appearance/plugins.fields.submit')" />
					</div>
				</div>
			</form>
		</x-haunt::grid.column>
	</x-haunt::grid.container>
</x-haunt::layout>
