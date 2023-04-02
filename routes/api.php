<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Api\AddressController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Auth::routes(['verify' => true]);
Route::post('users', [ClientController::class, 'store']);
Route::put('users/{users}', [ClientController::class, 'update'])->name('users.update')->middleware('auth:sanctum');

Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend/{id}', [VerificationController::class, 'resend'])->name('verification.resend');


Route::post('address', [AddressController::class, 'create'])->name('addresses.create');
Route::get('address', [AddressController::class, 'index'])->name('addresses.index');
Route::put('address/{id}', [AddressController::class, 'update'])->name('addresses.update');
Route::delete('address/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
