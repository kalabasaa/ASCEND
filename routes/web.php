<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MembershipPlanController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\User\MembershipController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShopController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Public
Route::view('/', 'welcome')->name('home');
Route::view('/terms', 'legal.terms')->name('terms');

Route::get('/dev-login', function () {
    abort_unless(app()->environment('local'), 404);

    $user = User::firstOrNew(['username' => 'admin.renier']);
    $user->forceFill([
        'email' => 'admin.renier@gmail.com',
        'password' => Hash::make('Admin@12345'),
        'role' => 'admin',
    ])->save();

    Auth::login($user, true);

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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('members', MemberController::class);
    Route::resource('trainers', TrainerController::class);
    Route::resource('plans', MembershipPlanController::class);
    Route::resource('products', ProductController::class);

    Route::resource('sales', SaleController::class)->only(['index', 'create', 'store', 'destroy']);
    // Subscription creation only — no index/edit per original scope
    Route::post('subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::resource('payments', PaymentController::class)->only(['index', 'create', 'store']);
    Route::resource('visits', VisitController::class)->only(['index']);
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
});

// Member only
Route::middleware(['auth', 'verified', 'user'])->prefix('member')->name('user.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('membership', [MembershipController::class, 'index'])->name('membership');

    Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('shop/{product}', [ShopController::class, 'show'])->name('shop.show');

    Route::get('visits', [App\Http\Controllers\User\VisitController::class, 'index'])->name('visits');
    // Check-in action — one per day, enforced in the controller
    Route::post('visits/check-in', [App\Http\Controllers\User\VisitController::class, 'store'])->name('visits.store');

    // Read-only account summary page
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/settings.php';
