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
    return phpinfo();
});

$router->group(['prefix' => 'api/'], static function ($app) {
    $app->post('register/', 'UsersController@store');
    $app->get('login/', 'UsersController@login');
    $app->get('logout/', 'UsersController@logout');

    $app->post('todo/', 'TodoController@store');
    $app->get('todo/', 'TodoController@index');
    $app->get('todo/{id}/', 'TodoController@show');
    $app->put('todo/{id}/', 'TodoController@update');
    $app->delete('todo/{id}/', 'TodoController@destroy');
});
