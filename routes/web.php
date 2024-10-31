<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'main')->name('main');
Route::get('/', [HomeController::class, 'index'])->name('main');
Route::view('/login', 'login')->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/project/{post:title}', [PostController::class, 'show'])
    ->name('show-post');
Route::view('/contact', 'contact')->name('contact');

Route::post('/mail', [MailController::class, 'sendContactMail'])->name('mail');

Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function (): void
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
    Route::get('/project/{post:title}/edit', [PostController::class, 'edit'])
        ->name('edit-post');

    Route::get('/link', function () 
    {        
        $target = '/htdocs/storage/app/public';
        $shortcut = '/htdocs/public/storage';
        symlink($target, $shortcut);
    });
        
});