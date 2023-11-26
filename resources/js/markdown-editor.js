import 'codemirror';
import 'codemirror/addon/mode/overlay';
import 'codemirror/addon/edit/continuelist';
import 'codemirror/addon/display/placeholder';
import 'codemirror/addon/selection/mark-selection';
import 'codemirror/addon/search/searchcursor';
import 'codemirror/mode/clike/clike';
import 'codemirror/mode/cmake/cmake';
import 'codemirror/mode/css/css';
import 'codemirror/mode/diff/diff';
import 'codemirror/mode/django/django';
import 'codemirror/mode/dockerfile/dockerfile';
import 'codemirror/mode/gfm/gfm';
import 'codemirror/mode/go/go';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/mode/http/http';
import 'codemirror/mode/javascript/javascript';
import 'codemirror/mode/jinja2/jinja2';
import 'codemirror/mode/jsx/jsx';
import 'codemirror/mode/markdown/markdown';
import 'codemirror/mode/nginx/nginx';
import 'codemirror/mode/pascal/pascal';
import 'codemirror/mode/perl/perl';
import 'codemirror/mode/php/php';
import 'codemirror/mode/protobuf/protobuf';
import 'codemirror/mode/python/python';
import 'codemirror/mode/ruby/ruby';
import 'codemirror/mode/rust/rust';
import 'codemirror/mode/sass/sass';
import 'codemirror/mode/shell/shell';
import 'codemirror/mode/sql/sql';
import 'codemirror/mode/stylus/stylus';
import 'codemirror/mode/swift/swift';
import 'codemirror/mode/vue/vue';
import 'codemirror/mode/xml/xml';
import 'codemirror/mode/yaml/yaml';
import EasyMDE from 'easymde';
import '../css/markdown-editor.css';

export default function markdownEditor({ state }) {
    return {
        editor: null,

        state,

        init: async function () {
            this.editor = new EasyMDE({
                autoDownloadFontAwesome: false,
                autoRefresh: true,
                autoSave: false,
                element: this.$refs.editor,
                initialValue: this.state ?? '',
                minHeight: '12rem',
                previewImagesInEditor: true,
                spellChecker: false,
                toolbar: this.getToolbar(),
            });

            this.editor.codemirror.setOption(
                'direction',
                document.documentElement?.dir ?? 'ltr',
            );

            // When creating a link, highlight the URL instead of the label:
            this.editor.codemirror.on('changes', (instance, changes) => {
                try {
                    const lastChange = changes[changes.length - 1];

                    if (lastChange.origin === '+input') {
                        const urlPlaceholder = '(https://)';
                        const urlLineText =
                            lastChange.text[lastChange.text.length - 1];

                        if (
                            urlLineText.endsWith(urlPlaceholder) &&
                            urlLineText !== '[]' + urlPlaceholder
                        ) {
                            const from = lastChange.from;
                            const to = lastChange.to;
                            const isSelectionMultiline =
                                lastChange.text.length > 1;
                            const baseIndex = isSelectionMultiline ? 0 : from.ch;

                            setTimeout(() => {
                                instance.setSelection(
                                    {
                                        line: to.line,
                                        ch:
                                            baseIndex +
                                            urlLineText.lastIndexOf('(') +
                                            1,
                                    },
                                    {
                                        line: to.line,
                                        ch:
                                            baseIndex +
                                            urlLineText.lastIndexOf(')'),
                                    },
                                );
                            }, 25);
                        }
                    }
                } catch (error) {
                    // Revert to original behaviour.
                }
            });

            this.editor.codemirror.on(
                'change',
                window.Alpine.debounce(() => {
                    if (!this.editor) {
                        return;
                    }

                    this.state = this.editor.value();
                }, 300),
            );

            this.$watch('state', () => {
                if (!this.editor) {
                    return;
                }

                if (this.editor.codemirror.hasFocus()) {
                    return;
                }

                this.editor.value(this.state ?? '');

                // There is an issue with the editor not rendering the content
                // until after it is focused. All solutions online have been
                // attempted and none have worked so far.
            });
        },

        destroy: function () {
            this.editor.cleanup();
            this.editor = null;
        },

        getToolbar: function () {
            let toolbar = [];

            toolbar.push({
                name: 'bold',
                action: EasyMDE.toggleBold,
            });

            toolbar.push({
                name: 'italic',
                action: EasyMDE.toggleItalic,
            });

            toolbar.push({
                name: 'strikethrough',
                action: EasyMDE.toggleStrikethrough,
            });

            toolbar.push({
                name: 'link',
                action: EasyMDE.drawLink,
            });

            toolbar.push('|');

            toolbar.push({
                name: 'heading',
                action: EasyMDE.toggleHeadingSmaller,
            });

            toolbar.push('|');

            toolbar.push({
                name: 'quote',
                action: EasyMDE.toggleBlockquote,
            });

            toolbar.push({
                name: 'code',
                action: EasyMDE.toggleCodeBlock,
            });

            toolbar.push({
                name: 'unordered-list',
                action: EasyMDE.toggleUnorderedList,
            });

            toolbar.push({
                name: 'ordered-list',
                action: EasyMDE.toggleOrderedList,
            });

            toolbar.push('|');

            toolbar.push({
                name: 'table',
                action: EasyMDE.drawTable,
            });

            toolbar.push({
                name: 'image',
                action: EasyMDE.drawImage,
            });

            toolbar.push('|');

            toolbar.push({
                name: 'undo',
                action: EasyMDE.undo,
            });

            toolbar.push({
                name: 'redo',
                action: EasyMDE.redo,
            });

            return toolbar;
        },
    };
}
