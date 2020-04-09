<?php

namespace Model;

class ArticleModel extends \Core\Entity
{
    public $relations = [
        "has_one" => [array("table" => "user", "key" => "user_id")]
    ];
}
