<?php

namespace Karonte;

class Init {
    private static $config_map = array();
    private $config;

    public function __construct($config_path) {
        if (!isset(self::$config_map[$config_path])) {
            self::$config_map[$config_path] = array();
        }
        $this->config = &self::$config_map[$config_path];
    }

    public function set($key, $value = null) {
        $this->config[$key] = $value;
    }

    public function get($key) {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        return false;
    }
}