<?php

namespace Core;

class Request
{
    public function getQueryParams()
    {
        $params = [];
        if(!empty($_POST))
        {
            foreach ($_POST as $key => $value) {
                $params[$key] = htmlspecialchars(stripslashes(trim($value)));
            }
        }
        if(!empty($_GET))
        {
            foreach ($_GET as $key => $value) {
                $params[$key] = htmlspecialchars(stripslashes(trim($value)));
            }
        }

        return $params;
    }
}
