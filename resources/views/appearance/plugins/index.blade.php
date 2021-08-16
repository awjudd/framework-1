<x-haunt::layout :title="__('haunt::appearance/plugins.titles.index')">
	<x-haunt::options.container
		:buttonText="__('haunt::appearance/plugins.titles.install')"
		:buttonUrl="route('admin.appearance.plugins.create')"
		:showSearch="false"
	/>

	<x-haunt::table.container>
		<x-haunt::table.head>
			<x-haunt::table.column :content="__('haunt::appearance/plugins.fields.name')" type="head" width="full" />
			<x-haunt::table.column :content="__('haunt::appearance/plugins.fields.package')" type="head" />
			<x-haunt::table.column content="" type="head" />
		</x-haunt::table.head>
		<x-haunt::table.body>
			@if($resources->count() === 0)
				<x-haunt::table.none :content="__('haunt::app.text.none', ['resource' => 'plugins'])" />
			@else
				@foreach($resources as $resource)
					<x-haunt::table.row>
						<x-haunt::table.column>
							<b>{{ $resource->name }}</b>
							<br>
							<div class="text-gray-400 text-xs">
								<em>{{ __('haunt::appearance/plugins.fields.version') }}:</em> {{ $resource->version }}
								&bull;
								<em>{{ __('haunt::appearance/plugins.fields.priority') }}:</em> {{ $resource->priority }}
							</div>
						</x-haunt::table.column>
						<x-haunt::table.column class="text-center" :content="$resource->package" />
						<x-haunt::table.column>
							<form
								action="{{ route('admin.appearance.plugins.update', ['plugin_id' => $resource->id]) }}"
								class="inline-flex"
								method="POST"
							>
								@csrf
								@method('PATCH')

								<button>
									@if($resource->active)
										<x-heroicon-o-x-circle class="h-4 text-yellow-500 w-4" />
									@else
										<x-heroicon-o-check-circle class="h-4 text-green-500 w-4" />
									@endif
								</button>
							</form>
							<form
								action="{{ route('admin.appearance.plugins.destroy', ['plugin_id' => $resource->id]) }}"
								class="inline-flex"
								method="POST"
							>
								@csrf
								@method('DELETE')

								<button onclick="return confirm('sure?');">
									<x-heroicon-o-trash class="h-4 text-red-500 w-4" />
								</button>
							</form>
						</x-haunt::table.column>
					</x-haunt::table.row>
				@endforeach
			@endif
		</x-haunt::table.body>
	</x-haunt::table.container>
</x-haunt::layout>
