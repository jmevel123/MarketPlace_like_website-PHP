<?php
include_once("admin_product.php");
include_once("DB_connect.php");
include_once("admin_categorie.php");

 session_start();

 if(!isset($_SESSION["username"]) && empty($_COOKIE["username"]))
{
    header('Location:login.php');
    exit;
}
$placeholder= new admin_category();
$valueholder= $placeholder->select_category($_GET['id']);
$display_category= $placeholder->display_AllCategories();
$parent_name = $placeholder->select_category($valueholder["parent_id"]);

$testcat =false;
if(!empty($_POST)) // on vérifie que le formutalire a été envoyé, même chose que la commande commantée en dessous
{
    extract($_POST); //convertie les clé en valeur : tableu ET convertie tous les name du formulaire en variable ex: $name = $_POST["name]
    
        $errors = array();

        $verify = new admin_category;
    
        if(strlen($name) < 3) 
        {
            array_push($errors, "Invalid name. Min 3 characters required.\n");
        }
        
    if($old_name != $name){
        if($verify->exist_category($name))
        {
            array_push($errors, "This category already exist, please choose another name..\n");
        }
    }
        
    
        if(empty($errors))
            {
        $update = new admin_category;
    
            $testcat = $placeholder->edit_category($_GET['id']);
            header("location:admin.php?category=update");
            // header("location:login.php");     RAJOUTER AVEC DELAY DE 3 SEC
           }
}

?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update_cat_admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>

 </head>
 <body>
 <?php include_once("navbar.php") ?>
<div class="container">

<form method="post">
<h3>Update category</h3>

<?php if(!empty($errors)) { ?>
<ul>
       <?php foreach ($errors as $error) : ?>
       <li> <?php echo $error; ?> </li>
       <?php endforeach ?>      
</ul>
<?php } ?>

<?php if($testcat) { ?>
<h1>Category Updated</h1>
<?php ;} ?> 
<form methode ="post">
    <div class="form-group">
<input type="hidden" class="form-control" name="old_name" value="<?php echo $valueholder["name"]; ?>">
</div>
    <div class="form-group">
<input type="text" class="form-control" name="name" id="name" placeholder="name" value="<?php echo $valueholder["name"]; ?>" required><br>
</div>
    <div class="form-group">
      <select id="categories" class="form-control" name="parent_id">
          <?php
            echo" <option value='0'>choisir une catégorie</option>";
            foreach($display_category as $category){
                $selected = "";
                if($category["id"] != $valueholder["id"]){
                  if($category["id"] == $valueholder["parent_id"])
                {
                    $selected = "selected";
                }
                  echo "<option value=".$category["id"]." $selected >".$category["name"]."</option>";
                }  
            }
          ?>
      </select> 
      </div>
      <br>     
      <button class="btn btn-success">Update Category</button>
</form>  
<p> Or </p>
<a href ="admin.php"> Get back to admin without changes</a>     
<br>
</div>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="#"> Gang-Bang-Théory.com</a>
</div>
<!-- Copyright -->

</body>
</html>
