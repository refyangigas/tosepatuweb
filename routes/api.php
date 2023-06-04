<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function(){
//     Route::get('login', [AuthController::class,'login'])->name('login');
//     Route::post('login', [AuthController::class,'login'])->name('login');
// });

// Route::group([
//     'middleware'=>'api'
// ],

// function(){
//     Route::resources([
//        'categories'=>CategoryController::class,
//        'subcategories'=>subcategoryController::class
//     ]);
// });

Route::post('/login', [LoginController::class, 'login']);