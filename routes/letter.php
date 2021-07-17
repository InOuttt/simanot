<?php

use App\Domains\Letter\Http\Controllers\GrupHukumController;
use App\Domains\Letter\Http\Controllers\TagihanNotarisController;
use Tabuna\Breadcrumbs\Trail;

Route::group([
  'prefix' => 'tagihan',
  'as' => 'tagihan.',

], function () {
  Route::get('/', [TagihanNotarisController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Surat Outstanding Notaris'), route('letter.tagihan.index'));
      });
  Route::post('/', [TagihanNotarisController::class, 'store'])
      ->name('store');
  Route::group(['prefix' => '{notarisId}'], function () {
    Route::group(['prefix' => '{bulan}'], function () {
        Route::group(['prefix' => '{tahun}'], function () {
            Route::get('download', [TagihanNotarisController::class, 'download'])
            ->name('download');
        });
    });
  });
});

Route::group([
  'prefix' => 'grup-hukum',
  'as' => 'grup_hukum.',

], function () {
  Route::get('/', [GrupHukumController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Surat Outstadning Cluster'), route('letter.grup_hukum.index'));
      });
  Route::post('/', [GrupHukumController::class, 'store'])
      ->name('store');
  Route::group(['prefix' => '{clusterId}'], function () {
    Route::group(['prefix' => '{bulan}'], function () {
        Route::group(['prefix' => '{tahun}'], function () {
            Route::get('download', [GrupHukumController::class, 'download'])
            ->name('download');
        });
    });
  });
});
