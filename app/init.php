<?php

$init = new \Karonte\Init(__DIR__);

$init->set('prueba', ' texto de pruebas nada mas');

$init->set('database', array(
    'connection' => 'mysql:host=localhost;dbname=rest',
    'username' => 'root',
    'password' => ''
));

$init->set('required', array(
    __DIR__ . '/text.php'
));

return $init;