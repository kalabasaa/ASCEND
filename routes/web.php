<?php

use Illuminate\Support\Facades\Route;

// Public
Route::view('/', 'welcome')->name('home');
Route::view('/terms', 'legal.terms')->name('terms');

Route::get('/dev-login', function () {
    abort_unless(app()->environment('local'), 404);

    $user = \App\Models\User::firstOrNew(['username' => 'admin.renier']);
    $user->forceFill([
        'email' => 'admin.renier@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('Admin@12345'),
        'role' => 'admin',
    ])->save();

    \Illuminate\Support\Facades\Auth::login($user, true);

    return redirect('/admin/dashboard');
});

// Guest only — login/register (handled by Fortify)
Route::middleware('guest')->group(function () {
    // login/register routes are already registered by Fortify
});

// Authenticated — redirects to the correct dashboard by role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('user.dashboard'),
        };
    })->name('dashboard');
});

// Admin only
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('members', App\Http\Controllers\Admin\MemberController::class);
    Route::resource('trainers', App\Http\Controllers\Admin\TrainerController::class);
    Route::resource('plans', App\Http\Controllers\Admin\MembershipPlanController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    Route::resource('sales', App\Http\Controllers\Admin\SaleController::class)->only(['index', 'create', 'store', 'destroy']);
    // Subscription creation only — no index/edit per original scope
    Route::post('subscriptions', [App\Http\Controllers\Admin\SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::resource('payments', App\Http\Controllers\Admin\PaymentController::class)->only(['index', 'create', 'store']);
    Route::resource('visits', App\Http\Controllers\Admin\VisitController::class)->only(['index']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update', 'destroy']);
});

// Member only
Route::middleware(['auth', 'verified', 'user'])->prefix('member')->name('user.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('membership', [App\Http\Controllers\User\MembershipController::class, 'index'])->name('membership');

    Route::get('shop', [App\Http\Controllers\User\ShopController::class, 'index'])->name('shop.index');
    Route::get('shop/{product}', [App\Http\Controllers\User\ShopController::class, 'show'])->name('shop.show');

    Route::get('visits', [App\Http\Controllers\User\VisitController::class, 'index'])->name('visits');
    // Check-in action — one per day, enforced in the controller
    Route::post('visits/check-in', [App\Http\Controllers\User\VisitController::class, 'store'])->name('visits.store');

    // Read-only account summary page
    Route::get('profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
});


require __DIR__.'/settings.php';