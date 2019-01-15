<?php

include_once("admin_product.php");
include_once("admin_categorie.php");


session_start();
if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}

if(!isset($_GET["id"]))
{
    header('Location:index_categories.php');
    exit;
}

$display = new Admin_product();
$products;
if(isset($_GET['q']) && !empty($_GET['q'])){
$products = $display->searchQ($_GET['q']);
}
else{
$objet = new Admin_product();

$products = $display->allProductInCat($_GET["id"]);
}


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


<?php include_once("navbar.php") ?>

<div class="container">

<?php 
if(isset($_SESSION['username'])){
  echo "Hello " . $_SESSION["username"] . " fancying some sweet ??";
}
elseif(isset($_COOKIE['username'])){
  echo "Hello " . $_COOKIE["username"] . " fancying some sweet ??";
}

?>

<div class="row">
<?php foreach($products as $product) : ?>
<div class="card mb-4 ml-4 mr-4" style="width: 18rem;">
  <img class="card-img-top" src="bonbon.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $product["name"] ?> - <?php echo $product["price"] ."€" ?></h5>
    <p class="card-text"><?php echo $product["description"] ?></p>
    <a href="#" class="btn btn-primary">Buy product</a>
  </div>
</div>
<?php endforeach; ?>
</div>



<footer>
<address>  PRODUCTION : Gang-Bang Théory <br> Copyright</address>
</footer>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>