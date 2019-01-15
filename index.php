<?php

include_once("admin_product.php");
include_once("admin_categorie.php");


session_start();
if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}

$display = new Admin_product();
$products;
if(isset($_GET['q']) && !empty($_GET['q'])){
$products = $display->searchQ($_GET['q']);
}
else{
$products = $display->display_Allproducts();
}

$admin= new admin_category();
// $display = $admin->select_category($_GET["id"]);

// // $parent = $admin->select_category($display["parent_id"]);
// $category = $display;


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GangBang - HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light mb-3" style="background-color:#e3e3e3">
<a class="navbar-brand" href="index.php"><img style="height:70px;width:150px" src="gangbanglogo.jpg" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="index_categories.php">Categories</a>  <!--Créer page catégorie -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index_profile.php">Profile</a> <!--Créer page profil -->
      </li> 
      <?php  if(!empty($_SESSION["admin"]) || !empty($_COOKIE["admin"])){?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin managements</a> <!--Créer page profil -->
      </li>
      <?php }?>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact us</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<h1 class="mb-5 text-center">Home</h1>

<div class="container">


<div class="row">
<?php foreach($products as $product) : ?>
<?php 
  $category_name = $admin->name_parentID($product["category_id"]);
 ?>
<div class="card col-lg-4 col-md-6 col-sm-12" style="width: 18rem;">
  <img class="card-img-top" src="bonbon.jpg" alt="Card image cap">
  <div class="card-body d-flex flex-column">
    <h5 class="card-title font-weight-bold"><?php echo $product["name"] ?> - <?php echo $product["price"] ."€" ?></h5>
    <h5 class="card-title"><?php echo "Category: " . $category_name ?></h5>
    <p class="card-text"><?php echo $product["description"] ?></p>
    <hr>
    <a href="#" class="btn btn-primary mt-auto">Buy product</a>
  </div>
</div>
<?php endforeach; ?>
</div>



<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</footer>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>