<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HubController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\AthleteController;
use App\Http\Controllers\Api\CompetitionController;
use App\Http\Controllers\Api\MeetController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ResultController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
```
// Hub ↔︎ School Integration
Route::post('/hub/schools', [HubController::class, 'registerSchool']);
Route::get('/hub/health/{school_code}', [HubController::class, 'healthCheck']);

// API Token Creation
Route::middleware('auth:sanctum')->post('/token', function (Request $request) {
    $token = $request->user()->createToken('api-token');
 
    return ['token' => $token->plainTextToken];
})->name('api.token.create');
```
// Public (Unauthenticated)
Route::get('/meets', [MeetController::class, 'publicIndex']);
Route::get('/meets/{code}', [MeetController::class, 'publicShow']);
Route::get('/events/{id}/results', [EventController::class, 'publicResults']);

// CRUD (Authenticated via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('teams', TeamController::class);
    Route::apiResource('athletes', AthleteController::class);
    Route::apiResource('meets', CompetitionController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('results', ResultController::class);
});
