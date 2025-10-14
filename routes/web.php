<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TaskController;
use Illuminate\Http\Client\Request;


$router->post('/login', 'AuthController@login');

$router->get('/tasks', 'TaskController@index');
$router->get('/tasks/{idTask}', 'TaskController@show');
$router->post('/tasks', 'TaskController@store');
$router->put('/tasks/{idTask}', 'TaskController@update');
$router->delete('/tasks/idTask', 'TaskController@delete');


$router->group(['prefix' => 'users'], function() use ($router){
    $router->get('/', 'UserController@index');
    $router->get('/{user}', 'UserController@show');
    $router->post('/', 'UserController@store');
    $router->put('/{user}', 'UserController@update');
    $router->delete('/{user}', 'UserController@delete');
});





