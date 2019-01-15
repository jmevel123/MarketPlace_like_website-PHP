<?php
 include_once("admin_users.php");
 session_start();
 if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
 {
     header('Location:login.php');
     exit;
 }
 if(!isset($_SESSION["admin"]) && empty($_COOKIE["admin"]))
 {
     header("location:index.php");
 }
$placeholder= new admin_users();
$valueholder= $placeholder->select_users($_GET["id"]);

$testuser =false;
if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
{
    extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
    $errors = array();

    $verify = new admin_users();

    if(strlen($firstname) < 3 || strlen($lastname) < 3 || strlen($username)< 3) 
    {
        array_push($errors, "Invalid firstname or lastname. Min 3 characters required.\n");
    }
    
   
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if(!preg_match($pattern , $email))
    {
        array_push($errors,"Invalid email\n");
    }

    if((strlen($password) < 3 || strlen($password) > 10) || ($password_confirmation != $password))
    {
        array_push($errors, "Invalid password or password confirmation\n");
    }

    if(empty($errors))
    {   
    
    $connexion= new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
    $connect=$connexion->getConn();

    $update = new admin_users;

    

    if(isset($admin)){
      $result_admin = $update->set_admin($_GET['id']);
    }
    else{
      $result_admin = $update->unset_admin($_GET['id']);
    }
        $testuser=$update->update_users($_GET['id']);
        
        header("location:index_profile.php?success=true");
        // header("location:login.php");     RAJOUTER AVEC DELAY DE 3 SEC
    }
     
}

?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update_user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>

 </head>
 <body>
 <?php include_once("navbar.php") ?>
<div class="container">
<form method="post">

    <h3>Profile Update</h3>

<?php if(!empty($errors)) { ?>
<ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
</ul>
<?php } ?>

<?php if($testuser) { ?>
<h1 class="mb-5" style="text-shadow: -1px 0px lightgrey">User Updated</h1>
<?php ;} ?>
<form methode ="post">
<div class="form-group">
<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo $valueholder->firstname; ?>" required><br>
</div>
<div class="form-group">
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname"value="<?php echo $valueholder->lastname; ?>" required><br>
      </div>
<div class="form-group">
      <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $valueholder->username; ?>"required><br>
      </div>
<div class="form-group">
      <input type="text" class="form-control" name="email" placeholder="example@gmail.com"value="<?php echo $valueholder->email; ?>" required><br>
      </div>
<div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password" pattern=.{3,10} required ><br>
      </div>
<div class="form-group">
      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" pattern=.{3,10} required><br>
     </div>
      
      <button class="btn btn-success">Update </button>
</form>       

<p> Or </p>
<a href ="index_profile.php"> Get back on your profil without changes</a>
</div>
<br>
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</body>
</html>