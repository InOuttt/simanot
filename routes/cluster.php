<?php

use App\Domains\Master\Http\Controllers\ClusterController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/', [ClusterController::class, 'index'])
    ->name('index')
    ->middleware('permission:admin.access.cluster.list')            
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Cluster'), route('cluster.index'));
    });
Route::get('create', [ClusterController::class, 'create'])
    ->name('create')
    ->middleware('permission:admin.access.cluster.create');
Route::post('/', [ClusterController::class, 'store'])
    ->name('store')
    ->middleware('permission:admin.access.cluster.create');
Route::group(['prefix' => '{cluster}'], function () {
    Route::get('edit', [ClusterController::class, 'edit'])
        ->name('edit')
        ->breadcrumbs(function (Trail $trail, Cluster $data) {
            $trail->parent('cluster.index') 
                ->push(__('Editing :cluster', ['cluster' => $data->name]), route('cluster.edit', $data));
        });

    Route::patch('/', [ClusterController::class, 'update'])->name('update');
    Route::delete('/', [ClusterController::class, 'destroy'])->name('destroy');
});