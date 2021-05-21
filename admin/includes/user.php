<?php

class User {

    public $id;
    public $username;
    public $password;
    public $firtname;
    public $lastname;
  

    public static function find_all_users() {

      return self::find_this_query("SELECT * FROM users");

       
    }


    public static function find_user_by_id($id) {
        global $database;

        $result_array = self::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }




    public static function find_this_query($sql) {
        global $database;

        $res_set = $database->query($sql);

        $the_object_array = [];

        while($row = mysqli_fetch_array($res_set)) {

            $the_object_array[] = self::instantiation($row);

        }
        return  $the_object_array;
    }

    

    public static function instantiation($record) {

        $object = new self;

        // $user->id       = $res_id['id'];
        // $user->username = $res_id['username'];
        // $user->password = $res_id['password'];
        // $user->first_name = $res_id['first_name'];
        // $user->last_name = $res_id['last_name'];

        foreach($record as $attribute => $value) {

           if($object->has_the_attribute($attribute)) {
            $object->$attribute = $value;
           }
        }

        return $object;
    }

    private function has_the_attribute($attribute) {
        
        $object_properties = get_object_vars($this);

        return array_key_exists($attribute, $object_properties);

    }

}