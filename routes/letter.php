<?php

use App\Domains\Letter\Http\Controllers\TagihanNotarisController;
use App\Domains\Letter\Models\SuratTagihan;
use Tabuna\Breadcrumbs\Trail;

Route::group([
  'prefix' => 'tagihan',
  'as' => 'tagihan.',

], function () {
  Route::get('/', [TagihanNotarisController::class, 'find'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Surat Tagihan Notaris'), route('letter.tagihan'));
      });
  Route::get('create', [CovernoteController::class, 'create'])
    ->name('create');
  Route::post('/', [TagihanNotarisController::class, 'store'])
      ->name('store');
  Route::group(['prefix' => '{data}'], function () {
      Route::get('view', [TagihanNotarisController::class, 'view'])
          ->name('view')
          ->middleware('permission:admin.access.covernote_followup.index');
      Route::get('edit', [TagihanNotarisController::class, 'edit'])
          ->name('edit')
          ->breadcrumbs(function (Trail $trail, SuratTagihan $data) {
              $trail->parent('covernote.index') 
                  ->push(__('Sedang menyunting Surat Tagihan Notaris :nama ', ['nama' => $data->notaris->nama]), route('letter.tagihan.edit', $data));
          });

      Route::patch('/', [TagihanNotarisController::class, 'update'])->name('update');
      Route::delete('/', [TagihanNotarisController::class, 'destroy'])->name('destroy');
  });
});