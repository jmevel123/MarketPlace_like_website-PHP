<?php

include_once ("DB_connect.php");

class Admin_product{

    public $bd;

    public function __construct(){
        $pdo = new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
        $this->bd = $pdo->getConn();
    }

    public function add_product(string $name, int $price, int $category_id, string $description){
        if($this->exist_product($name) == false)
        {
       $sql = "INSERT INTO products (name, price, category_id, description, added_at)
                VALUES (:name, :price, :category_id, :description, NOW())";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
        //$result = $stmt->fetch();

        echo "Product created.\n";
        }
        else 
        echo "Name of product already exist, please take an other name.\n";
   }

   public function exist_product(string $name){
    $sql = "SELECT * FROM products WHERE name = :name";

    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->execute(); 

    $result = $stmt->fetch();

    if($result){
        return TRUE; 
    }
    else{
        return FALSE;
    }
}

public function select_product($id){
    $sql =  "SELECT * FROM products WHERE id = :id";

   $stmt = $this->bd->prepare($sql);
   $stmt->bindParam(":id", $id);
   $stmt->execute();
   $result = $stmt->fetch(PDO::FETCH_ASSOC);
   return $result;
}

   public function delete_product(int $id){
        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        echo "Product deleted with success.\n";
    }

    public function display_product($id){
        $sql = "SELECT * FROM products WHERE id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function display_Allproducts(){
        $sql = "SELECT * FROM products";

        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;

    }

    public function edit_product($id){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];

        $sql = "UPDATE products SET name = :name, price = :price , category_id = :category_id, description = :description  
        WHERE id = :id"; 

        $stmt = $this->bd->prepare($sql); 

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
        
}

    public function get_ID_product($id){

        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt= $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function searchQ($q){
            $sqlName = "SELECT * FROM products WHERE CONCAT(name, price, category_id, description) LIKE :q ORDER BY name ASC";

            $stmt = $this->bd->prepare($sqlName);
            $like = "%". $q . "%";
            $stmt->bindParam(":q", $like);
            $stmt->execute();
            $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $search;
    
            if($search->rowCount() == 0){
                echo "No product found for: $q.\n";
            }
    }

    public function name_parentID($category_id){
        $sql = "SELECT name FROM categories WHERE id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $category_id);
        $stmt->execute();
        $search = $stmt->fetch();
        return $search["name"];
    }

    public function allProductInCat($category_id){
        $sql = "SELECT * FROM products WHERE category_id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $category_id);
        $stmt->execute();
        $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $search;
    }
}

// $product = new Admin_product();
// $product->add_product("Sucette", 7, 0, "très belle sucette à sucer");
// $product->add_product("Cornetto", 5, 1, "Bon cornet pas cher");
// $product->add_product("Magnum", 2, 0, "ENORME glâce bien grosse avec coeur coulant, très apprécié par la gente feminine");
// $product->add_product("haribo", 12, 1, "super bon");



?>