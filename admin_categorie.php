<?php

include_once ("DB_connect.php");

class admin_category{
    public function __construct(){
        $pdo = new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
        $this->bd = $pdo->getConn();
    }

    public function exist_category(string $name){
        $sql = "SELECT * FROM categories WHERE name = :name";

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

    public function add_category(string $name, int $parent_id = 0){
        if($this->exist_category($name) == false)
        {
            $sql = "INSERT INTO categories (name, parent_id)
                    VALUES (:name, :parent_id)";

            $stmt = $this->bd->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":parent_id", $parent_id);
            $stmt->execute(); 
            
            echo "New category added.\n";
        }
        else 
        echo "Name of category already exist, please take an other name.\n";
    }

    public function delete_category(int $id){
        // $id = $_GET['id'];

        $sql = "DELETE FROM categories WHERE id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        echo "Category deleted with success.\n";
    }

    public function edit_category($id){
            
        $name = $_POST['name'];
        $parent_id = $_POST['parent_id'];
        
        $sql = "UPDATE categories SET name = :name, parent_id = :parent_id
        WHERE id = :id"; 
                //on crée des étiquettes pour protéger

        $stmt = $this->bd->prepare($sql); // on prépare sa requête 

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":parent_id", $parent_id);
        $stmt->bindParam(":id", $id);

        $result = $stmt->execute();
        return $result;
    }

    public function select_category($id){
        $sql =  "SELECT * FROM categories WHERE id = :id";
    
       $stmt = $this->bd->prepare($sql);
       $stmt->bindParam(":id", $id);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       return $result;
    }

    public function display_AllCategories(){
        $sql = "SELECT * FROM categories";

        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
        // foreach($result as $value)
        // {
        //     echo "Name of category: " . $value["name"] . "\n" . "ID of category: " . $value["id"] . "\n" .  "Parent-ID of category: " . $value["parent_id"] . "\n" . "\n";
        // }
    }

    public function get_ID_category($id){

        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt= $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result['id'];
    }

    public function get_Parent_ID($id){
        $sql = "SELECT * FROM categories WHERE parent_id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }
    
    public function get_product_category_ID($id){
        $sql = "SELECT * FROM products WHERE category_id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function getBd(){
        return $this->bd;
    }

    public function name_parentID($parent_id){
        $sql = "SELECT name FROM categories WHERE id = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $parent_id);
        $stmt->execute();
        $search = $stmt->fetch();
        return $search["name"];
    }
}
?>