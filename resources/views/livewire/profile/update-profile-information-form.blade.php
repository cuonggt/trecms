<?php

use Cuonggt\Trecms\Trecms;

use function Livewire\Volt\state;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

state([
    'name' => fn () => auth()->user()->name,
    'email' => fn () => auth()->user()->email,
]);

$updateProfileInformation = function () {
    $user = Auth::user();

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Trecms::userModel())->ignore($user->id)],
    ]);

    $user->fill($validated);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $this->dispatch('notify', 'Profile updated!');
};

?>

<div>
    <div class="grid auto-cols-fr gap-y-8">
        <form wire:submit="updateProfileInformation" class="grid gap-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div>
                        <x-trecms::input-label for="name">
                            {{ __('Name') }}
                            <sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                        </x-trecms::input-label>
                        <x-trecms::text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        <x-trecms::input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-1">
                    <div>
                        <x-trecms::input-label for="email">
                            {{ __('Email') }}
                            <sup class="text-red-600 dark:text-red-400 font-medium">*</sup>
                        </x-trecms::input-label>
                        <x-trecms::text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                        <x-trecms::input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <div class="gap-3 flex flex-wrap items-center justify-start">
                    <x-trecms::primary-button>
                        {{ __('Save changes') }}
                    </x-trecms::primary-button>

                    <a href="{{ route('admin.dashboard') }}" wire:navigate>
                        <x-trecms::secondary-button>
                            {{ __('Cancel') }}
                        </x-trecms::secondary-button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
