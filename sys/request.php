<?php

namespace Karonte;

class Request {

    public static $method = null;
    public static $uri = null;
    private static $query_map = null;
    public static $query_string = null;
    private static $data = null;

    public function __construct() {
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
            if (self::$method == 'GET') {
                self::$data = $_GET;
                unset($_GET);
            } elseif (self::$method == 'POST') {
                self::$data = $_POST;
                unset($_POST);
            } else {
                parse_str(file_get_contents('php://input'), self::$data);
            }
        }
    }

    public function get($key) {
        return self::$query_map[$key];
    }

    public function param($key) {
        return self::$data[$key];
    }

    public function query_string() {
        return self::$query_string;
    }

    public function data($key) {
        return self::$data[$key];
    }
}
