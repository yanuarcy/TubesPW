<?php
class KategoriConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'fm07c.h.filess.io';
        $dbname = 'solaris_pleasuremy';
        $username = 'solaris_pleasuremy';
        $password = '8c9eb5761d390d7147a2f9e4013c3680ac16fb69';
        $port = 3307;
        
        try {
            $this->conn = new PDO(
                "mysql:host=$hostname;port=$port;dbname=$dbname;charset=utf8", 
                $username, 
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM kategori");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function ShowRow(){
        $query = $this->conn->prepare("SELECT * FROM kategori");
        $query->execute();
        $dataa = $query->fetchAll();
        return $dataa;
    }

    public function AddKategori($nm_kategori) {
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO kategori (nama) VALUES (:nama)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nm_kategori);
        $stmt->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM kategori where KategoriID=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id,$nm_kategori){
        $query = $this->conn->prepare('UPDATE kategori set nama=? where KategoriID=?');
        $query->bindParam(1, $nm_kategori);
        $query->bindParam(2, $id);

        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM kategori where KategoriID=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>