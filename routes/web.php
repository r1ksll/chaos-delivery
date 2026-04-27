<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

// Главная страница
Route::get('/', [PageController::class, 'index'])->name('home');

// Смена города
Route::post('/set-city', function (Request $request) {
    session(['city' => $request->city]);
    return response()->json(['success' => true]);
});

// Страницы ресторана, категории, товара
Route::get('/restaurant/{id}', [PageController::class, 'restaurant'])->name('restaurant');
Route::get('/category/{slug}', [PageController::class, 'category'])->name('category');
Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

// Авторизация
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Профиль
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Заказы
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store')->middleware('auth');
Route::get('/order-success', function () {
    return view('order-success');
})->name('order.success');

// Админ-панель 
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // Пользователи
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    // Рестораны
    Route::get('/restaurants', [AdminController::class, 'restaurants'])->name('admin.restaurants');
    Route::get('/restaurants/create', [AdminController::class, 'createRestaurant'])->name('admin.restaurants.create');
    Route::post('/restaurants', [AdminController::class, 'storeRestaurant'])->name('admin.restaurants.store');
    Route::get('/restaurants/{id}/edit', [AdminController::class, 'editRestaurant'])->name('admin.restaurants.edit');
    Route::put('/restaurants/{id}', [AdminController::class, 'updateRestaurant'])->name('admin.restaurants.update');
    Route::delete('/restaurants/{id}', [AdminController::class, 'deleteRestaurant'])->name('admin.restaurants.delete');
    
    // Категории
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    
    // Товары
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Курьеры
    Route::get('/couriers', [AdminController::class, 'couriers'])->name('admin.couriers');
    Route::get('/couriers/create', [AdminController::class, 'createCourier'])->name('admin.couriers.create');
    Route::post('/couriers', [AdminController::class, 'storeCourier'])->name('admin.couriers.store');
    Route::get('/couriers/{id}/edit', [AdminController::class, 'editCourier'])->name('admin.couriers.edit');
    Route::put('/couriers/{id}', [AdminController::class, 'updateCourier'])->name('admin.couriers.update');
    Route::delete('/couriers/{id}', [AdminController::class, 'deleteCourier'])->name('admin.couriers.delete');
});