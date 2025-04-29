<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});


Route::middleware('api')->prefix('api')->group(function () {

    // Route::apiResource('events.attendees', AttendeeController::class)
    //     ->scoped(['attendee' => 'id']);

    // Route::apiResource('events', EventController::class);
});

// Route::get('/test-api', function () {
//     return response()->json(['message' => 'API is working']);
// });