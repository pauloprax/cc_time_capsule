<?php

use App\Http\Requests\LogRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-hash', function () {
    return [
        Hash::make(Str::random(16)),
        Hash::make(Str::random(16)),
        Hash::make(Str::random(16)),
    ];
});

Route::get('/categories', function () {
    return [
        \App\Models\Category::find(1),
        \App\Models\Category::find(2),
        \App\Models\Category::find(3),
    ];
});

Route::get('categories/{category}','Api\CategoryController@show');

Route::post('/log', function (LogRequest $request) {
    $client = new MongoDB\Client(env('MONGO_DB_URL'));
    $collection = $client->cc_time_capsule->logs;
    $insertOneResult = $collection->insertOne(
        [
            'dt'=>new \MongoDB\BSON\UTCDateTime(time()*1000),
            'log'=>$request->input('log')
        ]
    );
    return response()->json([
        'result' => true,
        '_id' => $insertOneResult->getInsertedId(),
    ]);
});

Route::get('/log-random', function () {
    $log = [
        'dt'=>new \MongoDB\BSON\UTCDateTime(time()*1000),
        'log'=>['name'=>Str::random(16)]
    ];
    $client = new MongoDB\Client(env('MONGO_DB_URL'));
    $collection = $client->cc_time_capsule->logs;
    $insertOneResult = $collection->insertOne($log);
    return response()->json([
        'result' => true,
        '_id' => $insertOneResult->getInsertedId(),
    ]);
});

Route::get('/log/{id}', function ($id) {
    $log = [
        'dt'=>new \MongoDB\BSON\UTCDateTime(time()*1000),
        'name'=>Str::random(16)
    ];
    $client = new MongoDB\Client(env('MONGO_DB_URL'));
    $collection = $client->cc_time_capsule->logs;
    $res = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($id)]);
    if ($res){
        return response()->json([
            'result' => true,
            'log' => $res,
        ]);
    }

    return response()->json([
        'result' => false,
        'message' => 'Not Found.',
    ]);
});
