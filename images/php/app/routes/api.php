<?php

$router->group(['prefix' => 'api/'], static function ($app) {
    $app->post('register/', 'UsersController@store');
    $app->get('login/', 'UsersController@login');
    $app->get('logout/', 'UsersController@logout');

    $app->post('todo/', 'TodoController@store');
    $app->get('todo/', 'TodoController@index');
    $app->get('todo/{id}/', 'TodoController@show');
    $app->put('todo/{id}/', 'TodoController@update');
    $app->delete('todo/{id}/', 'TodoController@delete');
});
