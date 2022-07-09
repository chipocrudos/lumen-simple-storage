<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('upload/', ['uses' => 'FileUploadController@showAll']);
    
    $router->post('upload/', ['uses' => 'FileUploadController@create']);

    $router->get('upload/{id}/', ['uses' => 'FileUploadController@showOne']);

    $router->delete('upload/{id}/', ['uses' => 'FileUploadController@delete']);

});