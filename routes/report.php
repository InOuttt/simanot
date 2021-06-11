<?php

use App\Domains\Letter\Http\Controllers\ReportNotarisController;
use Tabuna\Breadcrumbs\Trail;

Route::group([
  'prefix' => 'covernote-notaris',
  'as' => 'notaris.',

], function () {
  Route::get('/', [ReportNotarisController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Laporan Notaris'), route('letter.grup_hukum.index'));
      });
  Route::post('/', [ReportNotarisController::class, 'store'])
      ->name('store');
    Route::group(['prefix' => '{bulan}'], function () {
        Route::group(['prefix' => '{tahun}'], function () {
            Route::get('download', [ReportNotarisController::class, 'download'])
            ->name('download');
        });
    });
});