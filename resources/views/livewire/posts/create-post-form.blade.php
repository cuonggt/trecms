<?php

use Cuonggt\Trecms\Trecms;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'title' => '',
    'excerpt' => '',
    'content' => '',
]);

rules([
    'title' => ['required', 'string', 'max:255'],
    'excerpt' => ['string'],
    'content' => ['string'],
]);

$createPost = function () {
    $validated = $this->validate();

    $post = Trecms::newPostModel()->forceCreate([
        'user_id' => auth()->user()->id,
        'title' => $validated['title'],
        'excerpt' => $validated['excerpt'],
        'content' => $validated['content'],
        'status' => 'publish',
        'published_at' => now(),
    ]);

    session()->flash('notify', __('Post created successfully!'));

    return $this->redirect(route('admin.posts.edit', ['id' => $post->id]), true);
};

?>

<div>
    <div class="grid auto-cols-fr gap-y-8">
        <form wire:submit="createPost" class="grid gap-y-6">
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
                        <x-trecms::tiptap-editor
                            wire:model="content"
                            id="content"
                            class="block mt-1 w-full"
                            name="content"
                        />
                        <x-trecms::input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="gap-3 flex flex-wrap items-center justify-start">
                    <x-trecms::primary-button>
                        {{ __('Create') }}
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
