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
    // Route::get('/admin', function () {
    //     return view('Admin/index');
    // })->name('admins.index');
    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/addresses', [UserAdressController::class, 'index'])->name('addresses.index');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
});

// Route::group(['middleware' => ['auth', 'role:doctor']], function () {
//     Route::get('/doctor', function () {
//         return view('Doctor/index');
//     })->name('doctors.index');
// });

// Route::group(['middleware' => ['auth', 'role:pharmacy']], function () {
//     Route::get('/pharmacy', function () {
//         return view('Pharmacy/index');
//     })->name('pharmacies.index');
// });


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// ------------------------------Medicines routes---------------------------------------//
Route::get("/medicines", [MedicineController::class, "index"])->name("medicines.index");
Route::get('/medicine/create', [MedicineController::class, 'create'])->name('medicine.create');
Route::post('/medicine', [MedicineController::class,"store"])->name("medicine.store");
Route::get('/medicine/edit/{medicine}', [MedicineController::class, 'edit'])->name('medicine.edit');
Route::put('/medicine/{medicine}',[MedicineController::class , 'update'])->name('medicine.update');
Route::get('/medicine/delete/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.destroy');

// ------------------------------Areas routes----------------------------------------//
Route::get('/area', [App\Http\Controllers\AreaController::class, 'index'])->name('areas');
Route::get('/area/create', [AreaController::class, 'create'])->name('areas.create');
Route::post('/area', [AreaController::class,"store"])->name("areas.store");
Route::get('/area/edit/{area}', [AreaController::class, 'edit'])->name('areas.edit');
Route::put('/area/{area}',[AreaController::class , 'update'])->name('areas.update');
Route::get('/area/delete/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

// ------------------------------Pharmacies routes----------------------------------------//
Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
Route::get('/pharmacy/create', [PharmacyController::class, 'create'])->name('pharmacy.create');
Route::post('/pharmacy', [PharmacyController::class,"store"])->name("pharmacy.store");
Route::get('/pharmacy/edit/{pharmacy}', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
Route::put('/pharmacy/{pharmacy}',[PharmacyController::class , 'update'])->name('pharmacy.update');
Route::get('/pharmacy/delete/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacy.destroy');

//----------------------------------Doctor Routes----------------------------------------//
