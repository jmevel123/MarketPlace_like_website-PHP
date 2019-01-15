<?php

include_once("DB_connect.php");
include_once("admin_users.php");


$dsn = "mysql:host=127.0.0.1;dbname=pool_php_rush;port=3306";
$conn = new PDO($dsn, "root", "root"); 
 

if(!empty($_POST))
{
    extract($_POST);

    $login = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $sql = "SELECT password, email, username ,admin
            FROM users
            WHERE email = :login";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":login", $login);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if($result)
    {
        if(password_verify($password, $result->password))  
        {
            session_start();
            $_SESSION["email"] = $login;
            $_SESSION["username"] = $result->username;
            $_SESSION["admin"]= $result->admin;
            $get = new admin_users();
            $id = $get->get_ID($_SESSION["username"]);
            $_SESSION["id"]= $id;

            if(isset($_POST['remember'])){
                $email = $_POST['email'];
                $this_username = $result->username;
                $admin_cookie = $result->admin;
                setcookie("email", $email, time() + 3600 * 24 * 60);
                setcookie("username", $this_username, time() + 3600 * 24 * 60);
                setcookie("id", $id, time() + 3600 * 24 * 60);
                setcookie("admin", $admin_cookie, time() + 3600 * 24 * 60);
            }

            header("Location:index.php?id=$id");
            exit; 
        }
    }       
    else
    {
        ?> <h2>Incorrect email/password</h2> <?php
    }
} 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    <h3 class="mb-5" style="text-shadow: -1px 0px lightgrey">Login</h3>

<?php if(isset($_GET["success"]) && $_GET["success"]=="true"){?>
<h1>
    User created
</h1>
<?php } ?>
    <form method="post">
    <div class="form-group">
        Email: <input class="form-control" type="text" name="email" placeholder="exemple@gmail.com"><br>
    </div>
    <div class="form-group">
        Password: <input class="form-control" type="password" name="password"><br>
    </div>
    <label for="remerber-me" class="form-check-label">Remember me</label>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remember" value="remember-be"><br>
    </div>
     <input class="btn btn-primary" type="submit" value="Log in">
    <p> Don't have an account? Sign up <a href="inscription.php" class="btn btn-outline-info">HERE </a>
    <p> <a href="forgotpassword.php"> Forgot your password? </a>

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
