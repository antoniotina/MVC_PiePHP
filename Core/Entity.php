<?php

namespace Core;

class Entity
{
    public function __construct($params)
    {
        // find a way to stop the infinite loop of instancing classes
        // for each relation, apply a variable that's an object of said relation table
        if (array_key_exists("id", $params)) {
            $orm = new \Core\ORM();
            $classData = $orm->read($this->getTableName(), $params["id"]);
            if ($classData) {
                foreach ($classData as $key => $value) {
                    $this->$key = $value;
                }
                if(!isset($GLOBALS["counter_entity"]) || $GLOBALS["counter_entity"] < 1)
                {
                    $GLOBALS["counter_entity"] = 1;
                    // HERE ADD 1 TO THE GLOBAL COUNTER
                    // INSTANCES OF OTHER CLASSES FROM RELATIONS
                    // 1:1 ORM::read("table in the relations variable", "ID in question") 
                    // 1:N ORM::readAll("table in relations variable") 
                    // N:N create a new ORM method to make a RIGHT JOIN?(i think) to be able to get all the results of the table on the right
                    // After getting each data back, instance them with objects of their respective classes.
                }
            } else {
                echo "ID does not exist";
            }
        } else {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
        $this->getTableValuesOnly();
    }

    public function create()
    {
        $this->id = ORM::create($this->getTableName(), $this->getTableValuesOnly());
        return $this->id;
    }

    public function update()
    {
        $fields = [];
        foreach ($this->getTableValuesOnly() as $key => $value) {
            if ($key != "id") {
                $fields[$key] = $value;
            }
        }
        return ORM::update($this->getTableName(), $this->id, $fields);
    }

    public function delete()
    {
        return ORM::delete($this->getTableName(), $this->id);
    }

    public function read()
    {
        return ORM::read($this->getTableName(), $this->id);
    }

    public function read_all()
    {
        return ORM::read_all($this->getTableName());
    }

    private function getTableName()
    {
        return lcfirst(preg_replace('/Model/', '', explode('\\', get_class($this))[1]) . "s");
    }

    // this is to remove the $relations and every object it has in relation with so that it only gives values to the actual model table
    private function getTableValuesOnly()
    {
        $exclusionArray["relations"] = "off";
        foreach ($this->relations as $key => $value) {
            $exclusionArray[$value["table"]] = "off";
        }
        return array_diff_key(get_object_vars($this), $exclusionArray);
    }
}
