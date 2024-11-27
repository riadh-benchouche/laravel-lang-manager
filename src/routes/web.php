<?php

use Illuminate\Support\Facades\Route;
use Riadh\LaravelLangManager\Controllers\TranslationController;

Route::prefix('lang-manager')->group(function () {
    Route::get('/', [TranslationController::class, 'index'])->name('lang-manager.index');
    Route::post('/update', [TranslationController::class, 'update'])->name('lang-manager.update');
});
