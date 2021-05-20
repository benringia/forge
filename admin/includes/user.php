<?php

class User {

    public function find_all_users() {

        global $database;

        $res_set = $database->query("SELECT * FROM users");
        return $res_set;
    }

}