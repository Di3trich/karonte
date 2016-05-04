<?php

$init = new \Karonte\Init(__DIR__);
$router = new \Karonte\Router($init->get('prefix'));

$router->route_app('/api/usuarios', __DIR__ . '/crud', array('table' => 'usuarios'));
$router->route_app('/api/cliente', __DIR__ . '/crud', array('table' => 'cliente'));
$router->route_app('/api/comprobante', __DIR__ . '/crud', array('table' => 'comprobante'));

return $router;
