<?php

$router = new \Karonte\Router();

$router->route('/read', function ($request) {
    if ($request->get_method() === 'GET') {
        $init = new \Karonte\Init(__DIR__);
        $data = \Karonte\ORM::for_table($init->get('table'))->find_array();
        return \Karonte\Response::json(array(
            'status' => 'success',
            'records' => $data
        ));
    } else {
        return \Karonte\Response::json(array(
            'status' => 'error'
        ), 500);
    }
});

$router->route('/read/(\d+)', function ($request, $id) {
    if ($request->get_method() === 'GET') {
        $init = new \Karonte\Init(__DIR__);
        $data = \Karonte\ORM::for_table($init->get('table'))->find_one($id);
        if ($data) {
            return \Karonte\Response::json(array(
                'status' => 'success',
                'record' => $data->as_array()
            ));
        } else {
            return \Karonte\Response::json(array(
                'status' => 'error',
                'msg' => 'not found'
            ), 500);
        }
    } else {
        return \Karonte\Response::json(array(
            'status' => 'error'
        ), 500);
    }
});

$router->route('/create', function ($request) {
    if ($request->get_method() === 'POST') {
        $init = new \Karonte\Init(__DIR__);
        try {
            $create = \Karonte\ORM::for_table($init->get('table'))->create();
            $params = $request->param_all();
            foreach ($params as $key => $value) {
                $create->$key = $value;
            }
            $create->save();
        } catch (Exception $e) {
            return \Karonte\Response::json(array(
                'status' => 'error',
                'msg' => $e->getMessage()
            ), 500);
        }
        return \Karonte\Response::json(array(
            'status' => 'success'
        ));
    } else {
        return \Karonte\Response::json(array(
            'status' => 'error'
        ), 500);
    }
});

$router->route('/update/(\d+)', function ($request, $id) {
    if ($request->get_method() === 'POST') {
        $init = new \Karonte\Init(__DIR__);
        try {
            $create = \Karonte\ORM::for_table($init->get('table'))->find_one($id);
            $params = $request->param_all();
            foreach ($params as $key => $value) {
                $create->$key = $value;
            }
            $create->save();
        } catch (Exception $e) {
            return \Karonte\Response::json(array(
                'status' => 'error',
                'msg' => $e->getMessage()
            ), 500);
        }
        return \Karonte\Response::json(array(
            'status' => 'success'
        ));
    } else {
        return \Karonte\Response::json(array(
            'status' => 'error'
        ), 500);
    }
});

$router->route('/delete/(\d+)', function ($request, $id) {
    if ($request->get_method() === 'DELETE') {
        $init = new \Karonte\Init(__DIR__);
        try {
            $delete = \Karonte\ORM::for_table($init->get('table'))->find_one($id);
            if ($delete) {
                $delete->delete();
            } else {
                return \Karonte\Response::json(array(
                    'status' => 'error',
                    'msg' => 'not found'
                ), 500);
            }
        } catch (Exception $e) {
            return \Karonte\Response::json(array(
                'status' => 'error',
                'msg' => $e->getMessage()
            ), 500);
        }
        return \Karonte\Response::json(array(
            'status' => 'success'
        ));
    } else {
        return \Karonte\Response::json(array(
            'status' => 'error'
        ), 500);
    }
});

return $router;