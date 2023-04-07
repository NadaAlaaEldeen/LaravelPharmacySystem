<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserAdressController;
use App\Http\Controllers\UserOrderController;
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
})->middleware(['auth', 'role:admin|pharmacy|doctor']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/pharmacies/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('/pharmacies', [PharmacyController::class,"store"])->name("pharmacies.store");
    Route::get('/pharmacies/delete/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');

    Route::resource('users', UserController::class);
    Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('areas', AreaController::class);
    Route::get('/areas/delete/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

    Route::resource('addresses', UserAdressController::class);
    Route::get('/addresses/delete/{address}', [UserAdressController::class, 'destroy'])->name('addresses.destroy');
});

// ---------------------admin or pharmacy restriction on pharmcy-------------------
Route::group(["middleware" => ['role:admin|pharmacy']], function () {

    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/pharmacies/{pharmacy}', [PharmacyController::class,'show'])->name('pharmacies.show');
    Route::get('/pharmacies/edit/{pharmacy}', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::put('/pharmacies/{pharmacy}',[PharmacyController::class , 'update'])->name('pharmacies.update');
});
// ------------------------------------------------------------------------------------------
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'client']);
Auth::routes(['register' => false]);


Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// ------------------------------Medicines routes---------------------------------------//
Route::resource('medicines', MedicineController::class);
Route::get('/medicines/delete/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
//----------------------------------Doctors Routes----------------------------------------//
Route::get('/doctor', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/doctors', [DoctorController::class,"store"])->name("doctors.store");
Route::get('/doctors/{doctor}', [DoctorController::class,'show'])->name('doctors.show');
Route::get('/doctors/edit/{doctor}', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/doctors/{doctor}',[DoctorController::class , 'update'])->name('doctors.update');
Route::get('/doctors/delete/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

//----------------------------------Orders Routes----------------------------------------//
Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
Route::get('/order/create', [UserOrderController::class, 'create'])->name('orders.create');
Route::post('/order', [UserOrderController::class,'store'])->name("orders.store");
Route::get('/order/edit/{order}', [UserOrderController::class, 'edit'])->name('orders.edit');
Route::put('/order/{order}',[UserOrderController::class , 'update'])->name('orders.update');
Route::get('/order/delete/{order}', [UserOrderController::class, 'destroy'])->name('orders.destroy');


