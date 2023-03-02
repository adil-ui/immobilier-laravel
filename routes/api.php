<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/list-users', [UserController::class, 'getUsers']);
Route::post('/add-user', [UserController::class, 'addUser']);

Route::get('/list-properties', [PropertyController::class, 'getProperties']);
Route::post('/add-property', [PropertyController::class, 'addProperty']);

Route::get('/list-categories', [CategoryController::class, 'getCategories']);
Route::post('/add-category', [CategoryController::class, 'addCategory']);

Route::get('/list-cities', [CityController::class, 'getCities']);
Route::post('/add-city', [CityController::class, 'addCity']);

Route::get('/list-sectors', [SectorController::class, 'getSectors']);
Route::post('/add-sector', [SectorController::class, 'addSector']);

Route::get('/list-districts', [DistrictController::class, 'getDistricts']);
Route::post('/add-district', [DistrictController::class, 'addDistrict']);

Route::post("/contact", [ContactController::class, "contact"]);

Route::get('/details/{id}', [DetailController::class, "getPropert"]);


