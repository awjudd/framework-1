<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('/haunt/css/app.css?v=12') }}">
    </head>
    <body {{ $attributes->merge(['class' => "bg-gray-150 max-h-screen min-h-screen text-gray-900 overflow-x-hidden overflow-y-auto dark:bg-gray-850 dark:text-gray-100"]) }}>
		{{ $slot }}
	</body>
</html>
