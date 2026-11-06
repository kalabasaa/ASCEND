<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Public — no auth
Route::view('/', 'welcome')->name('home');
Route::view('/terms', 'legal.terms')->name('terms');

// Guest only (not logged in) — login/register
Route::middleware('guest')->group(function () {
    // login/register routes are already registered by Fortify
});

// Authenticated — any role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Admin only
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // admin\ controllers\ *
});

// Member only
Route::middleware(['auth', 'verified', 'user'])->prefix('member')->name('member.')->group(function () {
    // user\ controllers\ *
});

Route::view('/terms', 'legal.terms')->name('terms');

require __DIR__.'/settings.php';

