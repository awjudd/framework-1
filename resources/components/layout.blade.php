<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('/vendor/haunt/css/app.css?v=12') }}">
    </head>
    <body {{ $attributes->merge(['class' => "bg-gray-150 max-h-screen min-h-screen text-gray-900 overflow-x-hidden overflow-y-auto dark:bg-gray-850 dark:text-gray-100"]) }}>
		<!-- navigation -->
		<div class="border-gray-300 hide-scrollbar overflow-auto text-center dark:border-gray-750 md:border-r md:bottom-0 md:fixed md:top-0 md:w-nav">
			<x-haunt::navigation.container break="md" class="p-4 space-x-2 md:my-auto" direction="v" inline>
				@foreach(Haunt::navigation() as $item)
					<x-haunt::navigation.icon
						:active="$item['children']->where('route', request()->route()->getName())->first() !== null"
						:href="route($item['route'])"
					>
						<x-dynamic-component
							:component="'heroicon-o-'.$item['icon']"
							class="h-6 w-6"
						/>
					</x-haunt::navigation.icon>
				@endforeach
			</x-haunt::navigation.container>
		</div>

		<!-- main -->
		<div class="md:ml-nav lg:mr-sidebar">
			<!-- menu -->
			<div class="border-gray-300 border-b p-4 pt-0 text-center dark:border-gray-750 md:pt-4 md:px-8 md:text-right">
				<x-haunt::navigation.container inline>
					@foreach(Haunt::menu() as $item)
						<x-haunt::navigation.text
							:active="$item['route'] === request()->route()->getName()"
							:href="route($item['route'])"
						>
							{{ $item['title'] }}
						</x-haunt::navigation.text>
					@endforeach
				</x-haunt::navigation.container>
			</div>
			<!-- content -->
			<div class="p-4 md:p-8">
				<!-- sessions -->
				@if($errors->any())
					<x-haunt::alert theme="error">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</x-haunt::alert>
				@endif

				@if(session()->has('success'))
					<x-haunt::alert theme="success">
						{{ session()->get('success') }}
					</x-haunt::alert>
				@endif

				<!-- title -->
				@if($title !== null)
					<x-haunt::heading level="1">{{ $title }}</x-haunt::heading>
				@endif

				<!-- content -->
				{{ $slot }}
			</div>
		</div>

		<!-- sidebar -->
		<div class="bg-gray-200 hide-scrollbar overflow-y-scroll dark:bg-gray-900 md:ml-nav lg:bottom-0 lg:fixed lg:ml-0 lg:right-0 lg:top-0 lg:w-sidebar">
			<!-- menu -->
			<div class="border-gray-300 border-b p-4 text-right dark:border-gray-750 md:px-8">
				<x-haunt::navigation.container inline>
					{{ auth()->guard('haunt')->user()->full_username }}
				</x-haunt::navigation.container>
			</div>
		</div>
	</body>
</html>
