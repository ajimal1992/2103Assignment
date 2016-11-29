<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once 'Dbconnect.php';

$collection = $db->selectCollection('admin_acc');
$collection1 = $db->selectCollection('assistant_admin_acc');

$username = filter_input(INPUT_POST, 'username'); //$_POST['username']; 
$password = filter_input(INPUT_POST, 'pwd'); //$_POST['pwd'];

$results = $collection->find(array("username" => "$username", "pwd" => intval("$password"))); //"pwd" => intval("$password"))
$results1 = $collection1->find(array("username" => "$username", "pwd" => intval("$password")));

if ($results && $results->count() !== 0) {
    $_SESSION['valid_user'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = "Admin";
    foreach ($results as $h) {
        $_SESSION['userID'] = $h["userID"];
    }
      header('Location: AdminLog.php');
} elseif ($results1 && $results1->count() !== 0) {
    $_SESSION['valid_user'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = "Assistant";
    foreach ($results1 as $h) {
        $_SESSION['userID'] = $h["userID"];
    }
    header('Location: AssistantLog.php');
} 
//else {
//    //wrong password&username
//    header('Location: login.php?err=1');
//}
?>
