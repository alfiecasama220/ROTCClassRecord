<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceDataHandler;
use App\Http\Controllers\HomeController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', LoginController::class);

// LOGIN
Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth'])->group(function () {

    // HANDLER
    Route::post('/handler', [AttendanceDataHandler::class, 'handler'])->name('handler');

    // SEARCH
    Route::post('/home/search/{id}', [AttendanceDataHandler::class, 'search'])->name('search');

    // STUDENTS
    Route::resource('/addStudents', StudentController::class);

    // HOME
    Route::resource('/home', HomeController::class);

    // STORE
    Route::post('/home/{batch_id}', [StudentController::class, 'store']);

    // DASHBOARD

    Route::resource('/dashboard', DashboardController::class);
});



