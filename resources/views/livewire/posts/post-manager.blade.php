<?php

use Cuonggt\Trecms\Trecms;
use function Livewire\Volt\usesPagination;
use function Livewire\Volt\with;

usesPagination();

with(fn () => [
    'posts' => Trecms::newPostModel()->latest()->paginate(),
]);

?>

<div>
    <div class="grid auto-cols-fr gap-y-8">
        <div class="flex flex-col gap-y-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                    {{ __('Title') }}
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Author') }}
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-0"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                    {{ $post->title }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $post->author->name }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}" class="text-indigo-600 hover:text-indigo-900" wire:navigate>
                                        {{ __('Edit') }}<span class="sr-only">, {{ $post->title }}</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
