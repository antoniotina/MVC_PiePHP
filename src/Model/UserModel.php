<?php

namespace Model;

class UserModel extends \Core\Entity
{
    public $relations = [
        "has_one" => [array("table" => "promo", "key" => "promo_id")],
        "has_many" => [array("table" => "article", "key" => "user_id")],
        "many_to_many" => [array("table" => "item", "key" => "item_id")]
    ];

    public function login()
    {
        $orm = new \Core\ORM();
        $results = $orm->find('users', array('WHERE' => ['email' => $this->email, 'password' => $this->password], 'ANDOR' => 'AND', 'ORDER BY' => 'id ASC', 'LIMIT' => ''));
        if (isset($results[0]["id"])) {
            $this->id = $results[0]["id"];
        } else {
            $this->id = 0;
        }
        return $this->id;
    }
}
