<?php
class KategoriConfig
{
    private $conn;
    
    private function getConnection() {
        if ($this->conn === null) {
            $hostname = '1h2xah.h.filess.io';
            $dbname = 'Solaris_funnyaddby';
            $username = 'Solaris_funnyaddby';
            $password = '90846628df0a97937365356a77001ad67e310f98';
            $port = 3307;
            
            try {
                $this->conn = new PDO(
                    "mysql:host=$hostname;port=$port;dbname=$dbname;charset=utf8", 
                    $username, 
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_PERSISTENT => false
                    ]
                );
            } catch(PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
    
    private function closeConnection() {
        $this->conn = null;
    }
    
    public function show()
    {
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM kategori");
        $query->execute();
        $data = $query->fetchAll();
        $this->closeConnection();
        return $data;
    }

    public function ShowRow(){
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM kategori");
        $query->execute();
        $dataa = $query->fetchAll();
        $this->closeConnection();
        return $dataa;
    }

    public function AddKategori($nm_kategori) {
        $conn = $this->getConnection();
        $query = "INSERT INTO kategori (nama) VALUES (:nama)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nama', $nm_kategori);
        $stmt->execute();
        $this->closeConnection();
    }

    public function get_by_id($id){
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM kategori where KategoriID=?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $this->closeConnection();
        return $result;
    }

    public function update($id,$nm_kategori){
        $conn = $this->getConnection();
        $query = $conn->prepare('UPDATE kategori set nama=? where KategoriID=?');
        $query->bindParam(1, $nm_kategori);
        $query->bindParam(2, $id);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }

    public function delete($id)
    {
        $conn = $this->getConnection();
        $query = $conn->prepare("DELETE FROM kategori where KategoriID=?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }
}
?>