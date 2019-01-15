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
$admin= new Admin_product();
$display = $admin->display_product($_GET["id"]);
$product = $display; 

$product["category_id"] = $admin->name_parentID($display["category_id"]);


// $parent = $display->display_product(name["parent_id"]);

?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>

    <h3>Product infos</h3>

    <!------------------------ PARTIE category ------------------------->
    <div class="container">
<table class="table">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th> 
    <th>Category of product</th> 
    <th>Description</th> 
    <th>Added_At</th> 


    <th></th>
  </tr>
  <tr>
     <td><?php echo $product["id"] ?></td>
     <td><?php echo $product["name"]?></td> 
     <td><?php echo $product["price"]?></td>    
     <td><?php echo $product["category_id"] ?></td>
     <td><?php echo $product["description"]?></td> 
     <td><?php echo $product["added_at"]?></td>     
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

</body>
</html>