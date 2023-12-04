<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Volt::route('login', 'pages.auth.login')->name('login');

    Route::middleware(config('trecms.middleware', ['auth', 'verified']))->group(function () {
        Volt::route('dashboard', 'pages.dashboard')->name('dashboard');

        Volt::route('profile', 'pages.profile')->name('profile');

        Route::group(['prefix' => 'posts'], function () {
            Volt::route('/', 'pages.posts.index')->name('posts.index');
            Volt::route('create', 'pages.posts.create')->name('posts.create');
            Volt::route('{id}/edit', 'pages.posts.edit')->name('posts.edit');
        });
    });
});
