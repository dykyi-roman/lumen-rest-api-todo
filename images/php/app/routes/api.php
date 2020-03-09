<?php

$router->group(['prefix' => 'api/'], static function ($app) {
    $app->post('user/register/', 'UsersController@store');
    $app->get('user/login/', 'UsersController@login');
    $app->get('user/logout/', 'UsersController@logout');
    //
    $app->post('todo/', 'TodoController@store');
    $app->get('todo/', 'TodoController@index');
    $app->get('todo/{id}/', 'TodoController@show');
    $app->put('todo/{id}/', 'TodoController@update');
    $app->delete('todo/{id}/', 'TodoController@delete');
});
