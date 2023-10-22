<?php

use ExpertFramework\Http\Router\Router;

Router::get('/api', 'Api\Docs\SwaggerController@yaml');
Router::get('/api/docs', 'Api\Docs\SwaggerController@doc');
