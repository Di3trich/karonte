<?php

namespace Karonte;

class Session {

    public static $start = null;

    public function __construct() {
        if (self::$start === null) {
            session_start();
            self::$start = true;
        }
    }

    public function get($key) {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return false;
    }

    public function set($key, $value = null) {
        $_SESSION[$key] = $value;
    }

    public function get_once($key) {
        if (array_key_exists($key, $_SESSION)) {
            $temp = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $temp;
        }
        return false;
    }

    public function exist($key) {
        return array_key_exists($key, $_SESSION);
    }

    public function delete($key) {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    public function clear() {
        session_unset();
    }

    public function destroy() {
        session_unset();
        session_destroy();
    }
}