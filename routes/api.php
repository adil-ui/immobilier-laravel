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

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('/revoke-tokens', [AuthController::class, 'revokeTokens']);
    Route::get('/list-users/{page}', [UserController::class, 'getUserPerPage']);
    Route::get('/list-users', [UserController::class, 'getUsers']);
    Route::get('/last-users', [UserController::class, 'getLastUsers']);


    Route::get('/list-properties', [PropertyController::class, 'getAllProperties']);
    Route::get('/list-properties/{page}', [PropertyController::class, 'getPropertyPerPage']);

    Route::get('/my-properties/{id}', [PropertyController::class, 'getMyProperties']);
    Route::get('/my-properties/{id}/{page}', [PropertyController::class, 'getMyPropertyPerPage']);



});

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/properties', [PropertyController::class, 'getProperties']);
Route::get('/properties/{page}', [PropertyController::class, 'getAllPropertyPerPage']);

Route::get('/home-properties', [PropertyController::class, 'getHomeProperties']);

Route::post('/add-property', [PropertyController::class, 'addProperty']);

Route::get('/list-categories', [CategoryController::class, 'getCategories']);
Route::post('/add-category', [CategoryController::class, 'addCategory']);
Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

Route::get('/list-cities', [CityController::class, 'getCities']);
Route::post('/add-city', [CityController::class, 'addCity']);

Route::get('/list-sectors', [SectorController::class, 'getSectors']);
Route::post('/add-sector', [SectorController::class, 'addSector']);

Route::get('/list-districts', [DistrictController::class, 'getDistricts']);
Route::post('/add-district', [DistrictController::class, 'addDistrict']);

Route::post("/contact", [ContactController::class, "contact"]);

Route::get('/details/{id}', [DetailController::class, "getProperty"]);
