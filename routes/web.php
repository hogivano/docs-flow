<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Login;
use App\Http\Livewire\Home;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Roles\Index as RolesIndex;
use App\Http\Livewire\Admin\Roles\Form as RolesForm;
use App\Http\Livewire\Admin\User\Index as UserIndex;
use App\Http\Livewire\Admin\User\Form as UserForm;
use App\Http\Livewire\Admin\Application\Index as AppIndex;
use App\Http\Livewire\Admin\Application\Form as AppForm;
use App\Http\Livewire\Admin\Process\Index as ProcessIndex;
use App\Http\Livewire\Logout;

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

Route::get('/', Home::class)->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/logout', Logout::class)->name('logout');

Route::middleware('auth')->prefix('admin')->group(function() {
    Route::get('/', Dashboard::class)->name('dashboard');

    Route::prefix('process')->name('process')->group(function() {
        Route::get('/{application_id}', ProcessIndex::class)->name('.index');
    });

    Route::prefix('application')->name('application')->group(function() {
        Route::get('/', AppIndex::class)->name('.index');
        Route::get('create', AppForm::class)->name('.create');
        Route::get('edit/{id}', AppForm::class)->name('.edit');
    });
    Route::prefix('roles')->name('roles')->group(function() {
        Route::get('/', RolesIndex::class)->name('.index');
        Route::get('create', RolesForm::class)->name('.create');
        Route::get('edit/{id}', RolesForm::class)->name('.edit');
    });
    Route::prefix('user')->name('user')->group(function() {
        Route::get('/', UserIndex::class)->name('.index');
        Route::get('create', UserForm::class)->name('.create');
        Route::get('edit/{id}', UserForm::class)->name('.edit');
    });
});
