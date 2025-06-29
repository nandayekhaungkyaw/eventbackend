<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecordOrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// PUBLIC ROUTES
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::get('ticket/event/{eventId}', [TicketController::class, 'eventTicket']);
Route::get('image/event/{eventId}', [ImageController::class, 'eventImage']);
Route::get('faq/event/{eventId}', [FaqController::class, 'eventFaq']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('type', [TypeController::class, 'index']);
Route::get('event', [EventController::class, 'index']);
Route::get('ticket', [TicketController::class, 'index']);
Route::get('faq', [FaqController::class, 'index']);
Route::get('image', [ImageController::class, 'index']);
Route::get('event/{id}', [EventController::class, 'show']);
Route::post('order', [OrderController::class, 'store']);

// AUTHENTICATED ROUTES (PROTECTED)
Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('category', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('type', TypeController::class)->except(['index', 'show']);
    Route::apiResource('event', EventController::class)->except(['index', 'show']);
    Route::apiResource('faq', FaqController::class)->except(['index', 'show']);
    Route::apiResource('image', ImageController::class)->except(['index', 'show']);
    Route::apiResource('ticket', TicketController::class)->except(['index', 'show']);
    Route::apiResource('order', OrderController::class)->except('store');
    Route::post('logout',[UserController::class,'logout']);
    Route::get('order/event/{eventId}', [OrderController::class, 'eventOrder']);

    Route::post('order/{id}/confirm', [OrderController::class, 'confirm']);
    Route::post('order/saveRecord', [RecordOrderController::class, 'saveRecord']);
    Route::get('order/saveRecord/all', [RecordOrderController::class, 'saveRecordAll']);
    Route::get('order/search/{search}', [RecordOrderController::class, 'searchRecordOrder']);
    Route::get('recordOrder', [RecordOrderController::class, 'recordOrderAll']);
});
