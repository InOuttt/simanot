<?php

use App\Domains\Covernote\Http\Controllers\CovernoteController;
use App\Domains\Covernote\Http\Controllers\CovernoteFollowupController;
use App\Domains\Covernote\Models\Covernote;
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
  'prefix' => 'follow-up',
  'as' => 'followup.',

], function () {
  Route::get('/', [CovernoteFollowupController::class, 'index'])
      ->name('index')
      ->middleware('permission:admin.access.covernote_followup.list')            
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Covernote'), route('covernote.index'));
      });
  Route::post('/', [CovernoteFollowupController::class, 'store'])
      ->name('store')
      ->middleware('permission:admin.access.covernote_followup.create');
  Route::group(['prefix' => '{data}'], function () {
      Route::get('create', [CovernoteFollowupController::class, 'create'])
          ->name('create')
          ->middleware('permission:admin.access.covernote_followup.create');
      Route::get('view', [CovernoteFollowupController::class, 'view'])
          ->name('view')
          ->middleware('permission:admin.access.covernote_followup.index');
      Route::get('edit', [CovernoteFollowupController::class, 'edit'])
          ->name('edit')
          ->breadcrumbs(function (Trail $trail, AktaNotaris $data) {
              $trail->parent('covernote.index') 
                  ->push(__('Editing follow-up covernote :data', ['data' => $data->no_covernote]), route('covernote.edit', $data));
          });

      Route::patch('/', [CovernoteFollowupController::class, 'update'])->name('update');
      Route::delete('/', [CovernoteFollowupController::class, 'destroy'])->name('destroy');
  });
});