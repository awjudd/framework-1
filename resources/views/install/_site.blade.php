<x-haunt::grid.container>
	<!-- description -->
	<x-haunt::grid.column class="text-sm dark:text-gray-300">
		{{ __('haunt::install.site.introduction') }}
	</x-haunt::grid.column>
	<!-- site_name -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="site_name" :content="__('haunt::install.site.site_name')" />
		<x-haunt::form.input name="site_name" type="text" value="Petsite" />
	</x-haunt::grid.column>
	<!-- email_address -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="email_address" :content="__('haunt::install.site.email_address')" />
		<x-haunt::form.input name="email_address" type="email" />
	</x-haunt::grid.column>
	<!-- password -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="password" :content="__('haunt::install.site.password')" />
		<x-haunt::form.input name="password" type="password" />
	</x-haunt::grid.column>
	<!-- date_of_birth -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="date_of_birth" :content="__('haunt::install.site.date_of_birth')" />
		<x-haunt::form.input name="date_of_birth" type="date" />
	</x-haunt::grid.column>
	<!-- username -->
	<x-haunt::grid.column>
		<x-haunt::form.label for="username" :content="__('haunt::install.site.username')" />
		<x-haunt::form.input name="username" type="text" value="admin" />
	</x-haunt::grid.column>
	<!-- core -->
	<x-haunt::grid.column class="text-center">
		<x-haunt::form.checkbox :checked="true" :content="__('haunt::install.site.install_core')" name="install_core" />
	</x-haunt::grid.column>
	<!-- submit -->
	<x-haunt::grid.column class="text-right">
		<x-haunt::form.button theme="success" :content="__('haunt::install.site.submit')" />
	</x-haunt::grid.column>
</x-haunt::grid.container>
