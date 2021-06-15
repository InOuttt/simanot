<?php

use App\Domains\Letter\Http\Controllers\ReportNotarisController;
use App\Domains\Letter\Http\Controllers\ReportKinerjaController;
use Tabuna\Breadcrumbs\Trail;

Route::group([
  'prefix' => 'covernote-notaris',
  'as' => 'notaris.',

], function () {
  Route::get('/', [ReportNotarisController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Laporan Notaris'), route('report.notaris.index'));
      });
    Route::group(['prefix' => '{bulan}'], function () {
        Route::group(['prefix' => '{tahun}'], function () {
            Route::get('download', [ReportNotarisController::class, 'download'])
            ->name('download');
        });
    });
});

Route::group([
  'prefix' => 'kinerja-notaris',
  'as' => 'kinerja.',

], function () {
  Route::get('/', [ReportKinerjaController::class, 'index'])
      ->name('index')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.dashboard')
              ->push(__('Laporan Kinerja Notaris'), route('report.kinerja.index'));
      });
    Route::group(['prefix' => '{tanggal}'], function () {
        Route::get('download', [ReportKinerjaController::class, 'download'])
        ->name('download');
    });
});
