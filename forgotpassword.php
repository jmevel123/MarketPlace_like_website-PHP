<?php
 include_once("admin_users.php");
 include_once("DB_connect.php");
if(isset($_POST) && !empty($_POST))
{
$forgot_pass= new admin_users();
$forgot_password= $forgot_pass->forgot_pass($_POST["email"]);
    if($forgot_password = $_POST["email"])
    {
        $password= uniqid();
        $to=$_POST["email"];
        $subject="Your recovered password";
        $message="Please use this password to login". $password;
        //$headers="From :jeremy.mevel@coding-academy.fr";
        $test=mail($to,$subject,$message);
        if(mail($to,$subject,$message)){
            echo "Your password has been sent to your mail id";
            $db=new connect_DB("localhost", "root", "root", 3306, "pool_php_rush");
            $sql = "UPDATE users SET password = :password   
                    WHERE email = :email"; 

            $stmt = $db->getConn()->prepare($sql);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":email", $to);
            $stmt->execute();
            header("location:forgotpassword.php?success=true");

        }
        else{
            var_dump(error_get_last());
            echo "Failed to recover your password. Try again.";
        }
    }
    else{
        echo "User name does not exist.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password forgotten</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>


<?php include_once("navbar.php") ?>
<div class="container">

<?php if(isset($_GET["success"]) && $_GET["success"]=="true"){?>
<h1>
    New password sent on your email. <br> Don't forget to change it !
</h1>
<?php } ?>
<br>
    <form method="post">

    <div class="form-group">
        Email: <input class="form-control" type="text" name="email" placeholder="exemple@gmail.com"><br>
        </div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Send new password">
    </div>

    </form>
    <br>
    <p> Or </p>
    <a href="login.php"> Get back</a>
    <br>

   <footer class="page-footer font-small blue">
</div>
<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</footer>

</body>
</html>
