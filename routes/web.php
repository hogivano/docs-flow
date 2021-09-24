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
use App\Http\Livewire\Admin\Application\Detail as AppDetail;
use App\Http\Livewire\Admin\Application\Form as AppForm;
use App\Http\Livewire\Admin\Process\Index as ProcessIndex;
use App\Http\Livewire\Admin\Process\Form as ProcessForm;
use App\Http\Livewire\Admin\Process\Detail as ProcessDetail;
use App\Http\Livewire\Admin\BaseAction\Index as BaseActionIndex;
use App\Http\Livewire\Admin\BaseAction\Form as BaseActionForm;
use App\Http\Livewire\Admin\ProcessAction\Form as ProcessActionForm;
use App\Http\Controllers\ProcessController;
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

    Route::prefix('process-action')->name('process-action')->group(function() {
        Route::get('/create/{process_id}', ProcessActionForm::class)->name('.create');
        Route::get('/edit/{id}', ProcessActionForm::class)->name('.edit');
        Route::get('edit/{id}/process/{process_id}', ProcessActionForm::class)->name('.edit-byProcessId');
    });

    Route::prefix('process')->name('process')->group(function() {
        Route::get('/', ProcessIndex::class)->name('.index');
        Route::get('/create', ProcessForm::class)->name('.create');
        Route::get('create/{application_id}', ProcessForm::class)->name('.create.application');
        Route::get('/edit/{id}', ProcessForm::class)->name('.edit');
        Route::post('/change-order', [ProcessController::class, 'changeOrder'])->name('.change-order');
        Route::get('/{id}', ProcessDetail::class)->name('.detail');
    });

    Route::prefix('application')->name('application')->group(function() {
        Route::get('/', AppIndex::class)->name('.index');
        Route::get('create', AppForm::class)->name('.create');
        Route::get('edit/{id}', AppForm::class)->name('.edit');
        Route::get('/{id}', AppDetail::class)->name('.detail');
    });

    Route::prefix('base-action')->name('base-action')->group(function() {
        Route::get('/', BaseActionIndex::class)->name('.index');
        Route::get('create', BaseActionForm::class)->name('.create');
        Route::get('edit/{id}', BaseActionForm::class)->name('.edit');
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
