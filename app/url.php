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
        $init = new \Karonte\Init(__DIR__);
        echo "another " . $init->get('prueba');
    }
}

$router->route('/otro', 'funcion');

$router->route('/another', 'CL::another');

$router->route('/test', array(new CL, 'test'));

$router->route_app('/app', __DIR__ . '/app');

return $router;
