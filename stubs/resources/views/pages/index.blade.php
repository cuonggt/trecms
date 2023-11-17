<?php

use App\Models\Post;

use function Laravel\Folio\name;
use function Livewire\Volt\with;

name('home');

with([
    'posts' => fn () => Post::latest()->get(),
]);

?>

<x-app-layout>
    @volt('posts')
        <div>
            @foreach ($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post]) }}" class="no-underline transition block border border-lighter w-full mb-10 p-5 rounded post-card" wire:navigate>
                <div class="flex flex-col justify-between flex-1">
                    <div>
                        <h2 class="leading-normal block mb-6 text-2xl font-bold">{{ $post->title }}</h2>
                        @if ($post->excerpt)
                        <p class="mb-6 leading-loose">{{ $post->excerpt }}</p>
                        @endif
                    </div>
                    <div class="flex justify-end text-sm text-light">{{ $post->created_at->format('M Y') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    @endvolt
</x-app-layout>
