<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPurchaserController;
use App\Http\Controllers\PurchaserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('purchaser', [PurchaserController::class, 'store']);
Route::post('product', [ProductController::class, 'store']);
Route::post('purchaser-product', [ProductPurchaserController::class, 'store']);
Route::get('purchaser/{purchaser}/product', [ProductPurchaserController::class, 'index']);
