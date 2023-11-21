<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/file', function (Request  $request) {
    if($request->hasFile('image')){
       return ['msg' => $request->all(),'ext'=>$request->file('image')->getClientOriginalExtension()];
    }
    //$request->file('avatar')
    return ['msg' => $request->all()];
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);
Route::get('/users/search', [UserController::class, 'searchUser']);
Route::apiResource('users', UserController::class);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/user', [AuthController::class, 'user']);
    Route::apiResource('tweets', TweetController::class);
    Route::apiResource('likes', LikeController::class);
    Route::get('/follows/list/following-follower', [FollowController::class, 'followingFollowerList']);
    Route::apiResource('follows', FollowController::class);
    Route::get('profiles/{username}', [ProfileController::class, 'findByUserName']);
});
