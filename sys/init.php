<?php

namespace Katty;

class Init {
    private static $config = array();

    public function set_config($config, $value = null) {
        if (is_array($config) && $value === null) {
            $this->$config = array_merge($this->config, $config);
        } else {
            $this->$config[$config] = $value;
        }
    }

    public function get_config() {
        return $this->config;
    }
}