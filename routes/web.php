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
        "message"=>'test cors, if this data is showing then cors is working'
    ]);
});

// group a route with the same parent route
// example localhost/api/{routename}
$router->group(['prefix'=>'api'], function() use($router){

    // =================== USERS
    $router->get('userall', 'UserController@allUser');
    $router->post('userinsert', 'UserController@insertUser');
    $router->post('userupdate', 'UserController@updateUser');
    $router->post('userdelete', 'UserController@deleteUser');
    $router->post('userlogin', 'UserController@login');
    // =================== END OF USERS

    // =================== ITEMS
    $router->get('itemimage/{name}', 'ItemController@getImage');
    $router->get('itemall', 'ItemController@allItem');
    $router->post('itemall', 'ItemController@allInOne');
    // $router->post('iteminsert', 'ItemController@insertItem');
    // $router->post('itemupdate', 'ItemController@updateItems');
    // $router->post('itemdelete', 'ItemController@deleteItems');
    // =================== END OF ITEMS

    
    $router->get('checkfile', 'ItemController@checkFileExists');

    // group a route that need authentication
    $router->group(['middleware'=>'auth'], function() use($router){

        // =================== ITEMS
        $router->post('iteminsert', 'ItemController@insertItem');
        $router->post('itemupdate', 'ItemController@updateItems');
        $router->post('itemdelete', 'ItemController@deleteItems');
        // =================== END OF ITEMS

        // ====================== LOGS
        $router->get('logall', 'LogController@allLogs');
        // ====================== END OF LOGS

    });

});

$router->get('/{any:.*}', function($any){
    return "<h1 style='text-align:center'> WHERE THE FUCK ARE YOU GOING?! </h1>";
    // return redirect('http://www.kontol.com');
    // return date('Y-m-d H:i:s');
    // header("location : ". $_SERVER['HTTP_HOST']);
    // echo "test";
    // exit;
 });