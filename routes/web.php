<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storefront\HomeController;
use App\Http\Controllers\Storefront\CatalogueController;
use App\Http\Controllers\Storefront\ProductController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Storefront\CheckoutController;
use App\Http\Controllers\Storefront\OrderTrackingController;
use App\Http\Controllers\Storefront\NewsController;
use App\Http\Controllers\Storefront\PageController;
use App\Http\Controllers\Storefront\CoaController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\OrderController;
use App\Http\Controllers\Account\AddressController;
use App\Http\Controllers\Account\ProfileController;

// ─── Home ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Catalogue ─────────────────────────────────────────────────────────────
Route::get('/products', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::get('/categories/{slug}', [CatalogueController::class, 'category'])->name('catalogue.category');

// ─── Products ──────────────────────────────────────────────────────────────
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// ─── COA file downloads (signed, no direct storage exposure) ───────────────
Route::get('/coa/{coa}/pdf',   [CoaController::class, 'pdf'])->name('coa.pdf');
Route::get('/coa/{coa}/image', [CoaController::class, 'image'])->name('coa.image');

// ─── Cart ──────────────────────────────────────────────────────────────────
Route::get( '/cart',         [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add',     [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update',  [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove',  [CartController::class, 'remove'])->name('cart.remove');

// ─── Checkout ──────────────────────────────────────────────────────────────
Route::get('/checkout',               [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process',      [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/thankyou/{ref}',[CheckoutController::class, 'thankyou'])->name('checkout.thankyou');

// ─── Stripe Webhook (excluded from CSRF in bootstrap/app.php) ──────────────
Route::post('/stripe/webhook', [CheckoutController::class, 'stripeWebhook'])->name('stripe.webhook');

// ─── Order Tracking (public — no login required) ───────────────────────────
Route::get( '/order/track', [OrderTrackingController::class, 'index'])->name('order.track');
Route::post('/order/track', [OrderTrackingController::class, 'lookup'])->name('order.track.lookup');

// ─── Customer Account Area ─────────────────────────────────────────────────
Route::middleware(['auth'])->prefix('account')->name('account.')->group(function () {
    Route::get('/',          [DashboardController::class, 'index'])->name('index');
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',   [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/orders',           [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{ref}',     [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{ref}/pdf', [OrderController::class, 'pdf'])->name('orders.pdf');

    Route::get('/addresses',          [AddressController::class, 'index'])->name('addresses');
    Route::post('/addresses',         [AddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{id}',     [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{id}',  [AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::post('/addresses/{id}/default', [AddressController::class, 'setDefault'])->name('addresses.default');
});

// ─── Auth (Laravel Breeze / custom) ────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [App\Http\Controllers\Auth\LoginController::class, 'showForm'])->name('login');
    Route::post('/login',   [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showForm'])->name('register');
    Route::post('/register',[App\Http\Controllers\Auth\RegisterController::class, 'register']);
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password',[App\Http\Controllers\Auth\ForgotPasswordController::class, 'send'])->name('password.email');
    Route::get('/reset-password/{token}',  [App\Http\Controllers\Auth\ResetPasswordController::class, 'showForm'])->name('password.reset');
    Route::post('/reset-password',         [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── News / Blog ───────────────────────────────────────────────────────────
Route::get('/news',       [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}',[NewsController::class, 'show'])->name('news.show');

// ─── Static Pages (catch-all — must be last) ───────────────────────────────
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
