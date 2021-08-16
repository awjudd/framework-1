<form method="POST" action="{{ $action }}" class="inline-flex">
    @csrf
    @method('DELETE')

    <button onclick="return confirm('{{ $confirm }}');">
        <x-heroicon-o-trash class="h-4 text-red-500 w-4" />
    </button>
</form>
