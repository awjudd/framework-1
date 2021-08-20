<x-tiptap-editor {{ $attributes->merge(['class' => 'bg-white border border-t-0 min-h-48 px-3 py-2 rounded-b text-sm w-full dark:bg-gray-900 dark:border-gray-700']) }} :content="$content" :extensions="['extension-underline']">
	<x-haunt::tiptap.menu />
</x-tiptap-editor>
