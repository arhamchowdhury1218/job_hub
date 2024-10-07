<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// // Route::post('/job-posts', [JobPostController::class, 'store']);
// // Route::get('/job-posts', [JobPostController::class, 'index']);
// Route::middleware('auth:account')->group(function () {
//     // Route::post('/login', [AccountController::class, 'login']);
//     // Route::get('/job-posts', [JobPostController::class, 'index']);
//     // Route::post('/job-posts', [JobPostController::class, 'store']);
// });