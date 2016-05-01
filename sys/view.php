<?php

namespace Karonte;

class View {
    private $view_path = null;
    private $context = array();

    public function __construct($path, $context = array()) {
        $this->view_path = $path;
        $this->bind($context);
    }

    public static function &load($path, $context) {
        return new View($path, $context);
    }

    public function render() {
        extract($this->context);
        include $this->view_path;
    }

    public function &bind($key, $value) {
        if (is_array($key)) {
            $this->context = array_merge($this->context, $key);
        } else {
            $this->context[$key] = $value;
        }
        return $this;
    }
}