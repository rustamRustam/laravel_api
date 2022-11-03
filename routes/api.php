<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/equipment', [App\Http\Controllers\API\EquipmentController::class, 'get_equipments']);

Route::get('/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'get_equipment_by_id']);

Route::post('/equipment', [App\Http\Controllers\API\EquipmentController::class, 'add_equipment']);

Route::put('/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'change_equipment_by_id']);

Route::delete('/equipment/{id}', [App\Http\Controllers\API\EquipmentController::class, 'delete_equipment_by_id']);

Route::get('/equipment-type', [App\Http\Controllers\API\EquipmentController::class, 'get_equipments_type']);
