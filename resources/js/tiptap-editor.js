import { Editor } from '@tiptap/core';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import StarterKit from '@tiptap/starter-kit';

export default function tiptapEditor({ state }) {
    let editor;

    return {
        state: state,

        updatedAt: Date.now(),

        init() {
            const _this = this;

            editor = new Editor({
                element: this.$refs.element,
                extensions: [
                    StarterKit,
                    Link.configure({
                        openOnClick: false,
                    }).extend({
                        addAttributes() {
                            // Return an object with attribute configuration
                            return {
                                ...this.parent?.(),
                                rel: {
                                    default: 'noopener noreferrer nofollow',
                                },
                            };
                        },
                    }),
                    Image,
                ],
                editorProps: {
                    attributes: {
                        class: 'p-4 min-h-[12rem] overflow-y-auto prose prose-dark dark:prose-light min-w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
                    },
                },
                content: _this.state,
                onCreate() {
                    _this.updatedAt = Date.now();
                },
                onUpdate({ editor }) {
                    _this.state = editor.getHTML();
                    _this.updatedAt = Date.now();
                },
                onSelectionUpdate() {
                    _this.updatedAt = Date.now();
                },
            });

            this.$watch('state', (state) => {
                // If the new state matches TipTap's then we just skip.
                if (state === editor.getHTML()) return;

                /*
                    Otherwise, it means that a force external to TipTap
                    is modifying the data on this Alpine component,
                    which could be Livewire itself.
                    In this case, we just need to update TipTap's
                    state and we're good to do.
                    For more information on the `setContent()` method, see:
                    https://www.tiptap.dev/api/commands/set-state
                */
                editor.commands.setContent(state, false);
            });
        },

        editor() {
            return editor;
        },

        isActive(type, options = {}) {
            return editor.isActive(type, options);
        },

        toggleBold() {
            editor.chain().focus().toggleBold().run();
        },

        toggleItalic() {
            editor.chain().focus().toggleItalic().run();
        },

        toggleStrike() {
            editor.chain().focus().toggleStrike().run();
        },

        setLink() {
            const previousUrl = editor.getAttributes('link').href;
            const url = window.prompt('URL', previousUrl);

            // cancelled
            if (url === null) {
                return;
            }

            // empty
            if (url === '') {
                editor.chain().focus().extendMarkRange('link').unsetLink().run();

                return;
            }

            // update link
            editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },

        toggleHeading(options) {
            editor.chain().toggleHeading(options).focus().run();
        },

        toggleBlockquote() {
            editor.chain().focus().toggleBlockquote().run();
        },

        toggleCodeBlock() {
            editor.chain().focus().toggleCodeBlock().run();
        },

        toggleBulletList() {
            editor.chain().focus().toggleBulletList().run();
        },

        toggleOrderedList() {
            editor.chain().focus().toggleOrderedList().run();
        },

        addImage() {
            const url = window.prompt('URL');

            if (url) {
                editor.chain().focus().setImage({ src: url }).run();
            }
        },
    };
}
