<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $relations = [
        "has_many" => array("table" => "users", "key" => "user_id")
    ];
}
