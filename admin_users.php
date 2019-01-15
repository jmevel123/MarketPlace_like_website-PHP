<?php
include_once("DB_connect.php");

class admin_users{

    public $bd;

   

    public function __construct(){
        $pdo = new connect_DB("127.0.0.1","root","root",3306,"pool_php_rush");
        $this->bd = $pdo->getConn() ;
    }
    public function forgot_pass($email){ 
        $sql =  "SELECT * FROM users WHERE email = :email";
     
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function checkAdmin($id){
        $sql =  "SELECT id,admin FROM users WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result; 
    }
    public function select_users($id){ 
       $sql =  "SELECT * FROM users WHERE id = :id";
    
       $stmt = $this->bd->prepare($sql);
       $stmt->bindParam(":id", $id);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_OBJ);
       return $result;
    }
    
    public function exist_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Email non valide";
       }

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt= $this->bd->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            return TRUE;   
        }else{
            return FALSE; 
        }
        
    }
    
    public function exist_username($username){
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt= $this->bd->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            return TRUE; 
        }
        else{
            return FALSE;
        }
    }

    public function create_users($firstname, $lastname, $username, $email, $password, $admin = 0){

            $sql = "INSERT INTO users (`firstname`,`lastname`,`username`, `email`,`password`, `admin`,`created_at`) 
                    VALUES(:firstname, :lastname, :username, :email, :password, :admin, NOW())"; 
                    //on crée des étiquettes pour protéger

            $stmt = $this->bd->prepare($sql); // on prépare sa requête 
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":firstname", $firstname); 
            $stmt->bindParam(":username", $username); 
            $stmt->bindParam(":email", $email);
            $hash = password_hash($password, PASSWORD_DEFAULT);//password crypté
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":admin", $admin);
            $result = $stmt->execute();
            return $result;
    }

    public function get_ID($username){

        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt= $this->bd->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id'];
    }

    public function update_users($id){
        
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname , username = :username, email = :email, password = :password   
        WHERE id = :id"; 
                //on crée des étiquettes pour protéger

        $stmt = $this->bd->prepare($sql); // on prépare sa requête 

        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        // crypter le password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":id", $id);

        $result = $stmt->execute();
        return $result;
    }
    
    public function delete_users($id){

        $sql = "DELETE FROM users WHERE id = :id"; 
                    //on crée des étiquettes pour protéger

            $stmt = $this->bd->prepare($sql); // on prépare sa requête 
            $stmt->bindParam(":id", $id); 
            $result = $stmt->execute();
            return $result;    
    }

    public function getBd(){
        return $this->bd;
    }

    public function display_AllUsers(){
        $sql = "SELECT * FROM users";

        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    public function set_admin($id){
        $sql = "UPDATE users SET admin = '1' WHERE id = :id";
        
        $stmt = $this->bd->prepare($sql);
        
        $stmt->bindParam(":id", $id);

        $result = $stmt->execute();

        return $result;
    }

    public function create_users_admin($firstname, $lastname, $username, $email, $password, $admin = 1){

        $sql = "INSERT INTO users (`firstname`,`lastname`,`username`, `email`,`password`, `admin`,`created_at`) 
                VALUES(:firstname, :lastname, :username, :email, :password, :admin, NOW())"; 
                //on crée des étiquettes pour protéger

        $stmt = $this->bd->prepare($sql); // on prépare sa requête 
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":firstname", $firstname); 
        $stmt->bindParam(":username", $username); 
        $stmt->bindParam(":email", $email);
        $hash = password_hash($password, PASSWORD_DEFAULT);//password crypté
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":admin", $admin);
        $result = $stmt->execute();
        return $result;
}

    public function unset_admin($id){
        $sql = "UPDATE users SET admin = '0' WHERE id = :id";
        
        $stmt = $this->bd->prepare($sql);
        
        $stmt->bindParam(":id", $id);

        $result = $stmt->execute();

        return $result;
    }
}
?>