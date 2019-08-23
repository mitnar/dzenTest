<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addGroup('/api', function ($r) {
        $r->addRoute('POST', '/Table', 'TableController@getRows');
        $r->addRoute('POST', '/SessionSubscribe', 'SessionController@subscribe');
    });
});