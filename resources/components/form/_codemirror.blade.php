<textarea {{ $attributes->merge(['class' => "bg-white border px-3 py-2 rounded text-sm w-full dark:bg-gray-900 dark:border-gray-700 {$applyMargin()}"]) }} id="wysiwyg" />{{ $slot }}</textarea>


<script>
    window.CodeMirror.fromTextArea(document.getElementById('wysiwyg'), {
        mode: "htmlmixed",
        theme: "nord",
        highlightMatches: true,
        indentWithTabs: false,
        lineNumbers: false,
        lineWrapping: true,
        matchBrackets: true,
        styleActiveLine: true,
        styleActiveSelected: true,
        tabSize: 2,
    })
</script>
