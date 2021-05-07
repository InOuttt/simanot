<?php

use App\Http\Controllers\LocaleController;
use Tabuna\Breadcrumbs\Trail;
use App\Domains\Notaris\Http\Backend\Controllers\NotarisController;
use App\Domains\AktaNotaris\Http\Backend\Controllers\AktaNotarisController;
use App\Domains\Notaris\Models\Notaris;
use App\Domains\Notaris\Models\AktaNotaris;
use App\Http\Livewire\NotarisSelect2;
/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

/**
 * app routes
 */

Route::get('/notaris/select2', NotarisSelect2::class);
Route::get('/notaris/autocomplete', [NotarisSelect2::class, 'selectSearch']);

Route::group([
    'prefix' => 'notaris',
    'as' => 'notaris.',

], function () {
    Route::get('/', [NotarisController::class, 'index'])
        ->name('index')
        ->middleware('permission:admin.access.akta_notaris.list')            
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Notaris'), route('notaris.index'));
        });
    Route::get('create', [NotarisController::class, 'create'])
        ->name('create')
        ->middleware('permission:admin.access.notaris.create');
    Route::post('/', [NotarisController::class, 'store'])
        ->name('store')
        ->middleware('permission:admin.access.notaris.create');
    Route::group(['prefix' => '{notaris}'], function () {
        Route::get('edit', [NotarisController::class, 'edit'])
            ->name('edit')
            ->breadcrumbs(function (Trail $trail, Notaris $data) {
                $trail->parent('notaris.index') 
                    ->push(__('Editing :notaris', ['notaris' => $data->name]), route('notaris.edit', $data));
            });

        Route::patch('/', [NotarisController::class, 'update'])->name('update');
        Route::delete('/', [NotarisController::class, 'destroy'])->name('destroy');
    });
});

Route::group([
    'prefix' => 'akta/notaris',
    'as' => 'akta.notaris.',

], function () {
    Route::get('/', [AktaNotarisController::class, 'index'])
        ->name('index')
        ->middleware('permission:admin.access.akta_notaris.list')            
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Notaris'), route('akta.notaris.index'));
        });
    Route::get('create', [AktaNotarisController::class, 'create'])
        ->name('create')
        ->middleware('permission:admin.access.akta_notaris.create');
    Route::get('view', [AktaNotarisController::class, 'view'])
        ->name('view')
        ->middleware('permission:admin.access.akta_notaris.index');
    Route::post('/', [AktaNotarisController::class, 'store'])
        ->name('store')
        ->middleware('permission:admin.access.akta_notaris.create');
    Route::group(['prefix' => '{data}'], function () {
        Route::get('edit', [AktaNotarisController::class, 'edit'])
            ->name('edit')
            ->breadcrumbs(function (Trail $trail, AktaNotaris $data) {
                $trail->parent('akta.notaris.index') 
                    ->push(__('Editing :data', ['data' => $data->name]), route('akta.notaris.edit', $data));
            });

        Route::patch('/', [AktaNotarisController::class, 'update'])->name('update');
        Route::delete('/', [AktaNotarisController::class, 'destroy'])->name('destroy');
    });
});
// Route::get('/notaris/index', [NotarisController::class, 'index'])->name('notaris.index');
// Route::get('/akta-notaris/index', [NotarisController::class, 'index'])->name('akta.notaris.index');
// Route::get('/akta-note/index', [NotarisController::class, 'index'])->name('akta.note.index')    
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Akta Notaris'), route('akta.notaris.index'));
//     });