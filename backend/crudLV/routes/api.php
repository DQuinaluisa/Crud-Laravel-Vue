<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\ProfilesController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login',  [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::get('/person', [PersonsController::class, 'index']);
        Route::post('/person', [PersonsController::class, 'store']);
        Route::get('/person/{id}', [PersonsController::class, 'show']);
        Route::put('/person/{id}', [PersonsController::class, 'update']);
        Route::delete('/person/{id}', [PersonsController::class, 'destroy']);
        Route::get('/perFil/{inicio}/{final}',[PersonsController::class, 'jtime']);

        Route::get('/soft', [PersonsController::class, 'deleteSoft']);

        Route::get('/users/{name}/{name2}', [PersonsController::class, 'search'] );

        Route::get('/profile', [ProfilesController::class, 'index']);

    });
});




