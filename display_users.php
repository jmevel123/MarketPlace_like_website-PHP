<?php
include_once("DB_connect.php");
include_once("admin_users.php");
include_once("admin_product.php");
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
$admin= new admin_users();
$display = $admin->select_users($_GET["id"]);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>
<div class="container">
    <h3>Users infos</h3>

    <!------------------------ PARTIE USERS ------------------------->

<table class="table">
  <tr>
    <th> ID </th>
    <th> Firstname </th>
    <th> Lastname </th> 
    <th> Username </th>
    <th> Email </th>
    <th> admin </th>
    <th> created_at </th>
    <th></th>
  </tr>
  <tr>
    <div class="form-group">
     <td><?php echo $display->id ?></td>
     </div>
    <div class="form-group">
     <td><?php echo $display->firstname?></td> 
     </div>
    <div class="form-group">
     <td><?php echo $display->lastname?></td>  
     </div>
    <div class="form-group">   
     <td><?php echo $display->username?></td> 
     </div>
    <div class="form-group">
     <td><?php echo $display->email?></td>
     </div>
    <div class="form-group">
     <td><?php echo $display->admin?></td>
     </div>
    <div class="form-group">
     <td><?php echo $display->created_at?></td>
     </div>
    <div class="form-group">
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
