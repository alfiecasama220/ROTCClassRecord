<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceDataHandler;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrintableController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('/', LoginController::class);
Route::resource('/', LoginController::class, [
    'names' => [
        'index' => 'login',
    ]
]);

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
    // Route::post('/home/student/delete/{id}', [StudentController::class, 'deleteStudent'])->name('deleteStudent');

    // HOME
    Route::resource('/home', HomeController::class);

    // STORE
    Route::post('/home/{batch_id}', [StudentController::class, 'store']);

    // DASHBOARD

    Route::resource('/dashboard', DashboardController::class);

    Route::get('/home/student/{id}/{batch}', [StudentController::class, 'getStudent'])->name('getStudent');

    Route::patch('/home/student/edit/{id}/{batch}', [StudentController::class, 'editStudent'])->name('editStudent');

    Route::get('/home/print/{id}', [PrintableController::class, 'print'])->name('print');

});



