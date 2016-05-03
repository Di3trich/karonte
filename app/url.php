<?php

$init = new \Karonte\Init(__DIR__);
$router = new \Karonte\Router('/karonte');

$router->route('/', function () {
    echo "hola mundo";
});

$router->route('/otro', 'funcion');

$router->route('/another', 'CL::another');

$router->route('/test', array(new CL, 'test'));

$router->route('/vista', function ($response) {
    $vista = \Karonte\View::load(__DIR__.'/vista.phtml')->bind('mensaje', 'hola mundo');
    return \Karonte\Response::VIEW($vista);
});

$router->route('/file', function(){
    return \Karonte\Response::FILE('/home/jonathan/Descargas/mozo.jpg', 'mozo.jpg');
});

//$router->route_app('/app', __DIR__ . '/app');

return $router;
