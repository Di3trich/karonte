<?php

$router = new Router();

$router->route('/', function () {
    echo "hello form another";
});

$router->route('/msg/(\w+)', function($request, $text){
    echo "Mensaje: $text";
});

$router->app('/app(/.*)', new \Katty\App(__DIR__));

$router->route('/eliminar/(\d+)', function($request, $id){
    //TODO: eliminar registro $id utilizando la tabla
    $config = new \Katty\Init(__DIR__);
    $tabla = $config->get_config('tabla');

    View::load(__DIR__.'/vista/vista1.phtml', array(
        'var1'=>'valor1',
        'var2'=>'valor2',
        'var3'=>'valor3'
    ));

    return Response::view(__DIR__.'/vista/vista1.phtml', array(
        'var1'=>'valor1',
        'var2'=>'valor2',
        'var3'=>'valor3'
    ), '200');

    return Response::json(array(
        'var1'=>'valor1',
        'var2'=>'valor2',
        'var3'=>'valor3'
    ));

    return Response::raw('cadenita', array(
        'Content-Type'=> 'application/json',
        'status'=>'200'
    ));

    $tabla = Model::factory('tabla1', 2);

    $tabla->nombres = $tabla->nombres . ' nombre adicional';
    $tabla->apellidos = 'hola mundo';
    $tabla->edad = 23;

    $tabla->save();

});

return $router;
