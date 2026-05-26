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
| Public-Facing Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/category', [ShopController::class, 'filterByCategory'])->name('shop.byCategory');
    Route::get('/{car}', [ShopController::class, 'show'])->name('shop.show');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

Route::prefix('order')->group(function () {
    Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('order.thankyou');
    Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('order.invoice');
});

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/newsletter', [NewsletterController::class, 'showForm'])->name('newsletter.form');
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('account.index');
        Route::get('/edit', [UserController::class, 'edit'])->name('account.edit');
        Route::post('/update', [UserController::class, 'update'])->name('account.update');
    });

    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/add/{car}', [WishlistController::class, 'add'])->name('wishlist.add');
        Route::post('/remove/{car}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    });

    // 🎯 Role-aware dashboard redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $role = $user->getRoleNames()->first();
        return match ($role) {
            'admin', 'Super Admin' => redirect()->route('admin.dashboard'),
            'worker' => redirect()->route('worker.dashboard'),
            'client' => redirect()->route('client.dashboard'),
            default => abort(403, 'Unauthorized role'),
        };
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Role-Protected Dashboards (Admin, Worker, Client)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
});

Route::middleware(['auth', RoleMiddleware::class . ':worker'])->get('/worker/dashboard', [WorkerController::class, 'index'])->name('worker.dashboard');
Route::middleware(['auth', RoleMiddleware::class . ':client'])->get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

/*
|--------------------------------------------------------------------------
| System & Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

Route::get('/test-mail', function () {
    Mail::to('willyakampurira741@gmail.com')->send(new CarvadoTestMail('Willy'));
    return 'Test email sent!';
});