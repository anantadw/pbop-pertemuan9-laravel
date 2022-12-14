<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TestQueueEmails;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('home');

    // Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');
    Route::get('/books/generate-pdf', [BookController::class, 'generatePDF'])->name('books.generate-pdf');
    Route::resource('books', BookController::class);
});

Route::get('gambar/{filename}', [BookController::class, 'displayGambar'])->name('gambar.displayGambar');

Route::get('sending-queue-emails', [TestQueueEmails::class,'sendTestEmails']);