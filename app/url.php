<?php

$router = new Router('/karonte');

$router->route('/', function () {
    echo "hola mundo";
});

return $router;
