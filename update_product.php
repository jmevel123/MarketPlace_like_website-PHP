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
if(!isset($_SESSION["admin"]) && !isset($_COOKIE["admin"]))
{
    header("location:index.php");
}

$prod1 = new Admin_product();
$valueProd = $prod1->get_ID_product($_GET["id"]);


$options = new admin_category();
$categories = $options->display_AllCategories();

if(!empty($_POST))
{
    extract($_POST);

    $products = new Admin_product();
    $editProd = $products->edit_product($_GET["id"]);   
    header('Location:admin.php?products=update');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>

<?php include_once("navbar.php") ?>
        <div class="container">
    <h3>Product Update</h3>

    <form method="post">

      <input type="text" class="form-control" name="name" id="name" placeholder="Name of product" minlength="3" maxlength="20" value="<?php echo $valueProd->name; ?>" required><br>
      <input type="number" class="form-control" step="0.01" name="price" id="price" placeholder="Price" min=0 value="<?php echo $valueProd->price; ?>" required><br>
      <textarea cols="50" rows="4" class="form-control" name="description" id="description" placeholder="Description of your product" required ><?php echo $valueProd->description; ?></textarea><br>

      <select id="categories" class="form-control" name="category_id">
          <?php 
          foreach($categories as $category){
            $selected = "";
            if($category["id"] == $valueProd->category_id){
                $selected = "selected";
            }
            echo "<option value=".$category["id"]." $selected >".$category["name"]."</option>";
         }
          ?>
      </select>
          
      <br>     

      <button class="btn btn-success">Update product</button> 
      <br>

      <p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>
</div>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</body>
</html>