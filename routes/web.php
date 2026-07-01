<?php

use App\Http\Controllers\PortfolioExportController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('admin/portfolio/export/{userId?}', PortfolioExportController::class)
        ->name('portfolio.export');
});
