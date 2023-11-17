<?php

use Cuonggt\Trecms\Trecms;
use function Livewire\Volt\layout;
use function Livewire\Volt\state;
use function Livewire\Volt\with;

layout('trecms::layouts.app');

state('id');

with(fn () => [
    'post' => Trecms::newPostModel()->findOrFail($this->id),
]);

?>
<section class="flex flex-col gap-y-8 py-8">
    <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <nav class="mb-2 hidden sm:block" aria-label="Breadcrumb">
                <ol role="list" class="flex flex-wrap items-center gap-x-2">
                    <li class="flex gap-x-2">
                        <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus-visible:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus-visible:text-gray-200" wire:navigate>
                            {{ __('Posts') }}
                        </a>
                    </li>
                    <li class="flex gap-x-2">
                        <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-500 outline-none transition duration-75 hover:text-gray-700 focus-visible:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus-visible:text-gray-200">
                            {{ __('Edit') }}
                        </span>
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">{{ __('Edit Post') }}</h1>
        </div>
        <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
            <x-trecms::danger-button
                x-data=""
                @click="$dispatch('open-modal', 'confirm-post-deletion')"
            >
                Delete
            </x-trecms::danger-button>
        </div>
    </header>

    <livewire:posts.edit-post-form :post="$post" />
    <livewire:posts.delete-post-form :post="$post" />
</section>
