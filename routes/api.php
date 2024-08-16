<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderIntentController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\TicketTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('event/{id}/tickets', [EventController::class, 'eventTicket']);
Route::resource('events', EventController::class)->except('create', 'edit');
Route::resource('tickets', TicketController::class)->except('create', 'edit');
Route::get('order/{id}/client', [OrderController::class, 'clientOrder']);
Route::resource('orders', OrderController::class)->except('create', 'edit');
Route::resource('ticket-types', TicketTypeController::class)->except('create', 'edit');
Route::resource('order-intents', OrderIntentController::class)->except('create', 'edit');
