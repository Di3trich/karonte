<?php

function funcion() {
    echo "hola";
}

class Acceso extends \Karonte\Model {

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

    public function sesion($request) {
        if (!$request->session->exist('count')) {
            $request->session->set('count', 0);
        } else {
            $request->session->set('count', $request->session->get('count') * 1 + 1);
        }
        return \Karonte\Response::json(array('data' => $request->session->get('count')));
    }

    public function clear($request) {
        $request->session->delete('count');
    }

    public function meth($request) {
        $data = $request->param_all();
        return \Karonte\Response::json(array(
            'method' => $request->get_method(),
            'data' => $data,
            'query' => $request->get('query')
        ));
    }
}

