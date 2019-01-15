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

$admin= new admin_users();
$sql_admin = "SELECT * FROM users";
$stmt= $admin->getBd()->prepare($sql_admin);
$stmt->execute();
$result_admin =$stmt->fetchAll(PDO::FETCH_OBJ);
//$admin->delete_users($_SESSION['username']);

$categories= new admin_category();
$display = $categories->display_AllCategories();
// $result_category =$stmt2->fetchAll(PDO::FETCH_OBJ);
// $display = $categories->select_category($_GET["id"]);
$categorie = $display;




$products= new Admin_product();
// // $products;
// if(isset($_GET['q']) && !empty($_GET['q'])){
// $products = $products->searchQ($_GET['q']);
// }
// else{
// $display = $categories->display_AllCategories();

// }

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

<div class="container">

<h1 class="mb-4 text-center"> Categories </h1>

<div class="row">
<?php foreach($display as $categorie) : ?>
<?php if($categorie["parent_id"] == 0){
  $categorie["parent_id"] = "Main category";
}
else{
  $categorie["parent_id"] = $categories->name_parentID($categorie["parent_id"]);
} ?>
<div class="card col-lg-4 col-md-6 col-sm-12" style="width: 18rem;">
  <img class="card-img-top" src="bonboncat.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title font-weight-bold"><?php echo $categorie["name"]?></h5>
    <h5 class="card-title"><?php echo "Parent: " . $categorie["parent_id"]?></h5>
    <a href="product_in_cat.php?id=<?php echo $categorie["id"]?>" class="btn btn-primary">View product of this category</a>
  </div>
</div>
<?php endforeach; ?>
</div>
</div>

</table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->
 </body>
 </html>