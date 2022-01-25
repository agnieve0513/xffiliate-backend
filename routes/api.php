<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BeneficiaryController;
use App\Http\Controllers\Api\CollectController;
use App\Http\Controllers\Api\CollectorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\RoleController;

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

Route::post( "register", [UserController::class, "register"]);
Route::post("add-role", [RoleController::class, "addRole"]);
Route::post("login", [UserController::class, "login"]);

Route::group(["middleware" => ["auth:api"]], function(){
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);

    // product api routes
    Route::post("add-product", [ProductController::class, "addProduct"]);
    Route::get("get-product", [ProductController::class, "getProducts"]);
    Route::get("get-single-product/{id}", [ProductController::class, "getSingleProduct"]);
    Route::put("update-product/{id}", [ProductController::class, "updateProduct"]);
    Route::delete("delete-product/{id}", [ProductController::class, "deleteProduct"]);

    // data api routes
    Route::post("add-data", [DataController::class, "addData"]);
    Route::get("get-data/{id}", [DataController::class, "getData"]);
    Route::get("get-single-data/{id}", [DataController::class, "getSingleData"]);
    Route::put("update-data/{id}", [DataController::class, "updateData"]);

    // beneficiary api routes
    Route::post("add-beneficiary", [BeneficiaryController::class, "addBeneficiary"]);
    Route::get("get-beneficiaries/{id}", [BeneficiaryController::class, "getBeneficiaries"]);
    Route::get("get-beneficiary/{id}", [BeneficiaryController::class, "getBeneficiary"]);
    Route::put("update-beneficiary/{id}", [BeneficiaryController::class, "updateBeneficiary"]);
    Route::delete("delete-beneficiary/{id}", [BeneficiaryController::class, "deleteBeneficiary"]);

    // collects api routes
    Route::post("add-collect", [CollectController::class, "addCollect"]);
    Route::get("get-collects/", [CollectController::class, "getCollects"]);
    Route::get("get-collect-by-planholder/{id}", [CollectController::class, "getCollectByPlanholder"]);
    Route::get("get-collect-by-collector/{id}", [CollectController::class, "getCollectByCollector"]);
    Route::put("update-collect/{id}", [CollectController::class, "updateCollect"]);
    Route::delete("delete-collect/{id}", [CollectController::class, "deleteCollect"]);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
