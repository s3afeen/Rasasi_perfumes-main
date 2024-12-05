<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;


use Illuminate\Support\Facades\Auth;

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

Auth::routes();



// <!--==========================================  (HOME)  ========================================================================================================================-->
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// <!--==========================================  (Dashboard)  ============================================================================================================================-->
Route::get('/dashboard', function () {
    return view('layouts.dashboard_master');
})->name('dashboard')->middleware(['auth' , 'role']);




// <!--==========================================  (Users)  ===============================================================================================================-->
Route::resource('users', UserController::class)->middleware(['auth' , 'manager']);




// <!--==========================================  (profile)  ===============================================================================================================-->
// Route::get('/profile', [UserController::class, 'show_profile_dash'])->name('dashboard.profile.profile');---
// Route::get('/profile', [UserController::class, 'show_profile_dash'])->name('dashboard.profile.profile')->middleware(['auth' , 'role']);---

// Route::get('/profile', [UserController::class, 'show'])->name('profile.show');---
// Route::put('/profile', [UserController::class, 'update'])->name('profile.update');---



Route::get('/profile', [UserController::class, 'show_profile'])->name('profile.show');
Route::get('/profile_dashboard', [UserController::class, 'show_profile_dash'])->name('profile_dash.show')->middleware(['auth' , 'role']);
Route::put('/profile', [UserController::class, 'update_profile'])->name('profile.update');


// <!--==========================================  (contacts)  ===============================================================================================================-->
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); // List all contacts (dashboard)
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show'); // Show
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // Delete
});
// Public routes
// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create'); // Create form (user side)
// Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store'); // Create


// Route::get('/contact', function () {
//     return view('contact');
// })->name("contact");
