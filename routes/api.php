<?php

use Illuminate\Support\Facades\Route;

/**
 * Modules
 */

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\ProductCategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\EmployeesController;
use App\Http\Controllers\API\EmployeePayslipsController;


Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');

        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', [AuthController::class, 'logout'])->name('api.auth.logout');
        });
    });

    Route::get('products/{category}', [ProductsController::class, 'getProductsByCategory'])->name('api.products.get-by-category');
    Route::apiResources([
        'products' => ProductsController::class,
        'product-categories' => ProductCategoriesController::class,
        'orders' => OrdersController::class,
        'employees' => EmployeesController::class,
        'employee-payslips' => EmployeePayslipsController::class,
    ]);
});
