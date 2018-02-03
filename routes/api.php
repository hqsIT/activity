<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'activity', 'middleware' => ['web']], function () {
    Route::get('detail/{id}', 'Home\ActivityController@detail');
    Route::get('getLists', 'Home\ActivityController@lists');
    Route::post('create', 'Home\ActivityController@create');
    Route::get('enroll/{activity_id}', 'Home\ActivityController@enroll');
    Route::get('myActivity', 'Home\ActivityController@myActivity');
    Route::get('myJoinActivity', 'Home\ActivityController@myJoinActivity');

    Route::get('getTypes', function () {
        $Response = new \App\Http\Responses\ApiResponse();
        $type = \App\Models\Activity::ACTIVITY_TYPE;
        unset($type[0]);
        foreach ($type as $key => $item) {
            $types[] = [
                'id' => $key,
                'value' => $item
            ];
        }
        return $Response->successWithData($types);
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::post('wxLogin', 'Home\UserController@wxLogin');
});
Route::post('upload', 'Home\FileController@upload');

Route::group(['prefix' => 'share', 'middleware' => ['web']], function () {
    Route::post('share', 'Home\ShareController@share');
    Route::get('getList', 'Home\ShareController@allList');
    Route::get('my', 'Home\ShareController@myList');

});