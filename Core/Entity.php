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
        return $this->id;
    }

    public function update()
    {
        // public function update($table, $id, $fields)
        $orm = new \Core\ORM();
        $table = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
        $fields = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($key != "id") {
                $fields[$key] = $value;
            }
        }
        return $orm->update($table, $this->id, $fields);
    }
}
