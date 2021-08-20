<x-tiptap-menu {{ $attributes->merge(['class' => 'bg-white border flex space-x-2 px-3 py-2 rounded-t text-sm w-full dark:bg-gray-800 dark:border-gray-700']) }}>
	<x-haunt::tiptap.menu-item action="toggleBold">
		<em class="fas fa-bold"></em>
	</x-haunt::tiptap.menu-item>
	<x-haunt::tiptap.menu-item action="toggleItalic">
		<em class="fas fa-italic"></em>
	</x-haunt::tiptap.menu-item>
	<x-haunt::tiptap.menu-item action="toggleStrike">
		<em class="fas fa-strikethrough"></em>
	</x-haunt::tiptap.menu-item>
</x-tiptap-menu>
