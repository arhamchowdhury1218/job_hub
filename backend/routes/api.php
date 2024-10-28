<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobApplicationController;
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



Route::get('/jobs', [JobController::class, 'index']);
Route::delete('/jobs/{id}', [JobController::class, 'destroy']);
Route::get('/jobs/{id}', [JobController::class, 'show']);
Route::put('/jobs/{id}', [JobController::class, 'update']);

// For SignUP and Log In
Route::post('/signup', [AccountController::class, 'register']);
Route::post('/login', [AccountController::class, 'login']);
// Route::get('/jobsbyuser', [JobPostController::class, 'jobsByUser']);
// Route::post('/jobs', [JobController::class, 'store']);


// For particular user job post
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/job-posts', [JobPostController::class, 'store']);
    Route::get('/jobsbyuser', [JobPostController::class, 'jobsByUser']);
    Route::post('/jobs', [JobController::class, 'store']);
});


Route::get('/job-posts', [JobPostController::class, 'index']);

// Apply Job
Route::post('/jobs/apply/{id}', [JobApplicationController::class, 'apply']);


Route::get('/jobs/{id}/applicants', [JobApplicationController::class, 'getApplicants']);

// Route::get('/jobs/{id}', [JobController::class, 'showJob']);

Route::get('/admin/jobs', [JobController::class, 'getJobsByAdmin'])->middleware('auth:sanctum');

// Applicants
Route::get('/jobs/{id}/applicants', [JobApplicationController::class, 'getApplicants']);