<?php

class Router {

    private $routes = array();
    private $apps = array();
    private $prefix = '';

    public function __construct($prefix = '') {
        $this->prefix = $prefix;
    }

    private function get_pattern($pattern) {
        return '/^' . str_replace('/', '\/', $this->prefix . $pattern) . '$/';
    }

    public function route($pattern, $callback) {
        $this->routes[$this->get_pattern($pattern)] = $callback;
    }

    public function app($pattern, \Katty\App $app) {
        $this->apps[$this->get_pattern($pattern)] = $app;
    }

    public function controller($pattern, $controller) {
        $this->controllers[$this->get_pattern($pattern)] = $controller;
    }

    public function execute($url = null) {
        $url = preg_replace('/\?.*/', '', $url ? $url : $_SERVER['REQUEST_URI']);
        //echo "URL[$url] -> ";
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $url, $params)) {
                $params[0] = new \Katty\Request();
                //echo "[call-function($pattern)]"."\n";
                return call_user_func_array($callback, array_values($params));
            }
        }
        foreach ($this->apps as $pattern => $app) {
            if (preg_match($pattern, $url, $params)) {
                //echo "[call-app($pattern)]"."\n";
                return $app->run(new \Katty\Request(), $params[1]);
            }
        }
        foreach ($this->routes as $pattern => $controller) {
            if (preg_match($pattern, $url, $params)) {
                array_shift($params);
                $method = $params[0];
                $params[0] = new \Katty\Request();
                return call_user_func_array(array($controller, $method), $params);
            }
        }
        echo "404"; //TODO: implementar vista de error
    }
}