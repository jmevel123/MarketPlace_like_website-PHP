<?php
 include_once("DB_connect.php");
 include_once("admin_users.php");
 $testuser =false;
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
    
    $connexion= new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
    $connect=$connexion->getConn();

    $create = new admin_users;

        $testuser=$create->create_users($firstname,$lastname,$username,$email,$password);
        header("location:login.php?success=true");
       }
    
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
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

  </div>
</nav>

<div class="container">
<form action="inscription.php" method="post">

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

<h1 class="mb-4">Create your profile</h1>

<div class="form-group">
<label for="firstname">First name</label>
<input type="text" class="form-control" name="firstname" id="firstname" placeholder="John" required><br>
</div>

<div class="form-group">
<label for="lastname">Last name</label>
<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Doe" required><br>
</div>

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" id="username" placeholder="Dodo" required><br>
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="text" class="form-control" name="email" placeholder="example@gmail.com" required><br>
</div>

<div class="form-group">  
<label for="password">Password</label>    
<input type="password" class="form-control" name="password" placeholder="**********" pattern=.{3,10} required ><br>
</div>

<div class="form-group">
<label for="passwordconf">Password confirmation</label>
<input type="password" class="form-control" name="password_confirmation" placeholder="**********" pattern=.{3,10} required><br>
</div> 
       
<button class="btn btn-primary mb-4">Sign Up</button> 

      <p>Already have an account ? Login <a href="login.php">HERE </a>
         

</form>
</div>

<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</footer>

</body>
</html>

            