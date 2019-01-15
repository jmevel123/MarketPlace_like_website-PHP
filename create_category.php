<?php
include_once("admin_product.php");
include_once("DB_connect.php");
include_once("admin_categorie.php");
$testuser =false;

session_start();
if(!isset($_SESSION["username"])&& empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}
if(!$_SESSION["admin"] && empty($_COOKIE["admin"]))
{
    header("location:index.php");
}
$category = new Admin_category();
$display_category= $category->display_AllCategories();

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();

    $verify = new admin_category();

    if($verify->exist_category($name))
    {
        array_push($errors, "This category already exist, please choose another name..\n");
    }
    if(empty($errors)){
        $testuser = $category->add_category($name,$parent);
        header('Location:admin.php?category=added');
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create cate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>

<?php include_once("navbar.php") ?>

<div class="container">
<h3> Create new category </h3>
    <form method="post">
    <?php if(!empty($errors)) { ?>
    <ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
    </ul>
    <?php } ?>

    <?php if($testuser) { ?>
    <h1>User Created</h1>
    <?php } ?>
    
    <div class="form-group">
      <input type="text" class="form-control" name="name" id="firstname" placeholder="Name of category" minlength="3" maxlength="20" required><br>
      </div>
    <div class="form-group">
      <select id="categories" class="form-control" name="parent">
        <option value="0">choisir une catégorie</option>
          <?php 
          foreach($display_category as $category)
          echo "<option value=".$category["id"].">".$category["name"]."</option>";
          ?>
      </select>   
      </div>
    
      <br>     
      <button class="btn btn-success">Add category</button> 
      <br>

<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>

</div>

</body>
</html>

