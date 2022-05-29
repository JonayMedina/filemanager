<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Files;
use App\Http\Livewire\PdfUser;
use App\Http\Livewire\Users;
use App\Models\File;
use App\Models\User;

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
    return view('fm');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', function () {
            $users = User::count();
            $files = File::count();
            return view('dashboard', ['users' => $users, 'files' => $files]);
        })->name('dashboard');

        Route::prefix('file')->group(function () {
            Route::get('all', Files::class)->name('allFiles');
            Route::post('create', Files::class)->name('createFile');
            Route::put('update', Files::class)->name('updateFile');
            Route::delete('delete', Files::class)->name('deleteFile');
        });

        Route::prefix('user')->group(function () {
            Route::get('all', Users::class)->name('allUsers');
            Route::post('create', Users::class)->name('createUser');
            Route::put('update', Users::class)->name('updateUser');
            Route::delete('delete', Users::class)->name('deleteUser');
        });
    });

    Route::get('/home', PdfUser::class)->name('home');
});
