<?php
include_once("DB_connect.php");
include_once("admin_users.php");
include_once("admin_product.php");
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
$admin= new admin_category();
$display = $admin->select_category($_GET["id"]);

// $parent = $admin->select_category($display["parent_id"]);
$category = $display;

if($category["parent_id"] == 0){
  $category["parent_id"] = "Main category";
}
else{
  $category["parent_id"] = $admin->name_parentID($display["parent_id"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display cate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>


 
    <!------------------------ PARTIE category ------------------------->
<div class="container">
    <h3>Category information</h3>

<table class="table">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Parent_ID</th> 
    <th>Parent name</th> 
    <th></th>
  </tr>
  <tr>
     <td><?php echo $display["id"] ?></td>
     <td><?php echo $display["name"]?></td> 
     <td><?php echo $display["parent_id"]?></td>     
     <td><?php echo $category["parent_id"]?></td>     
  </tr>

</table>

<p> </p>
  <a href ="admin.php" class="btn btn-primary"> Get back to admin </a>
  </div>
  <!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->
<body>
</html>
