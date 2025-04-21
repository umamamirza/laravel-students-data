<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;


// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');  
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student routes (auth.custom middleware se protected)
Route::middleware('auth.custom')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index'); // Index method ko use kiya
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
});