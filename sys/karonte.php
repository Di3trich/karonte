<?php

namespace Karonte;

include __DIR__ . DIRECTORY_SEPARATOR . 'app.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'request.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'router.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'paris.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'idiorm.php';

class MainApp {
    private $app_path;

    public function __construct($app_path) {
        define('__ROOT__', realpath($app_path));
        $this->app_path = __ROOT__;
    }

    public function run() {
        (new App($this->app_path))->run(new Request());
    }
}
