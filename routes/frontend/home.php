<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

// Route::get('/', [HomeController::class, 'index'])
//     ->name('index')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('frontend.index'));
//     });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');


Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
