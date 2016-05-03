<?php

function funcion() {
    echo "hola";
}

class Acceso extends \Karonte\Model{

}

class CL {
    public function test() {
        echo "test";
        $data1 = \Karonte\ORM::for_table('acceso')->limit(10)->find_many();
        $data2 = \Karonte\Model::factory('acceso')->limit(10)->find_many();
        var_dump($data1);
        var_dump($data2);
    }

    public static function another() {
        $init = new \Karonte\Init(__DIR__);
        echo "another " . $init->get('prueba');
    }
}

