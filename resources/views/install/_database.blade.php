<x-haunt::grid.container>
	<!-- description -->
	<x-haunt::grid.column class="text-sm dark:text-gray-300">
		{{ __('haunt::install.database.introduction') }}
	</x-haunt::grid.column>
	<!-- database_name -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="database_name" :content="__('haunt::install.database.database_name')" />
		<x-haunt::form.input name="database_name" type="text" />
	</x-haunt::grid.column>
	<!-- database_username -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="database_username" :content="__('haunt::install.database.database_username')" />
		<x-haunt::form.input name="database_username" type="text" />
	</x-haunt::grid.column>
	<!-- database_password -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="database_password" :content="__('haunt::install.database.database_password')" />
		<x-haunt::form.input name="database_password" type="password" />
	</x-haunt::grid.column>
	<!-- database_host -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="database_host" :content="__('haunt::install.database.database_host')" />
		<x-haunt::form.input name="database_host" type="text" value="localhost" />
	</x-haunt::grid.column>
	<!-- database_prefix -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="database_prefix" :content="__('haunt::install.database.database_prefix')" />
		<x-haunt::form.input name="database_prefix" type="text" value="hnt_" />
	</x-haunt::grid.column>
	<!-- submit -->
	<x-haunt::grid.column class="text-right">
		<x-haunt::form.button theme="success" :content="__('haunt::install.database.submit')" />
	</x-haunt::grid.column>
</x-haunt::grid.container>
