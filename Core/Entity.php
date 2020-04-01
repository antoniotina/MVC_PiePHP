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
        $dbbTable = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
        $this->id = ORM::create($dbbTable, get_object_vars($this));
        return $this->id;
    }

    public function update()
    {
        // public function update($table, $id, $fields)
        $table = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
        $fields = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($key != "id") {
                $fields[$key] = $value;
            }
        }
        return ORM::update($table, $this->id, $fields);
    }

    public function delete()
    {
        // public function delete ($table, $id) {} // retourne un booleen
        $table = lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
        return ORM::delete($table, $this->id);
    }
}
