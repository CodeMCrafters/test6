<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerberController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

//Route for admin paner. //Show barbers  True
Route::get('AdminPanel',[AdminController::class, 'index'])->name('adminPanel');

//Route for admin panel. Create barbers
Route::post('AdminPanel/create/barbers',[AdminController::class, 'storeBarbers']);

//Route show salons.
Route::get('AdminPanel/showSalon',[AdminController::class, 'showSalon'])->name('adminPanel');

//Destroy barbers True
Route::delete('AdminPanel/deleteBarbers/{id}',[AdminController:: class, 'destroy'])->name('deleteBarber');

//Route for login  True
Route::post('login',[LoginController::class, 'login'])->name('login');    

Auth::routes(['verify' => true]);

//Route for Singin True
Route::post('singin',[UserController::class, 'store'])->name('singin');

//Route for barbers panel //Show booking!  True
Route::post('BerbersPanel/{date}/{id_frizer}',[BerberController::class,'index'])->name('BerbersPanel');

//Destroy booking True
Route::delete('booking/delete/{id}',[BookingController::class, 'destroy'])->name('deleteBooking');

//Route for read provides
Route::get('salon/provide/{id}',[SalonController::class, 'index']);

//Route for read barbers to booking
Route::get('salon/barbers/{id_salon}',[BerberController::class, 'show']);

// Route for show shift barbers    
Route::get('salon/barbers/{id_salon}/{id_frizer}',[BerberController::class, 'showShift']);

//Route for search booking for users
Route::get('salon/barbers/booking/{id_salons}/{id_frizer}/{date}',[BerberController::class, 'searchBooking']);

//Create booking True
Route::post('booking/create',[BookingController::class, 'storeBooking'])->name('createBooking');


//Route for read user booking
Route::get('booking/read/user/{id_user}',[BookingController::class, 'showBookingUser']);

// Route for salon Sisarkica
Route::post('Sisarkica/{id}',[SalonController::class, 'sisarkica']);

Route::get("/booking/statistic/{id_frizer}",[BookingController::class, 'statistic']);








