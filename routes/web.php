<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$router->get('/api/space', 'API\SpacexController@handle');
$router->get('/api/comics', 'API\ComicsController@handle');
