<x-haunt::screen class="flex items-center justify-center">
	<x-haunt::card.container class="inline-block my-auto w-96" :margin="false">
		<form method="POST" action="{{ route('admin.install.store') }}">
			@csrf
			@method('POST')
			<input name="step" type="hidden" value="{{ $step }}" />

			@include('haunt::install._'.$step)
		</form>
	</x-haunt::card.container>
</x-haunt::screen>
