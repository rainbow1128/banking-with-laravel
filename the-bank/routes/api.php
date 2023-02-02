<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepositInterestController;
use App\Http\Controllers\TestApiController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'findOne']);
Route::post('users/create', [UserController::class, 'create']);

Route::get('transactions', [TransactionController::class, 'index']);
Route::get('transactions/{account}', [TransactionController::class, 'find']);

Route::get('accounts', [AccountController::class, 'index']);
Route::get('accounts/{account}', [AccountController::class, 'findOne']);
Route::post('accounts/create', [AccountController::class, 'create']);
Route::patch('accounts/interest/{account}', [DepositInterestController::class, 'update']);

Route::post('accounts/deposit', [AccountController::class, 'makeDeposit']);

// Route::post('accounts/create/apitest', [AccountController::class, 'createWithApi']);

// Route::get('testing/api', [TestApiController::class, 'index']);

//List statement web route
//build a simple FE that can call these BE routes w/ JS

//look into bus, command design patterns and try to incorporate
//continued testing
