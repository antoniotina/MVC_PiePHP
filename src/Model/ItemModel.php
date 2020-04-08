<?php

namespace Model;

class ItemModel extends \Core\Entity
{
    public $relations = [
        "many_to_many" => array("table" => "user", "key" => "user_id")
    ];
}
