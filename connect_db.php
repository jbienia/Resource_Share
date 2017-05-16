<!--
  Script used to create the PDO object that our blog application will use through the other scripts
-->
<?php
  define('DB_DSN','mysql:host=localhost;dbname=finalproject;charset=utf8');
  define('DB_USER','serveruser');
  define('DB_PASS','gorgonzola7!');

  try
    {
      $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    }

  catch (PDOException $e)
     {
       echo "what!";
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
     }
 ?>
