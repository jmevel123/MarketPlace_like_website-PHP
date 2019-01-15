<?php

include_once("admin_categorie.php");
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

$delete_admin= new admin_category ();
$result= $delete_admin->get_Parent_ID($_GET['id']);
$result_product = $delete_admin->get_product_category_ID($_GET['id']);


?>

<!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>

 </head>
 <body>
 <?php include_once("navbar.php") ?>

<?php 

if($result || $result_product){
    echo "You can't delete a category with children or product. Please delete all children and/or product beforehand";
}
else{
    $delete_admin->delete_category($_GET['id']);
    header("location:admin.php");
}
?>
      </body>
