<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$router->get('/api/spacex', 'API\SpacexController@handle');
$router->get('/api/comics', 'API\ComicsController@handle');
