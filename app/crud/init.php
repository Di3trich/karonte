<?php

$init = new \Karonte\Init(__DIR__);

$init->set('database', array(
    'connection' => 'mysql:host=localhost;dbname=mydb',
    'username' => 'root',
    'password' => ''
));

return $init;