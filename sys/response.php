<?php

namespace Karonte;

class Response {
    private $content = null;
    private $status = null;
    private $header = null;
    private $type = null;
    const VIEW = 'view';
    const RAW = 'raw';
    const JSON = 'json';
    const FILE = 'file';
    const HTML = 'html';

    public function __construct($content, $status = 200, $header = array(), $type = null) {
        $this->content = &$content;
        $this->status = $status;
        $this->header = &$header;
        $this->type = $type;
    }

    public static function json($content, $status = 200, $header = array()) {
        $header = array_merge($header, array(
            'Content-Type' => 'application/json'
        ));
        return new Response($content, $status, $header, self::JSON);
    }

    public static function html($content, $status = 200, $header = array()) {
        $header = array_merge($header, array(
            'Content-Type' => 'text/html'
        ));
        return new Response($content, $status, $header, self::HTML);
    }

    public static function view($content, $status = 200, $header = array()) {
        $header = array_merge($header, array(
            'Content-Type' => 'text/html'
        ));
        return new Response($content, $status, $header, self::VIEW);
    }

    public static function file($file_path, $filename = 'file', $status = 200, $header = array()) {
        $header = array_merge($header, array(
            'Content-Type' => 'application/octet-stream',
            'Content-Description' => 'File Transfer',
            'Content-Transfer-Encoding' => 'Binary',
            'Content-disposition' => 'attachment; filename="' . $filename . '"'
        ));
        return new Response($file_path, $status, $header, self::FILE);
    }

    public static function raw($content, $status = 200, $header = array()) {
        return new Response($content, $status, $header, self::RAW);
    }

    public function render() {
        $this->set_headers();
        if ($this->type === self::VIEW) {
            $this->content->render();
        } else if ($this->type === self::JSON) {
            echo json_encode($this->content);
        } else if ($this->type === self::FILE) {
            readfile($this->content);
        } else {
            echo $this->content;
        }
    }

    private function set_headers() {
        foreach ($this->header as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function write($content) {
        $this->content .= $content;
    }
}