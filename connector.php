<?php
/*
 * Name:Alex Fleming
 * Title: connector.php
 * Description: This is a file used by other .php files to connect to the database.
 *
 */
    define('DB_DSN','mysql:host=localhost;dbname=serverside_online;charset=utf8mb4');
    define('DB_USER','serveruser');
    define('DB_PASS','gorgonzola7!');

        // Create a PDO object called $db.
        try {
            $db = new PDO(DB_DSN, DB_USER, DB_PASS);
            //,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
          }
          catch (PDOException $e)
          {
            print "Error: ". $e->getMessage();
            die(); //Force execution to stop on errors.
          }
 ?>
