<?php

   try{
    $HOSTNAME="localhost"; // host

    $DBNAME ="homeland";//db name

    $USER ="root";   // user name

    $PASSWORD ="";  // password

    $con = new PDO("mysql:host=$HOSTNAME;dbname=$DBNAME",$USER,$PASSWORD);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
   }catch(PDOException $e)
   {
       die("Database connection failed: " . $e->getMessage());
   }

?>