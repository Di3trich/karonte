<?php

namespace Karonte;

class App {
    private $app_path = null;
    private $app_init_path = null;
    private $app_url_path = null;

    public function __construct($app_path, $init = 'init', $url = 'url') {
        $this->app_path = $app_path;
        $this->app_init_path = $app_path . DIRECTORY_SEPARATOR . $init . '.php';
        $this->app_url_path = $app_path . DIRECTORY_SEPARATOR . $url . '.php';
        try {
            if (!file_exists($this->app_init_path) || !file_exists($this->app_url_path)) {
                throw new \Exception('Bad App Configuration');
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function run($request, $url = null) {
        $init = require($this->app_init_path);
        $router = require($this->app_url_path);
        if ($url === null) {
            return $router->execute();
        } else {
            return $router->execute($url);
        }
    }

}