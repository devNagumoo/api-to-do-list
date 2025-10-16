<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TaskController;
use Illuminate\Http\Client\Request;


$router->post('/login', 'AuthController@login');

$router->group(['prefix' => 'tasks', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'TaskController@index');
    $router->get('/{idTask}', 'TaskController@show');
    $router->post('/', 'TaskController@store');
    $router->put('/{idTask}', 'TaskController@update');
    $router->delete('/idTask', 'TaskController@delete');
});




$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', 'UserController@index');
    $router->get('/{user}', 'UserController@show');
    $router->post('/', 'UserController@store');
    $router->put('/{user}', 'UserController@update');
    $router->delete('/{user}', 'UserController@delete');
});
