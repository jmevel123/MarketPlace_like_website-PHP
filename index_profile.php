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
$admin= new admin_users();
if(isset($_SESSION["id"])){
$display = $admin->select_users($_SESSION["id"]);
}
if(!empty($_COOKIE["admin"])){
$display_cookie = $admin->select_users($_COOKIE["id"]);
}



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>

<div class="container">

    <h3>Profile infos</h3>

    <!------------------------ PARTIE USERS ------------------------->

<table class="table">
  <tr>
    <th>ID</th>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Username</th>
    <th>Email</th>
    <th>Actions</th>
  </tr>
  <tr>
  <?php
  if(!isset($_SESSION["id"])){
    echo "<td>$display_cookie->id</td>";
    echo "<td> $display_cookie->firstname</td>";
    echo "<td> $display_cookie->lastname</td>" ;
    echo "<td> $display_cookie->username</td>" ;
    echo "<td> $display_cookie->email</td>";
    echo "<td><a href ='update_users.php?id=$display_cookie->id' class='btn btn-success'> Update </a></td>";
  }else{
    echo "<td>$display->id</td>";
    echo "<td> $display->firstname</td>";
    echo "<td> $display->lastname</td>" ;
    echo "<td> $display->username</td>" ;
    echo "<td> $display->email</td>";
    echo "<td><a href ='update_users.php?id=$display->id' class='btn btn-success'> Update </a></td>";
  }

  

  ?>

  </tr>

</table>
<p> </p>

        <a href="index.php" class="btn btn-primary"> Get back </a>
        </div>

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
