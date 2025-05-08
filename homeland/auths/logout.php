<?php
   
    session_start();
    session_unset();   // Optional: frees all session variables
    session_destroy();   // Destroys the session on the server/

    header("Location:http://localhost/estate_management_system/homeland");


?>