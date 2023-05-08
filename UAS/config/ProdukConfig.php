<?php
class ProdukConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'localhost';
        $dbname = 'uas';
        $username = 'yanuar';
        $password = '@boboho567';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }
    
    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM produk where
                                        itemid like '$search' or 
                                        nm_barang like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }
    
    public function show()
    {
        $query1 = $this->conn->prepare("SELECT * FROM produk");
        $query1->execute();
        $ConfigProduk = $query1->fetchAll();

        $query2 = $this->conn->prepare("SELECT * FROM produk order by rand()");
        $query2->execute();
        $Showadmin = $query2->fetchAll();

        $query3 = $this->conn->prepare("SELECT * FROM produk ORDER BY RAND() limit 6");
        $query3->execute();
        $Showuser = $query3->fetchAll();

        return array($ConfigProduk, $Showadmin, $Showuser);
    }

    public function getItemsByCategory($category) {
        if($category == "All") {
            $query = "SELECT * FROM produk order by rand()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // $query = "SELECT kategoriid FROM kategori WHERE nama = :category";
        // $stmt = $this->conn->prepare($query);
        // $stmt->execute(['category' => $category]);
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $kategoriid = $row['kategoriid'];
        
        $query2 = "SELECT * FROM produk WHERE kategoriid = $category";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute();
        return $stmt2->fetchAll();

    }

    public function AddProduk($nm_barang, $kategori, $stok, $harga, $deskripsi, $memberID, $fileName) {
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT kategoriid FROM kategori WHERE nama = :kategori";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->execute();
        // session_start();
        if ($stmt->rowCount() > 0) {
            // Login successful
            // session_start();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['kategoriid'] = $row['kategoriid'];
            $KategoriID = $_SESSION['kategoriid'];
        }

        $query2 = "INSERT INTO produk (kategoriid, memberid, nm_barang, harga, stok, deskripsi, photo) VALUES (:kategori, :memberID, :nm_barang, :input, :stok, :deskripsi, :photo)";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':nm_barang', $nm_barang);
        $stmt2->bindParam(':kategori', $KategoriID);
        $stmt2->bindParam(':stok', $stok);
        // $stmt2->bindParam(':harga', $harga);
        $input = intval(preg_replace("/[^0-9]/", "", $harga));
        $stmt2->bindParam(':input', $input);
        $stmt2->bindParam(':deskripsi', $deskripsi);
        $stmt2->bindParam(':memberID', $memberID);
        $stmt2->bindParam(':photo', $fileName);
        $stmt2->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM produk where ItemID = :ItemID");
        $query->bindParam(':ItemID', $id);
        $query->execute();
        return $query->fetch();
    }

    public function showupdate($id){
        $query = $this->conn->prepare("SELECT * FROM produk where ItemID = :ItemID");
        $query->bindParam(':ItemID', $id);
        $response = array();
        $query->execute();
        foreach($query as $row){
            $response = $row;
        }
        echo json_encode($response);
    }

    public function update($id,$nm_barang, $kategori, $stok, $harga, $deskripsi, $memberID, $fileName){

        $query = "SELECT kategoriid FROM kategori WHERE nama = :kategori";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->execute();
        // session_start();
        if ($stmt->rowCount() > 0) {
            // session_start();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['kategoriid'] = $row['kategoriid'];
            $KategoriID = $_SESSION['kategoriid'];
        }


        $query2 = $this->conn->prepare('UPDATE produk set kategoriid = :kategori, memberid = :memberID, nm_barang = :nm_barang, stok = :stok, harga = :input, deskripsi = :deskripsi, photo = :photo  where ItemID = :itemId');
        $query2->bindParam(':kategori', $KategoriID);
        $query2->bindParam(':memberID', $memberID);
        $query2->bindParam(':nm_barang', $nm_barang);
        $query2->bindParam(':stok', $stok);
        // $query2->bindParam(':harga', $harga);
        $input = intval(preg_replace("/[^0-9]/", "", $harga));
        $query2->bindParam(':input', $input);
        $query2->bindParam(':deskripsi', $deskripsi);
        $query2->bindParam(':photo', $fileName);
        $query2->bindParam(':itemId', $id);

        $query2->execute();
        return $query2->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM produk where ItemID=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>