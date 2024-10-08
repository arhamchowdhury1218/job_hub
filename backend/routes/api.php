<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
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


Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs', [JobController::class, 'index']);
Route::delete('/jobs/{id}', [JobController::class, 'destroy']);
Route::get('/jobs/{id}', [JobController::class, 'show']);
Route::put('/jobs/{id}', [JobController::class, 'update']);

// For SignUP and Log In
Route::post('/signup', [AccountController::class, 'register']);
Route::post('/login', [AccountController::class, 'login']);
// Route::get('/jobsbyuser', [JobPostController::class, 'jobsByUser']);



// For particular user job post
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/job-posts', [JobPostController::class, 'store']);
    Route::get('/jobsbyuser', [JobPostController::class, 'jobsByUser']);
});


Route::get('/job-posts', [JobPostController::class, 'index']);
