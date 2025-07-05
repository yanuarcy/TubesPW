<?php
class ProdukConfig
{
    private $conn;
    
    private function getConnection() {
        if ($this->conn === null) {
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
    
    public function ShowSearch($search) {
        $conn = $this->getConnection();
        $query1 = $conn->prepare(
                                        "SELECT * FROM produk where
                                        itemid like '$search' or 
                                        nm_barang like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();
        $this->closeConnection();
        return $searchdata;
    }
    
    public function show()
    {
        $conn = $this->getConnection();
        
        $query1 = $conn->prepare("SELECT * FROM produk");
        $query1->execute();
        $ConfigProduk = $query1->fetchAll();

        $query2 = $conn->prepare("SELECT * FROM produk order by rand()");
        $query2->execute();
        $Showadmin = $query2->fetchAll();

        $query3 = $conn->prepare("SELECT * FROM produk ORDER BY RAND() limit 6");
        $query3->execute();
        $Showuser = $query3->fetchAll();

        $this->closeConnection();
        return array($ConfigProduk, $Showadmin, $Showuser);
    }

    public function getItemsByCategory($category) {
        $conn = $this->getConnection();
        
        if($category == "All") {
            $query = "SELECT * FROM produk order by rand()";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->closeConnection();
            return $result;
        }
        
        $query2 = "SELECT * FROM produk WHERE kategoriid = $category";
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
        $result = $stmt2->fetchAll();
        $this->closeConnection();
        return $result;
    }

    public function AddProduk($nm_barang, $kategori, $stok, $harga, $deskripsi, $memberID, $fileName) {
        $conn = $this->getConnection();
        
        $query = "SELECT kategoriid FROM kategori WHERE nama = :kategori";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['kategoriid'] = $row['kategoriid'];
            $KategoriID = $_SESSION['kategoriid'];
        }

        $query2 = "INSERT INTO produk (kategoriid, memberid, nm_barang, harga, stok, deskripsi, photo) VALUES (:kategori, :memberID, :nm_barang, :input, :stok, :deskripsi, :photo)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':nm_barang', $nm_barang);
        $stmt2->bindParam(':kategori', $KategoriID);
        $stmt2->bindParam(':stok', $stok);
        $input = intval(preg_replace("/[^0-9]/", "", $harga));
        $stmt2->bindParam(':input', $input);
        $stmt2->bindParam(':deskripsi', $deskripsi);
        $stmt2->bindParam(':memberID', $memberID);
        $stmt2->bindParam(':photo', $fileName);
        $stmt2->execute();
        
        $this->closeConnection();
    }

    public function get_by_id($id){
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM produk where ItemID = :ItemID");
        $query->bindParam(':ItemID', $id);
        $query->execute();
        $result = $query->fetch();
        $this->closeConnection();
        return $result;
    }

    public function showupdate($id){
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM produk where ItemID = :ItemID");
        $query->bindParam(':ItemID', $id);
        $response = array();
        $query->execute();
        foreach($query as $row){
            $response = $row;
        }
        $this->closeConnection();
        echo json_encode($response);
    }

    public function update($id,$nm_barang, $kategori, $stok, $harga, $deskripsi, $memberID, $fileName){
        $conn = $this->getConnection();
        
        $query = "SELECT kategoriid FROM kategori WHERE nama = :kategori";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['kategoriid'] = $row['kategoriid'];
            $KategoriID = $_SESSION['kategoriid'];
        }

        $query2 = $conn->prepare('UPDATE produk set kategoriid = :kategori, memberid = :memberID, nm_barang = :nm_barang, stok = :stok, harga = :input, deskripsi = :deskripsi, photo = :photo  where ItemID = :itemId');
        $query2->bindParam(':kategori', $KategoriID);
        $query2->bindParam(':memberID', $memberID);
        $query2->bindParam(':nm_barang', $nm_barang);
        $query2->bindParam(':stok', $stok);
        $input = intval(preg_replace("/[^0-9]/", "", $harga));
        $query2->bindParam(':input', $input);
        $query2->bindParam(':deskripsi', $deskripsi);
        $query2->bindParam(':photo', $fileName);
        $query2->bindParam(':itemId', $id);

        $query2->execute();
        $result = $query2->rowCount();
        $this->closeConnection();
        return $result;
    }

    public function delete($id)
    {
        $conn = $this->getConnection();
        $query = $conn->prepare("DELETE FROM produk where ItemID=?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }
}
?>