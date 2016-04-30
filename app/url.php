<?php

$init = new \Karonte\Init(__DIR__);
$router = new \Karonte\Router('/karonte');

$router->route('/', function () {
    echo "hola mundo";
});

function funcion() {
    echo "hola";
}

class CL {
    public function test() {
        echo "test";
    }

    public static function another() {
        echo "another";
    }
}

;

$router->route('/otro', 'funcion');

$router->route('/another', 'CL::another');

$router->route('/test', array(new CL, 'test'));

$router->route_app('/app', __DIR__ . '/app');

return $router;
