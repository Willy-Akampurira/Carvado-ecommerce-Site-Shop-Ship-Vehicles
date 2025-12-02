<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\CarvadoTestMail;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\CheckoutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SearchController;
use App\Http\Controllers\Public\ShopController;
use App\Http\Controllers\Public\UserController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\Public\WishlistController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ClientController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Public-Facing Routes (Shop & Ship)
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop page — browse available cars
Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/category', [ShopController::class, 'filterByCategory'])->name('shop.byCategory');
    Route::get('/{car}', [ShopController::class, 'show'])->name('shop.show'); // ✅ View single car
});

// Cart functionality
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout flow
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Order confirmation & invoice
Route::prefix('order')->group(function () {
    Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('order.thankyou');
    Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('order.invoice');
});

// Global Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// About page
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Newsletter subscription
Route::get('/newsletter', [NewsletterController::class, 'showForm'])->name('newsletter.form');

// Legal pages
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

/*
|--------------------------------------------------------------------------
| Public User Account Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('account')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('account.index');
    Route::get('/edit', [UserController::class, 'edit'])->name('account.edit');
    Route::post('/update', [UserController::class, 'update'])->name('account.update');
});

/*
|--------------------------------------------------------------------------
| Wishlist Public Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('wishlist')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/add/{car}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/remove/{car}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

/*
|--------------------------------------------------------------------------
| Payment Gateway Integration Routes
|--------------------------------------------------------------------------
*/

Route::prefix('payment')->group(function () {
    Route::get('/confirmation/{order}/{trackingId?}', function ($order, $trackingId = null) {
        return view('public.payment-confirmation', compact('order', 'trackingId'));
    })->name('payment.confirmation');

    Route::get('/status/{trackingId}', [PaymentController::class, 'status'])->name('payment.status');
});

/*
|--------------------------------------------------------------------------
| Dashboard & Auth Routes (Admin Panel)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // 🎯 Role-aware dashboard redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->getRoleNames()->first();

        return match ($role) {
            'admin', 'Super Admin' => redirect()->route('admin.dashboard'),
            'worker' => redirect()->route('worker.dashboard'),
            'client' => redirect()->route('client.dashboard'),
            default => abort(403, 'Unauthorized role'),
        };
    })->name('dashboard');

    // 👤 Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Auth scaffolding
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Test Routes (Dev Only)
|--------------------------------------------------------------------------
*/

// ✅ Email test route
Route::get('/test-mail', function () {
    Mail::to('willyakampurira741@gmail.com')->send(new CarvadoTestMail('Willy'));
    return 'Test email sent!';
});

/*Route::get('/', function () {
    return view('welcome');
});
*/
// Admin Dashboard Routes
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.dashboard');

Route::get('/admin/orders', [AdminController::class, 'orders'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.orders');

Route::get('/admin/payments', [AdminController::class, 'payments'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.payments');

Route::get('/admin/users', [AdminController::class, 'users'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.users');

Route::get('/admin/inventory', [AdminController::class, 'inventory'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.inventory');

Route::get('/admin/analytics', [AdminController::class, 'analytics'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.analytics');

Route::get('/admin/notifications', [AdminController::class, 'notifications'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.notifications');

Route::get('/admin/logs', [AdminController::class, 'logs'])
    ->middleware(['auth', RoleMiddleware::class . ':admin'])
    ->name('admin.logs');

// Worker Dashboard
Route::get('/worker/dashboard', [WorkerController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':worker'])
    ->name('worker.dashboard');

// Client Dashboard
Route::get('/client/dashboard', [ClientController::class, 'index'])
    ->middleware(['auth', RoleMiddleware::class . ':client'])
    ->name('client.dashboard');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login'); // Redirects to login page after logout
})->name('logout');
