<?php

namespace Karonte;

class Router {

    private $routes = array();
    private $prefix = '';

    public function __construct($prefix = '') {
        $this->prefix = $prefix;
    }

    private function get_pattern($pattern) {
        return '/^' . str_replace('/', '\/', $this->prefix . $pattern) . '$/';
    }

    public function route($pattern, $callback) {
        $this->routes[$this->get_pattern($pattern)] = array(
            'type' => 'callable',
            'call' => $callback
        );
    }

    public function route_app($pattern, $callback, $config = array()) {
        $this->routes[$this->get_pattern($pattern . '(/.*)')] = array(
            'type' => 'application',
            'call' => $callback,
            'config' => $config
        );
    }

    public function execute($url = null) {
        $url = preg_replace('/\?.*/', '', $url ? $url : $_SERVER['REQUEST_URI']);
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $url, $params)) {
                if ($callback['type'] == 'callable') {
                    $params[0] = new Request();
                    return call_user_func_array($callback['call'], array_values($params));
                } else {
                    
                }
            }
        }
        echo "404"; //TODO: implementar vista de error
    }
}