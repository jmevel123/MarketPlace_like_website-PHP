<?php

include_once("admin_product.php");
include_once("DB_connect.php");
include_once("admin_categorie.php");
include_once("admin_users.php");
session_start();

$admin_create= new admin_users();
$createadmin= $admin_create->create_users("quentino","quentino","quentin","quentin@quentino.bg","quentin",1);
$createadmin= $admin_create->checkAdmin($_SESSION["admin"]);
var_dump($admin_create)

?>