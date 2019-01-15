<?php
include_once("admin_product.php");
include_once("DB_connect.php");
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
$options = new Admin_category();
$categories = $options->display_AllCategories();

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();

    $product = new Admin_product();
    if($product->exist_product($name))
    {
        array_push($errors, "This product's name already exist, please choose another name..\n");
    }
    if(empty($errors)){
        $testuser = $product->add_product($name, $price, $category, $description);
        header('Location:admin.php?category=added');
    }
    // $product->add_product($name, $price, $category, $description);   
    // header('Location:admin.php?product=added');
}



?>


<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>
<div class="container">

  <h1 class="mb-5">Add new product</h1>

    <form method="post">
        <div class="form-group">
          <input type="text" class="form-control" name="name" id="firstname" placeholder="Name of product" minlength="3" maxlength="20" required><br>
        </div>
      <div class="form-group">
      <input type="number"  class="form-control" step="0.01" name="price" id="price" placeholder="Price" min=0 required><br>
      </div>
      <div class="form-group">
      <textarea cols="50"  class="form-control" rows="4" name="description" id="description" placeholder="Description of your product" required ></textarea><br>
        </div>
        <div class="form-group">
      <select id="categories" class="form-control" name="category">
          <?php 
          foreach($categories as $category)
          echo "<option value=".$category["id"].">".$category["name"]."</option>";
          ?>
      </select>
      </div>
          
      <br>     

      <button class="btn btn-success">Add product</button> 
      </form>
     

 

<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>
</div>

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
</div>
<!-- Copyright -->
</body>
</html>