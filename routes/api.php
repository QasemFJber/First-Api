<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DirectorateController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories',CategoryController::class);
Route::apiResource('cities',CityController::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('students',StudentController::class);
Route::apiResource('lecturers',LecturerController::class);
Route::apiResource('tasks',TaskController::class);
Route::apiResource('directorates',DirectorateController::class);
Route::apiResource('schools',SchoolController::class);

Route::post('auth/register',[ApiAuthController::class,'register']);
Route::post('auth/login',[ApiAuthController::class,'login']);
Route::post('auth/logout',[ApiAuthController::class,'logout']);
