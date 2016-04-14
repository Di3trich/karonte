<?php

include __DIR__ . '/controlador.php';

$router = new Router('/sigest');

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

$router->app('/app(/.*)', new \Katty\App(__DIR__ . '/another'));

$router->app('/tabla1(/.*)', new \Katty\App(__DIR__.'/apptabla', 'tabla1'));
$router->app('/tabla2(/.*)', new \Katty\App(__DIR__.'/apptabla', 'tabla2'));
$router->app('/tabla3(/.*)', new \Katty\App(__DIR__.'/apptabla', 'tabla3'));
$router->app('/tabla4(/.*)', new \Katty\App(__DIR__.'/apptabla', 'tabla4'));

return $router;
