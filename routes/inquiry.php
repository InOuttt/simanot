<?php

use App\Domains\Inquiry\Http\Controllers\GrupHukumController;
use App\Domains\Inquiry\Http\Controllers\IndexNotarisController;
use App\Domains\Inquiry\Http\Controllers\StatusAktaController;
use App\Domains\Inquiry\Http\Controllers\TagihanNotarisController;
use Tabuna\Breadcrumbs\Trail;

Route::group([
  'prefix' => 'status-akta',
  'as' => 'status_akta.',

], function () {
  Route::get('/', [StatusAktaController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Surat Tagihan Notaris'), route('letter.tagihan.index'));
      });
  Route::group(['prefix' => '{id}'], function () {
    Route::get('followup', [StatusAktaController::class, 'followup'])
      ->name('followup');
  });
});

Route::group([
  'prefix' => 'index-notaris',
  'as' => 'index_notaris.'
], function () {
  Route::get('/', [IndexNotarisController::class, 'index'])
    ->name('index');
});

Route::group([
  'prefix' => 'tagihan-notaris',
  'as' => 'tagihan_notaris.'
], function () {
  Route::get('/', [TagihanNotarisController::class, 'index'])
    ->name('index');
});

Route::group([
  'prefix' => 'grup-hukum',
  'as' => 'grup_hukum.'
], function () {
  Route::get('/', [GrupHukumController::class, 'index'])
    ->name('index');
});
