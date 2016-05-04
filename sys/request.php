<?php

namespace Karonte;

class Request {

    public static $method = null;
    public static $uri = null;
    private static $query_map = null;
    public static $query_string = null;
    private static $data = null;
    public $session = null;

    public function __construct() {
        $this->session = new Session();
        if (self::$method === null) {
            self::$method = strtoupper(strtolower($_SERVER['REQUEST_METHOD']));
        }
        if (self::$uri === null) {
            self::$uri = strtolower($_SERVER['REQUEST_URI']);
        }
        if (self::$query_string === null) {
            self::$query_string = $_SERVER['QUERY_STRING'];
        }
        if (self::$query_map === null) {
            self::$query_map = $_GET;
        }
        if (self::$data === null) {
            if (self::$method === 'GET') {
                self::$data = $_GET;
                unset($_GET);
            } elseif (self::$method === 'POST') {
                self::$data = $_POST;
                unset($_POST);
            } else {
                parse_str(file_get_contents('php://input'), self::$data);
            }
        }
    }

    public function get($key) {
        if (array_key_exists($key, self::$query_map)) {
            return self::$query_map[$key];
        }
        return false;
    }

    public function param($key) {
        if (array_key_exists($key, self::$data)) {
            return self::$data[$key];
        }
        return false;
    }

    public function param_all() {
        return self::$data;
    }

    public function query_string() {
        return self::$query_string;
    }

    public function get_method() {
        return self::$method;
    }
}
