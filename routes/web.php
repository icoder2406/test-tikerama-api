<?php

use App\Http\Controllers\ApiAccessDemandController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApiAccessDemandController::class, 'index'])->name('api-access-demands.index');
Route::resource('api-access-demands', ApiAccessDemandController::class)->except('index');
