<?php

use App\Domains\Covernote\Http\Controllers\CovernoteController;
use App\Domains\Covernote\Http\Controllers\CovernoteDocumentController;
use App\Domains\Covernote\Http\Controllers\CovernoteFollowupController;
use App\Domains\Covernote\Models\Covernote;
use App\Domains\Covernote\Models\CovernoteDocument;
use Tabuna\Breadcrumbs\Trail;

Route::get('/', [CovernoteController::class, 'index'])
    ->name('index')
    ->middleware('permission:admin.access.covernote.list')            
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Covernote'), route('covernote.index'));
    });
Route::get('create', [CovernoteController::class, 'create'])
    ->name('create')
    ->middleware('permission:admin.access.covernote.create');
Route::post('/', [CovernoteController::class, 'store'])
    ->name('store')
    ->middleware('permission:admin.access.covernote.create');
Route::group(['prefix' => '{data}'], function () {
    Route::get('edit', [CovernoteController::class, 'edit'])
        ->name('edit')
        ->breadcrumbs(function (Trail $trail, Covernote $data) {
            $trail->parent('covernote.index') 
                ->push(__('Editing Covernote :data', ['data' => $data->no_covernote]), route('covernote.edit', $data));
        });
    Route::get('view', [CovernoteController::class, 'view'])
        ->name('view')
        ->middleware('permission:admin.access.covernote.index');
    Route::patch('/', [CovernoteController::class, 'update'])->name('update');
    Route::delete('/', [CovernoteController::class, 'destroy'])->name('destroy');
});

Route::get('update', [CovernoteController::class, 'upgradeIndex'])
    ->name('update.index')
    ->middleware('permission:admin.access.covernote_followup.index');
Route::get('find', [CovernoteController::class, 'find'])
    ->name('find')
    ->middleware('permission:admin.access.covernote_followup.index');

Route::group([
  'prefix' => 'document',
  'as' => 'document.',

], function () {
  Route::get('/', [CovernoteDocumentController::class, 'find'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Covernote'), route('covernote.index'));
      });
  Route::post('/', [CovernoteDocumentController::class, 'store'])
      ->name('store');
  Route::group(['prefix' => '{data}'], function () {
      Route::get('create', [CovernoteDocumentController::class, 'create'])
          ->name('create');
      Route::get('view', [CovernoteDocumentController::class, 'view'])
          ->name('view');
      Route::get('edit', [CovernoteDocumentController::class, 'edit'])
          ->name('edit')
          ->breadcrumbs(function (Trail $trail, CovernoteDocument $data) {
              $trail->parent('covernote.index') 
                  ->push(__('Editing Dokumen :nama covernote :data', ['nama' => $data->nama, 'data' => $data->covernote->no_covernote]), route('covernote.edit', $data));
          });

      Route::patch('/', [CovernoteDocumentController::class, 'update'])->name('update');
      Route::delete('/', [CovernoteDocumentController::class, 'destroy'])->name('destroy');

    /** Follow up */
      Route::group(['prefix' => 'followup', 'as' => 'followup.'], function () {
          Route::get('/', [CovernoteFollowupController::class, 'edit'])->name('edit');
          Route::patch('/', [CovernoteFollowupController::class, 'store'])
            ->name('store');
        });

  });
});