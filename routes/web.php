<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\DashboardController;

// Route for guest users
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::resource('books', \App\Http\Controllers\BookController::class)->except('index');

    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::resource('categories', CategoriesController::class)->except('index');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::resource('members', MemberController::class)->except('index');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class)->except('index');

    Route::resource('fines', FineController::class);

    Route::get('borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::put('borrows/{borrow}', [BorrowController::class, 'update'])->name('borrows.update');
    Route::delete('borrows/{borrow}', [BorrowController::class, 'destroy'])->name('borrows.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print/{type}', [ReportController::class, 'print'])->name('reports.print');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
