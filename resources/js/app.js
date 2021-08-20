window.CodeMirror = require('codemirror')
import 'codemirror/addon/edit/matchbrackets'
import 'codemirror/mode/htmlmixed/htmlmixed.js'

import Alpine from 'alpinejs'
import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

window.setupEditor = function (content) {
	return (() => {
	  let _editor;

	  return {
		editor: () => _editor,
		proxy: null,
		content: content,
		init(element) {
		  _editor = new Editor({
			element: element,
			extensions: [StarterKit],
			content: this.content,
			onUpdate: ({ editor }) => {
			  this.content = editor.getHTML();
			}
		  });
		  this.proxy = _editor;
		}
	  };
	})();
};

window.Alpine = Alpine
Alpine.start()
