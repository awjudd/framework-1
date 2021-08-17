<x-haunt::screen class="flex items-center justify-center">
	<x-haunt::card.container class="inline-block my-auto w-96" :margin="false">
		<x-haunt::heading :content="__('haunt::auth/login.titles.index')" level="3" />

		<form method="POST" action="{{ route('admin.login') }}">
			@csrf
			@method('POST')

			<x-haunt::grid.container>
				<x-haunt::grid.column>
					<x-haunt::form.label for="email_address" :content="__('haunt::auth/login.fields.email_address')" />
					<x-haunt::form.input name="email_address" type="email" />
				</x-haunt::grid.column>
				<x-haunt::grid.column>
					<x-haunt::form.label for="password" :content="__('haunt::auth/login.fields.password')" />
					<x-haunt::form.input name="password" type="password" />
				</x-haunt::grid.column>
				<x-haunt::grid.column class="text-right">
					<x-haunt::form.button theme="success" :content="__('haunt::auth/login.fields.submit')" />
				</x-haunt::grid.column>
			</x-haunt::grid.container>
		</form>
	</x-haunt::card.container>
</x-haunt::screen>
