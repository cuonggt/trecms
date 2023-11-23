<div
    x-data="markdownEditor({
        state: $wire.entangle('{{ $attributes->wire('model')->value() }}')
    })"
    wire:ignore
    {!! $attributes->whereDoesntStartWith('wire:model')->merge(['class' => 'max-w-full overflow-hidden rounded-lg bg-white font-mono text-base text-gray-950 shadow-sm ring-1 transition duration-75 focus-within:ring-2 dark:bg-white/5 dark:text-white sm:text-sm ring-gray-950/10 focus-within:ring-gray-600 dark:ring-white/20 dark:focus-within:ring-gray-500']) !!}
>
    <textarea x-ref="editor" class="hidden"></textarea>
</div>
