<form class="flex items-end" method="GET">
    <input name="page" type="hidden" value="1" />
    @if(request()->has('sort'))
        <input name="sort" type="hidden" value="{{ request()->input('sort') }}" />
    @endif

    <div class="flex-grow">
        <x-haunt::form.label class="hidden" for="q">{{ __('global.search') }}</x-haunt::form.label>
        <x-haunt::form.input name="q" class="border-r-none rounded-r-none" type="search" value="{{ request()->input('q') }}" placeholder="Search..." />
    </div>
    <x-haunt::form.button class="rounded-l-none" theme="success">
        <x-heroicon-o-search class="h-4 w-4" />
    </x-haunt::form.button>
</form>
