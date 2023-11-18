<?php

use function Livewire\Volt\state;

state('post');

$deletePost = function () {
    $this->post->delete();

    session()->flash('notify', 'Post deleted successfully!');

    return $this->redirect(route('admin.posts.index'), true);
};

?>

<div>
    <x-trecms::confirmation-modal name="confirm-post-deletion">
        <x-slot name="title">
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this post?') }}
        </x-slot>

        <x-slot name="footer">
            <x-trecms::secondary-button x-on:click="$dispatch('close')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-trecms::secondary-button>

            <x-trecms::danger-button class="ms-3" wire:click="deletePost" wire:loading.attr="disabled">
                {{ __('Delete Post') }}
            </x-trecms::danger-button>
        </x-slot>
    </x-trecms::confirmation-modal>
</div>
