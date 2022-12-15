<?php


function deb($var_obj_arr, $exit=0)
{
    echo "<br><br><pre>";
    print_r($var_obj_arr);
    echo "</pre><br><br>";
        if($exit==1)
        {exit(0); return;} # continues after echo
    else{return;}          # stops after echo
}

# -------------------------------------------------------------------
# db connnection
define('DB_DSN','mysql:host=localhost;dbname=serverside_online;charset=utf8mb4');

define('DB_USER','serveruser');
define('DB_PASS','gorgonzola7!');

try {
	$db = new PDO(DB_DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
	print "Error: " . $e->getMessage();
	die(); // Force execution to stop on errors.
}

session_start();
