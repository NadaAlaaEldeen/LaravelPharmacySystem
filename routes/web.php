<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware(['auth']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', function () {
        return view('Admin/index');
    })->name('admins.index');
});

Route::group(['middleware' => ['auth', 'role:doctor']], function () {
    Route::get('/doctor', function () {
        return view('Doctor/index');
    })->name('doctors.index');
});

Route::group(['middleware' => ['auth', 'role:pharmacy']], function () {
    Route::get('/pharmacy', function () {
        return view('Pharmacy/index');
    })->name('pharmacies.index');
});

Route::group(['middleware' => ['auth', 'role:client']], function () {
    Route::get('/client', function () {
        return view('client');
    })->name('clients.index');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

// Route::get('/register', function() {
//     return redirect('/login');
// });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
Route::get('users', [UserController::class, 'index'])->name('users.index');
