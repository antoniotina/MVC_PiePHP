<?php

namespace Model;

class PromoModel extends \Core\Entity
{
    public $relations = [
        "has_many" => array("table" => "user", "key" => "user_id")
    ];
}
