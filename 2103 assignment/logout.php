<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    session_start();
   // $_SESSION['status'] = "";
    session_destroy();
    header("location: login.php");
    exit();

/*session_start();
session_unset(); // remove all session variables
session_destroy(); // destroy the session 
header("Location:login.php");*/
?>