<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\UserTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('products', ProductController::class)
    ->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class)
    ->middleware('auth:sanctum');

Route::post('sanctum/token', UserTokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('newsletter', [\App\Http\Controllers\NewsletterController::class, 'send'])->name('send.newsletter');

    Route::post('products/{product}/rate', [ProductRatingController::class, 'rate']);

    Route::post('products/{product}/unrate', [ProductRatingController::class, 'unrate']);

    Route::get('rating', [ProductRatingController::class, 'index']);


});

Route::get( '/server-error',function() {
    abort(500,'Huy no pa que hizo');
});
