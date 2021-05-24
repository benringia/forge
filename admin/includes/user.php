<?php

class User {

    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name'];

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


    public static function verify_user($username, $password) {

        global $database;

        $username = $database -> escape_string($username);
        $password = $database -> escape_string($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '$username' ";
        $sql .= "AND password = '$password' ";

        $result_array = self::find_this_query($sql);

   

        return !empty($result_array) ? array_shift($result_array) : false;


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

    protected function properties() {

        $properties =[];

        foreach(self::$db_table_fields as $db_field) {

            if(property_exists($this,  $db_field)) {

                $properties[$db_field] = $this -> $db_field;
            }
        }
        return $properties;
    }

    protected function clean_prop() {

        global $database;

        $clean_prop = [];

        foreach($this -> properties() as $key => $value) {

            $clean_prop[$key] = $database -> escape_string($value);

        }

        return $clean_prop;

    }

    public function save() {

        return isset($this -> id) ? $this -> update() : $this -> create();

    }

    public function create() {

        global $database;

        $properties = $this -> clean_prop();

        $sql = "INSERT INTO ".self::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";
       

       

        if($database -> query($sql)) {

            $this -> id = $database -> insert_user_id();
            return true;

        } else {
            return false;
        }
    }

    public function update() {

        global $database;
        
        $properties = $this -> clean_prop();
        $property_pairs = [];

        foreach($properties as $key => $value) {

            $property_pairs[] = "$key='$value'";

        }

        $sql = "UPDATE ".self::$db_table ." SET ";
        $sql .= implode(", ", $property_pairs);
        $sql .= " WHERE id = " .$database -> escape_string($this -> id);

        $database -> query($sql);

        return (mysqli_affected_rows($database -> connection) == 1) ? true : false;

    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM ".self::$db_table ." WHERE id = " . $database -> escape_string($this -> id);

        $database -> query($sql);
    }

} // User class