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

    Route::get('/pharmacies', [PharmacyController::class, 'index'])->name('pharmacies.index');
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

// ------------------------------Medicines routes---------------------------------------//
Route::get("/medicines", [MedicineController::class, "index"])->name("medicines.index");
Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
Route::post('/medicines', [MedicineController::class,"store"])->name("medicines.store");
Route::get('/medicines/edit/{medicine}', [MedicineController::class, 'edit'])->name('medicines.edit');
Route::put('/medicines/{medicine}',[MedicineController::class , 'update'])->name('medicines.update');
Route::get('/medicines/delete/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

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
Route::get('/pharmacy/restore', [PharmacyController::class, 'restore'])->name('pharmacy.restore');
Route::put('/pharmacy/restore/{id}', [PharmacyController::class, 'restoreOne'])->name('pharmacy.restoreOne');
Route::post('/pharmacy', [PharmacyController::class,"store"])->name("pharmacy.store");
Route::get('/pharmacy/edit/{pharmacy}', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
Route::put('/pharmacy/{pharmacy}',[PharmacyController::class , 'update'])->name('pharmacy.update');
Route::get('/pharmacy/delete/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacy.destroy');

//----------------------------------Addresses Routes----------------------------------------//
Route::get('/address', [App\Http\Controllers\UserAdressController::class, 'index'])->name('address');
Route::get('/address/create', [UserAdressController::class, 'create'])->name('address.create');
Route::post('/address', [UserAdressController::class,'store'])->name("addresses.store");
Route::get('/address/edit/{address}', [UserAdressController::class, 'edit'])->name('address.edit');
Route::put('/address/{address}',[UserAdressController::class , 'update'])->name('address.update');
Route::get('/address/delete/{address}', [UserAdressController::class, 'destroy'])->name('address.destroy');

//-------------------------------Doctors Routes-------------------
Route::post('/doctors/{id}/ban',[DoctorController::class, 'ban'])->name('doctors.ban');
Route::post('/doctors/{id}/unban',[DoctorController::class, 'unban'])->name('doctors.unban');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');

//------------------------------Users Routes----------------------
Route::get('/users/status/{id}/{status_code}',[UserController::class ,'updateStatus'])->name('users.status.update');
 