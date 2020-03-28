<?php

namespace Core;

class Request
{
    public $POST;
    public $GET;

    public function __construct()
    {
        $this->POST = $this->clean($_POST);
        $this->GET = $this->clean($_GET);
    }

    private function clean($cleanThis)
    {
        foreach ($cleanThis as $key => $value) {
            $cleanThis[$key] = htmlspecialchars(stripslashes(trim($value)));
        }
        return $cleanThis;
    }
}
