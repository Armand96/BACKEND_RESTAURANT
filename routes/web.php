<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/', function() use ($router){
    return response()->json([
        "message"=>'test cors, if this show in console log then cors is working'
    ]);
});

// group a route with the same parent route
// example localhost/api/{routename}
$router->group(['prefix'=>'api'], function() use($router){

    // =================== USERS
    $router->get('alluser', 'UserController@allUser');
    // =================== END OF USERS

    // =================== ITEMS
    $router->post('itemalls', 'ItemController@allInOne');
    $router->get('itemall', 'ItemController@allItem');
    $router->post('iteminsert', 'ItemController@insertItem');
    $router->post('itemupdate', 'ItemController@updateItems');
    $router->post('itemdelete', 'ItemController@deleteItems');
    // =================== END OF ITEMS

    $router->get('checkfile', 'ItemController@checkFileExists');

    // group a route that need authentication
    $router->group(['middleware'=>'auth'], function() use($router){

    });

});

$router->get('/{any:.*}', function($any){
    return "<h1 style='text-align:center'> FUCK OFF!!!! </h1>";
    // return redirect('http://www.kontol.com');
    // return date('Y-m-d H:i:s');
    // header("location : ". $_SERVER['HTTP_HOST']);
    // echo "test";
    // exit;
 });