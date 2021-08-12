<?php

class database{

    private $servername = "127.0.0.1";
    private $username ="root";
    private $password = "";
    private $databasename = "test";
    public $db;

    public function __construct(){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function insert( $table, $data ){
        try{
            $id = isset($data['id']) && !empty($data['id']) && $data['id'] != 'auto' ? $data['id'] : NULL;
            $name = isset($data['name']) ? $data['name'] : '';
            $email = isset($data['email']) ? $data['email'] : '';
            $phone = isset($data['phone']) ? $data['phone'] : '';
            $title = isset($data['title']) ? $data['title'] : '';
            $created = isset($data['created']) ? $data['created'] : date('Y-m-d H:i:s');

            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('INSERT INTO '.$table.' VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$id, $name, $email, $phone, $title, $created]);

            header('Location: read.php');
            exit;
            
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }
    
    public function read( $table ){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('SELECT * FROM '.$table.' ORDER BY id');
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }    
    }

    public function displayRecord( $table, $id ){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('SELECT * FROM '.$table.' WHERE id = ?');
            $stmt->execute( [ $id ] );
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contact;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }          
    }

    public function update($table, $id){
        try{
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d');

            // Update the record
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('UPDATE '.$table.' SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
            $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);

            header('Location: read.php');
            exit;

        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }    
    }

    public function delete( $table, $id){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('DELETE FROM '.$table.' WHERE id = ?');
            $stmt->execute([$id]);
        }catch(PDOException $e){
            die("Failed to connect with MySQL: ". $e->getMessage());
        }
    }

    public function __destruct(){

    }

}

?>