import markdownEditor from './markdown-editor';
import tiptapEditor from './tiptap-editor';

document.addEventListener('alpine:init', () => {
    window.Alpine.store('sidebar', {
        isOpen: window.Alpine.$persist(true).as('isOpen'),

        close: function () {
            this.isOpen = false;
        },

        open: function () {
            this.isOpen = true;
        },
    });

    window.Alpine.data('markdownEditor', markdownEditor);
    window.Alpine.data('tiptapEditor', tiptapEditor);
});
