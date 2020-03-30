<?php

namespace Core;

class Entity
{
    public function __construct($params)
    {
        if (array_key_exists("id", $params)) {
            $orm = new \Core\ORM();
            $dbbTable = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
            $classData = $orm->read($dbbTable, $params["id"]);
            foreach ($classData as $key => $value) {
                $this->$key = $value;
            }
        } else {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function create()
    {
        $orm = new \Core\ORM();
        $dbbTable = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
        $this->id = $orm->create($dbbTable, get_object_vars($this));
        echo $this->id;
    }
}
