<?php

use function Laravel\Folio\name;

name('posts.show');

?>

<x-app-layout>
    <h1 class="mb-5 text-3xl font-bold">{{ $post->title }}</h1>
    <div class="flex items-center text-sm text-light">{{ $post->created_at->format('M Y') }}</div>
    <div class="mt-5 leading-loose flex flex-col justify-center items-center post-body">
        {!! $post->content !!}
    </div>
</x-app-layout>
