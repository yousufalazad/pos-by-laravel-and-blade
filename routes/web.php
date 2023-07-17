<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth','prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::delete('permissions_mass_destroy', [\App\Http\Controllers\Admin\PermissionController::class, 'massDestroy'])->name('permissions.mass_destroy');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::delete('roles_mass_destroy', [\App\Http\Controllers\Admin\RoleController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::delete('users_mass_destroy', [\App\Http\Controllers\Admin\UserController::class, 'massDestroy'])->name('users.mass_destroy');

    // categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::delete('categories_mass_destroy', [\App\Http\Controllers\Admin\CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

    // brands
    Route::resource('brands', \App\Http\Controllers\Admin\BranddController::class);
    Route::delete('brands_mass_destroy', [\App\Http\Controllers\Admin\BranddController::class, 'massDestroy'])->name('brands.mass_destroy');

    // products
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::delete('products_mass_destroy', [\App\Http\Controllers\Admin\ProductController::class, 'massDestroy'])->name('products.mass_destroy');

    // Supplier
    Route::resource('suppliers', \App\Http\Controllers\Admin\SupplierController::class);
    Route::delete('suppliers_mass_destroy', [\App\Http\Controllers\Admin\SupplierController::class, 'massDestroy'])->name('suppliers.mass_destroy');
    
    // Customer
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
    Route::delete('customers_mass_destroy', [\App\Http\Controllers\Admin\CustomerController::class, 'massDestroy'])->name('customers.mass_destroy');
    
    // Stocks
    Route::resource('stocks', \App\Http\Controllers\Admin\StockController::class);
    Route::delete('present_stock_mass_destroy', [\App\Http\Controllers\Admin\ProductOutController::class, 'massDestroy'])->name('stocks.mass_destroy');

    // Product in
    Route::resource('products_in', \App\Http\Controllers\Admin\ProductInController::class);
    Route::delete('products_in_mass_destroy', [\App\Http\Controllers\Admin\ProductInController::class, 'massDestroy'])->name('products_in.mass_destroy');

    // Products out
    Route::resource('products_out', \App\Http\Controllers\Admin\ProductOutController::class);
    Route::delete('products_out_mass_destroy', [\App\Http\Controllers\Admin\ProductOutController::class, 'massDestroy'])->name('products_out.mass_destroy');
});