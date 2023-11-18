<?php

use function Livewire\Volt\mount;
use function Livewire\Volt\state;
use Illuminate\Validation\Rule;

state(['post', 'title', 'slug', 'excerpt', 'content']);

mount(function ($post) {
    $this->post = $post;
    $this->title = $this->post->title;
    $this->slug = $this->post->slug;
    $this->excerpt = $this->post->excerpt;
    $this->content = $this->post->content;
});

$updatePost = function () {
    $validated = $this->validate([
        'title' => ['required', 'string', 'max:255'],
        'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($this->post)],
        'excerpt' => ['string'],
        'content' => ['string'],
    ]);

    $this->post->update([
        'title' => $validated['title'],
        'slug' => $validated['slug'],
        'excerpt' => $validated['excerpt'],
        'content' => $validated['content'],
    ]);

    $this->dispatch('notify', __('Post updated successfully!'));
};

?>

<div>
    <div class="grid auto-cols-fr gap-y-8">
        <form wire:submit="updatePost" class="grid gap-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div>
                        <x-trecms::input-label for="title">
                            {{ __('Title') }}
                            <sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                        </x-trecms::input-label>
                        <x-trecms::text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                        <x-trecms::input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-1">
                    <div>
                        <x-trecms::input-label for="slug">
                            {{ __('Slug') }}
                            <sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                        </x-trecms::input-label>
                        <x-trecms::text-input wire:model="slug" id="slug" class="block mt-1 w-full" type="text" name="slug" required />
                        <x-trecms::input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-full">
                    <div>
                        <x-trecms::input-label for="excerpt">
                            {{ __('Excerpt') }}
                        </x-trecms::input-label>
                        <x-trecms::textarea wire:model="excerpt" id="excerpt" class="block mt-1 w-full" type="text" name="excerpt" />
                        <x-trecms::input-error :messages="$errors->get('excerpt')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-full">
                    <div>
                        <x-trecms::input-label for="content">
                            {{ __('Content') }}
                        </x-trecms::input-label>
                        <div>
                        <x-trecms::tiptap-editor
                            wire:model="content"
                            class="block mt-1 w-full"
                        />
                        </div>
                        <x-trecms::input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="gap-3 flex flex-wrap items-center justify-start">
                    <x-trecms::primary-button>
                        {{ __('Save changes') }}
                    </x-trecms::primary-button>

                    <a href="{{ route('admin.posts.index') }}" wire:navigate>
                        <x-trecms::secondary-button>
                            {{ __('Cancel') }}
                        </x-trecms::secondary-button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
