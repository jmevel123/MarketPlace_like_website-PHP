<?php
include_once("DB_connect.php");
include_once("admin_users.php");
include_once("admin_product.php");
include_once("admin_categorie.php");

session_start();
if(!isset($_SESSION["username"]) && empty($_COOKIE['username']))
{
    header('Location:login.php');
    exit;
}
if((isset($_SESSION["admin"]) && $_SESSION["admin"] !=1) || (isset($_COOKIE["admin"]) && $_SESSION["admin"] !=1))
{
    header("location:index.php");
}


$admin= new admin_users();
$sql_admin = "SELECT * FROM users";
$stmt= $admin->getBd()->prepare($sql_admin);
$stmt->execute();
$result_admin =$stmt->fetchAll(PDO::FETCH_OBJ);
//$admin->delete_users($_SESSION['username']);

$categories= new admin_category();
$display = $categories->display_AllCategories();
// $result_category =$stmt2->fetchAll(PDO::FETCH_OBJ);

$products= new Admin_product();
$products;
if(isset($_GET['q']) && !empty($_GET['q'])){
$products = $display->searchQ($_GET['q']);
}
else{
$displayproducts = $products->display_Allproducts();
}

?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

 </head>
 <body>
 
<?php include_once("navbar.php") ?>

<div class="container">

 
    <!------------------------ PARTIE USERS ------------------------->
<?php if(isset($_GET["success"]) && $_GET["success"]=="true"){?>
<h3>
    User updated
</h3>
<?php } ?>
<?php if(isset($_GET["user"]) && $_GET["user"]=="created"){?>
<h3>
    New user created
</h3>
<?php } ?>
<h1> Users management: </h1>
<table class="table table-hover myTable">
<thead class="thead-dark">
  <tr>
    <th class="text-center">ID</th>
    <th class="text-center">Firstname</th>
    <th class="text-center">Lastname</th> 
    <th class="text-center">Username</th>
    <th class="text-center">Email</th>
    <th class="text-center">Admin status</th>
    <th class="text-right">Actions</th>
  </tr>
</thead>
  <?php foreach ($result_admin as $result):?>
  <tr>
    <td> <?php echo $result->id ?></td>
    <td><?php echo $result->firstname?></td> 
     <td><?php echo $result->lastname?></td>     
     <td><?php echo $result->username?></td> 
    <td><?php echo $result->email?></td>
    <td><?php echo $result->admin?></td>
    <td class="text-right"> 
        <a class="btn btn-danger" href ="delete_user.php?id=<?php echo $result->id?>"> Delete </a>
        <a class="btn btn-success" href ="update_admin.php?id=<?php echo $result->id?>"> Update </a>
        <a class="btn btn-primary" href ="display_users.php?id=<?php echo $result->id?>"> View User </a>

    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a class="btn btn-info" href="createUser_admin.php">create user</a>
    
  <hr>

    <!------------------------ PARTIE Category ----------------------->
    <?php if(isset($_GET["category"]) && $_GET["category"]=="added"){?>
<h3>
    Category added
</h3>
<?php } ?>


<?php if(isset($_GET["category"]) && $_GET["category"]=="update"){?>
<h3>
    Category updated
</h3>
<?php } ?>
<h1> Categories management: </h1>

<table class="table table-hover myTable">
<thead class="thead-dark">
  <tr>
    <th class="text-center">ID</th>
    <th class="text-center">Name</th>
    <th class="text-center">Parent_ID</th>
    <th class="text-center"> Actions</th>
  </tr>
</thead>
  <?php foreach ($display as $categorie):?>
  <tr>
     <td><?php echo $categorie["id"] ?></td>
     <td><?php echo $categorie["name"] ?></td> 
     <td><?php echo $categorie["parent_id"]?></td>     
     <td class="text-right"> 
        <a class="btn btn-danger" href ="delete_category.php?id=<?php echo $categorie["id"]?>"> Delete </a>
        <a class="btn btn-success" href ="update_category.php?id=<?php echo $categorie["id"]?>"> Update </a>
        <a class="btn btn-primary" href ="display_category.php?id=<?php echo $categorie["id"]?>"> View Category </a>
    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a class="btn btn-info" href="create_category.php">create categorie</a>

<hr>


    <!------------------------ PARTIE PRODUCTS ----------------------->
    <?php if(isset($_GET["product"]) && $_GET["product"]=="added"){?>
<h3>
    Product added
</h3>
<?php } ?>


<?php if(isset($_GET["products"]) && $_GET["products"]=="update"){?>
<h3>
    Product updated
</h3>
<?php } ?>
<h1> Products management: </h1>

<table class="table table-hover myTable">
<thead class="thead-dark">
  <tr>
    <th class="text-center">ID</th>
    <th class="text-center">Name</th>
    <th class="text-center">Price</th>
    <th class="text-center">Category_ID</th>
    <th class="text-center">Description</th>
    <th class="text-center">Added_at</th>
    <th class="text-right">Actions</th>
  </tr>
</thead>
  <?php foreach ($displayproducts as $product):?>
  <tr>
     <td class="text-center"><?php echo $product["id"] ?></td>
     <td class="text-center"><?php echo $product["name"] ?></td> 
     <td class="text-center"><?php echo $product["price"]?></td>    
     <td class="text-center"><?php echo $product["category_id"]?></td>   
     <td class="text-center"><?php echo $product["description"]?></td>     
     <td class="text-center"><?php echo $product["added_at"]?></td>     

    <td class="text-right"> 
        <a class="btn btn-danger" href ="delete_product.php?id=<?php echo $product["id"]?>"> Delete </a>
        <a class="btn btn-success" href ="update_product.php?id=<?php echo $product["id"]?>"> Update </a>
        <a class="btn btn-primary" href ="display_product.php?id=<?php echo $product["id"]?>"> View Product </a>
    </td>  
  </tr>
<?php endforeach; ?>

</table>
<a class="btn btn-info" href="create_product.php">create product</a>

</div>

<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('.myTable').DataTable();
} );
</script>

<!-- <script src="jquery-3.3.1.js"></script> -->
<script src="alert_delete.js"></script> 

</body>
 </html>