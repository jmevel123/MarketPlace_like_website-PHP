<?php
session_start();
 include_once("DB_connect.php");
 include_once("admin_users.php");
 $testuser =false;
 if(!isset($_SESSION["username"]) && $_COOKIE["username"])
 {
     header('Location:login.php');
     exit;
 }
 if(!$_SESSION["admin"] && empty($_COOKIE["admin"])){
     header("location:index.php");
 }

    if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
    {
        extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
        $errors = array();

        $verify = new admin_users();

        if(strlen($firstname) < 3 || strlen($lastname) < 3 ) 
        {
            array_push($errors, "Invalid firstname or lastname. Min 3 characters required.\n");
        }
        if($verify->exist_username($username))
        {
            array_push($errors, "Username is already taken..\n");
        }
        if($verify->exist_email($email))
        {
            array_push($errors, "Email is already taken..\n");
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

            $create = new admin_users;

            if(isset($admin)){
                $result_admin = $create->create_users_admin($firstname,$lastname,$username,$email,$password);
                header("location:admin.php?user=created");
            }
              else{
                $testuser=$create->create_users($firstname,$lastname,$username,$email,$password);
                header("location:admin.php?user=created");
            }
            

         
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display cate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>
<div class="container">
 <h3> Create new user </h3>
<form method="post">

<?php if(!empty($errors)) { ?>
<ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
</ul>
<?php } ?>

    <div class="form-group">
<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" required><br>
</div>
    <div class="form-group">
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" required><br>
      </div>
    <div class="form-group">
      <input type="text" class="form-control" name="username" id="username" placeholder="Username" required><br>
      </div>
    <div class="form-group">
      <input type="text" class="form-control" name="email" placeholder="example@gmail.com" required><br>
      </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password" pattern=.{3,10} required ><br>
      </div>
    <div class="form-group">
      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" pattern=.{3,10} required><br> 
      </div>
      <label for="admin" class="form-check-label">Become Admin</label>
      <div class="form-group form-check">
    <input type="checkbox" name="admin" value="admin"><br>
    </div>
   
          <button class="btn btn-success">Create new user</button> 
         

</form>
<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
</div>
<!-- Copyright -->
</body>
</html>    