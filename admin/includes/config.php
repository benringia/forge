<?php 

// DATA BASE CONNECTION CONSTANTS

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','forge_db');


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

echo "Connected" ?: $connection;
