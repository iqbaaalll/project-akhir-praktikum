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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses'=> 'AuthController@register']); //route Register
    $router->post('/login', ['uses'=> 'AuthController@login']); // route login
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses' => 'MahasiswaController@getMahasiswa']);
    $router->get('/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@getMahasiswaByToken']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaByNim']);
    $router->post('/{nim}/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@addMatakuliah']);
    $router->put('/{nim}/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@deleteMatakuliah']);
});

$router->get('/prodi', ['uses'=> 'ProdiController@getProdi']);
$router->get('/matakuliah', ['uses'=> 'MatakuliahController@getMatakuliah']);
