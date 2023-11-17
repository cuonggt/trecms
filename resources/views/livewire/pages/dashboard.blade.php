<?php

use function Livewire\Volt\layout;

layout('trecms::layouts.app');

?>

<section class="flex flex-col gap-y-8 py-8">
    <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">Dashboard</h1>
        </div>
    </header>

    <div>
        <div class="grid auto-cols-fr gap-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <section class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                        <div>
                            <div class="p-6">
                                <div class="flex items-center gap-x-3">
                                    <img class="object-cover object-center rounded-full h-10 w-10" src="{{ Auth::user()->profile_photo_url }}" />
                                    <div class="flex-1">
                                        <h2 class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                            {{ __('Welcome') }}
                                        </h2>

                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ Auth::user()->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-span-1">
                    <section class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                        <div>
                            <div class="p-6">
                                <div class="flex items-center gap-x-3">
                                    <div class="flex-1">
                                        <a href="https://trecms.com" rel="noopener noreferrer" target="_blank" class="text-xl font-bold leading-5 tracking-tight text-gray-950">
                                            TreCMS
                                        </a>

                                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ \Cuonggt\Trecms\Trecms::version() }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-end gap-y-1">
                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
