<?php

use Illuminate\Support\Facades\Route;
use Riadh\LaravelLangManager\Controllers\TranslationController;

Route::get('/lang/{locale}', [TranslationController::class, 'show']);
