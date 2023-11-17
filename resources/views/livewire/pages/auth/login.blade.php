<?php

use Cuonggt\Trecms\Livewire\Forms\LoginForm;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use Illuminate\Support\Facades\Session;

layout('trecms::layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirect(
        session('url.intended', route('admin.dashboard')),
        navigate: true
    );
};

?>

<div>
    <!-- Session Status -->
    <x-trecms::auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-trecms::input-label for="email" :value="__('Email')" />
            <x-trecms::text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-trecms::input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-trecms::input-label for="password" :value="__('Password')" />

            <x-trecms::text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-trecms::input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-trecms::primary-button class="ms-3">
                {{ __('Log in') }}
            </x-trecms::primary-button>
        </div>
    </form>
</div>
