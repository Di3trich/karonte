<?php

include __DIR__ . '/controlador.php';

$router = new Router('/karonte');

$router->route('/', function () {
    echo "hola mundo";
});

$router->route('/otro', function () {
    echo "juan carlos marica";
});

$router->route('/suma/(\d+)/(\d+)', function ($request, $a, $b) {
    echo $a * 1 + $b * 1;
    echo $request->query_param('algo');
});

//$router->controller('/control/(\w+)', new Controller());

$router->app('/app(/.*)', new \Karonte\App(__DIR__ . '/another'));

return $router;
