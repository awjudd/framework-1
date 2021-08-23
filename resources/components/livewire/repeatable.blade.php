<div>
	<div class="flex items-start">
		@if($title !== null)
			<x-haunt::heading level="3">{{ $title }}</x-haunt::heading>
		@endif
		<div class="flex-grow"></div>
		<x-haunt::form.button dense wire:click.prevent="addItem()">
			<x-heroicon-o-plus class="h-4 w-4" />
		</x-haunt::form.button>
	</div>

	@if(count($items) === 0)
		<div class="text-center dark:text-gray-500">
			There are no {{ $title }} to display.
		</div>
	@else
		@foreach($items as $index => $item)
			<div class="flex items-center mb-2 space-x-4">
				<x-haunt::form.button dense theme="error" wire:click.prevent="removeItem({{ $index }})">
					<x-heroicon-o-x class="h-4 w-4" />
				</x-haunt::form.button>
				<div class="flex-grow">
					<livewire:repeatable-view-component :data="$item" :index="$index" :view="$view" :wire:key="$item['id']" />
				</div>
				<div class="flex flex-col">
					<x-haunt::form.button class="rounded-b-none" dense wire:click.prevent="moveUp({{ $index }})">
						<x-heroicon-o-chevron-up class="h-4 w-4" />
					</x-haunt::form.button>
					<x-haunt::form.button class="rounded-t-none" dense wire:click.prevent="moveDown({{ $index }})">
						<x-heroicon-o-chevron-down class="h-4 w-4" />
					</x-haunt::form.button>
				</div>
			</div>
		@endforeach
	@endif
</div>
