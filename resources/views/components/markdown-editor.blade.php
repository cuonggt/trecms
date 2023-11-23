<div
    x-data="markdownEditor({
        state: $wire.entangle('{{ $attributes->wire('model')->value() }}')
    })"
    wire:ignore
    {!! $attributes->whereDoesntStartWith('wire:model') !!}
>
    <textarea x-ref="editor" class="hidden"></textarea>
</div>
