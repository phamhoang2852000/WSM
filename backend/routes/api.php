<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostionController;
use App\Http\Controllers\RequestUserController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    // 'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'getlogin']);
    Route::get('/register', [AuthController::class, 'getregister']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'userProfile']);
    Route::post('/updateUser', [AuthController::class, 'updateUser']);
    Route::post('/addRequest', [AuthController::class, 'addRequest']);
    Route::get('/acceptRequest', [AuthController::class, 'acceptRequest']);
    Route::get('/awitRequest', [AuthController::class, 'awitRequest']);
    Route::get('/unacceptRequest', [AuthController::class, 'unacceptRequest']);
});
Route::post('/reset-password', [ResetPasswordController::class, 'sendMail']);
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword']);

Route::get('/requestType', [RequestUserController::class, 'requestType']);
Route::get('/list-request', [RequestUserController::class, 'listRequest']);
Route::post('/approve-request', [RequestUserController::class, 'approveRequest']);
Route::post('/unapprove-request', [RequestUserController::class, 'unapproveRequest']);

Route::get('/postion', [PostionController::class, 'postion']);
Route::get('/division', [PostionController::class, 'division']);
Route::get('/permission', [PostionController::class, 'permission']);

Route::get('/list-user/{id_division}', [UserController::class, 'listUser']);
Route::get('/profileAccount/{idUser}', [UserController::class, 'profileAccount']);
Route::get('/deleteUser/{idUser}', [UserController::class, 'deleteUser']);
Route::post('updateUser/{idUser}', [UserController::class, 'updateUser']);
