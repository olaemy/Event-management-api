<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use Illuminate\Support\Facades\Route;

// Route::middleware('api')->group(function () {
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class);
    Route::apiResource('events.attendees', AttendeeController::class)
        ->scoped();
    // THis needs to be checked id is suppose to be the id of the event
    // and not the id of the attendee
});
// });