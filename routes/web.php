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

    // group a route that need authentication
    $router->group(['middleware'=>'auth'], function() use($router){

    });

});