<?php

use function Livewire\Volt\layout;

layout('trecms::layouts.app');

?>

<section class="flex flex-col gap-y-8 py-8">
    <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">Profile</h1>
        </div>
    </header>

    <livewire:profile.update-profile-information-form />
</section>
