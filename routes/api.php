<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertyDetailsController;
use App\Http\Controllers\PropertyListController;

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
/////////////////////////////////Broker Register///////////////////////////////////////////////
Route::post('/agentregister', [AgentController::class, 'agentregister']);
Route::post('/agentlogin', [AgentController::class, 'login']);

//////////////////////////////Auth Controller///////////////////////////////////
Route::group(['middleware' => 'api',
'prefix' => 'auth'], function ($router){
    
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/Login', [AuthController::class, 'Login']);
    Route::get('/userprofile', [AuthController::class, 'userProfile']); 
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/payload', [AuthController::class, 'payload']);    

    Route::post('Forgotpassword',[PasswordResetRequestController::class,'sendEmail']);
    Route::post('Resetpassword',[ChangePasswordController::class,'passwordResetProcess']);
});

/////////////////////////////Contact Controller////////////////////////////////////
Route::post('/contact',[ContactController::class,'contactmail']);

/////////////////////////////PropertyList & PropertyDetails////////////////////////////////////
Route::post('/propertylist',[PropertyListController::class,'PropertyList']);
Route::post('/propertydetail',[PropertyDetailsController::class,'PropertyDetails']);
Route::get('getpropertydetails/{id}',[PropertyListController::class,'PropertyInfo']);




