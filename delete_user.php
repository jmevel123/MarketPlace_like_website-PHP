<?php

include_once("admin_users.php");
session_start();
if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}
if(!$_SESSION["admin"] && empty($_COOKIE["admin"]))
{
    header("location:index.php");
}

$delete_admin= new admin_users ();
$delete_admin->delete_users($_GET['id']);
header("location:admin.php");
?>