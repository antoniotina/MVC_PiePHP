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
                if (!isset($GLOBALS["counter_entity"]) || $GLOBALS["counter_entity"] < 1) {
                    $GLOBALS["counter_entity"] = 1;
                    if (isset($this->relations["has_many"])) {
                        foreach ($this->relations["has_many"] as $key => $value) {
                            $variableName = $this->getPluralName($value["table"]);
                            $className = $this->getClassName($value["table"]);
                            $values = $orm->find($value["table"] . "s", array('WHERE' => [$value["key"] => $this->id], "ANDOR" => "AND", 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
                            foreach ($values as $value1) {
                                $this->$variableName[] = new $className($value1);
                            }
                        }
                    }
                    if (isset($this->relations["has_one"])) {
                        foreach ($this->relations["has_one"] as $key => $value) {
                            $variableName = $this->getPluralName($value["table"]);
                            $name = $value["key"];
                            $className = $this->getClassName($value["table"]);
                            $values = $orm->find($value["table"] . "s", array('WHERE' => ["id" => $this->$name], "ANDOR" => "AND", 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
                            foreach ($values as $value1) {
                                $this->$variableName = new $className(["id" => intval($value1["id"])]);
                            }
                        }
                    }
                    if (isset($this->relations["many_to_many"])) {
                        foreach ($this->relations["many_to_many"] as $key => $value) {
                            $pivotTable = $this->getTableName() . "_" . $this->getPluralName($value["table"]);
                            $variableName = $this->getPluralName($value["table"]);
                            $thisTable = substr($this->getTableName(), 0, -1);
                            $className = $this->getClassName($value["table"]);
                            $pivotResult = $orm->find($pivotTable, array('WHERE' => [$thisTable . "_id" => $this->id], "ANDOR" => "AND", 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
                            foreach ($pivotResult as $key1 => $value1) {
                                $this->$variableName[] = new $className($value1);
                            }
                        }
                    }
                }
            } else {
                echo "    " . $params["id"] . "     ID does not exist";
                return;
            }
        } else {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
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
            foreach ($value as $key1 => $value1) {
                $exclusionArray[$value1["table"]] = "off";
            }
        }
        return array_diff_key(get_object_vars($this), $exclusionArray);
    }

    private function getClassName($table)
    {
        return "\\Model\\" . ucfirst($table) . "Model";
    }

    private function getPluralName($value)
    {
        return $value . "s";
    }
}
