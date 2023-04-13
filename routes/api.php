<?php

use App\Http\Controllers\Api\AddsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProgramsController;
use App\Http\Controllers\Api\VideosController;
use App\Models\NewsCategory;
use App\Models\Setting;
use App\Models\Wishlist;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

// 'middleware' => 'auth:api'
Route::group(['middleware' => 'auth:api'], function ($router) {

    Route::resource('program', ProgramsController::class);
    Route::resource('video', VideosController::class);
    Route::resource('adds', AddsController::class);
    Route::resource('news', NewsController::class);
    Route::get('/category', [NewsController::class, 'cats']);
    Route::get('/subcategory/{id}', [NewsController::class, 'subcategory']);
    Route::get('/showallnews/{id}', [NewsController::class, 'showallnews']);
    Route::get('/news/{id}', [NewsController::class, 'news']);
    Route::get('/live', function () {
        return response()->json(Setting::select('live', 'live_status')->first(), 200);
    });
    Route::get('wishlist/all', function () {
        return response()->json(Wishlist::where('user_id', auth()->user()->id)->with('news')->get(), 200);
    });
    Route::post('wishlist/add', function (Request $request) {
        $request->validate([
            'news_id' => 'required'
        ]);
        $check = Wishlist::where('user_id', auth()->user()->id)->where('news_id', $request->news_id)->first();
        if ($check == NULL) {
            Wishlist::create([
                'user_id' => auth()->user()->id,
                'news_id' => $request->news_id,
            ]);
            return response()->json(['message' => 'added successfully'], 200);
        } else {
            return response()->json(['message' => 'Founded in Wishlist'], 200);
        }
    });
    Route::post('wishlist/delete', function (Request $request) {
        $request->validate([
            'news_id' => 'required'
        ]);
        $wisglist = Wishlist::where('news_id', $request->news_id)->first();
        if (!$wisglist)         return response()->json(['message' => 'Not Found'], 200);
        $wisglist->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    });
});
