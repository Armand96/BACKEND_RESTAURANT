<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});


// ========================== CUSTOM GLOBAL & FUNCTION
define('defaultSuccessMsg', 'Success Get Data');
define('defaultEmptyMsg', 'Empty Data');
define('defaultInsertSuccessMsg', 'Success Insert Data');
define('defaultReqMsg', 'Please Fill all the required data');
define('defaultUpdateSuccessMsg', 'Success Update Data');
define('defaultDeleteSuccessMsg', 'Success Delete Data');
define('defaultSuccessLogin', "Login Success");
define('defaultFailedLogin', "Login Failed");
define('defaultEmptyUser', 'There is no user');
define('defaultWrongPass', 'Wrong Password');
define('IMG_STORAGE_PATH', storage_path('item_image').'/');

function respJson($success, $message, $data = "")
{
    if($success)
    {
        return response()->json([
            "message"=>$message,
            "success"=>$success,
            "data"=>$data
        ], 200);
    }
    else
    {
        return response()->json([
            "message"=>$message,
            "success"=>$success,
            "data"=>$data
        ], 404);
    }
}
// ========================== END OF CUSTOM GLOBAL & FUNCTION


return $app;
