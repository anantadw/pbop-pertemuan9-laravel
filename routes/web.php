<?php

use App\Http\Controllers\Auth\LoginBorrowerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    // return view('welcome');
    return redirect('login');
});

Route::get('/login/admin', function() {
    return view('auth.login-admin');
})->middleware('guest')->name('login-admin');

Route::post('/login-borrower', [LoginBorrowerController::class, 'login'])->middleware('guest')->name('login-borrower');
Route::post('/logout-borrower', [LoginBorrowerController::class, 'logout'])->middleware('auth:borrower')->name('logout-borrower');

Auth::routes();

Route::prefix('admin')->middleware(['auth:web'])->group(function() {
    Route::get('/dashboard', function() {
        return view('home');
    })->name('home');

    // Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');

    Route::get('/books/generate-pdf', [BookController::class, 'generatePDF'])->name('books.generate-pdf');
    Route::resource('books', BookController::class);

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/create', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/return/{id}', [TransactionController::class, 'return'])->name('transactions.return');
    Route::post('/transactions/return/{id}', [TransactionController::class, 'finishTransaction'])->name('transactions.finish');
    // Route::get('/sending-queue-emails', [TestQueueEmails::class, 'sendTestEmails']);
});

Route::prefix('borrower')->middleware(['auth:borrower'])->group(function() {
    Route::get('/index', [BorrowerController::class, 'index'])->name('borrower.index');
    Route::get('/history', [BorrowerController::class, 'history'])->name('borrower.history');
});