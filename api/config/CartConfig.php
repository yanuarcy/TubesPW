<?php 
class CartConfig {
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

    public function show(){
        $conn = $this->getConnection();
        session_start();
        $_SESSION['keranjang'] = true;
        $query = $conn->prepare("SELECT * FROM orders");
        $query->execute();
        $Orders = $query->fetchAll();

        $query2 = $conn->prepare("SELECT * FROM orderdetails");
        $query2->execute();
        $Details = $query2->fetchAll();

        $this->closeConnection();
        return array($Orders, $Details);
    }

    public function ShowSearch($search) {
        $conn = $this->getConnection();
        $query1 = $conn->prepare(
                                        "SELECT * FROM orders where 
                                        orderid like '$search'");
        $query1->execute();
        $searchdata = $query1->fetchAll();
        $this->closeConnection();
        return $searchdata;
    }

    public function ShowWithDate($start_date, $end_date ){
        $conn = $this->getConnection();
        $query = "SELECT * FROM orderdetails WHERE tgl_order BETWEEN :start_date AND :end_date";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $data;
    }

    public function AddItems(){
        $conn = $this->getConnection();
        session_start();
        $cartt = $_SESSION['keranjang'];
        if(isset($_SESSION['MemberID'])){
            $memberID = $_SESSION['MemberID'];
        }

        if(isset($_SESSION['Nama'])){
            $Nama = $_SESSION['Nama'];
        }

        $GrandTotal = 0;
        foreach($cartt as $item){
            $sql = "SELECT * FROM produk WHERE itemid = :product_id";
            $stmt = $conn->prepare($sql);
            $data['product_id'] = $item['id'];
            $stmt->execute($data);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $total = $product['Harga'] * $item['jumlah'];
            $GrandTotal += $total;
            $imageURL = 'admin/produk/img/'.$product['photo'];
        }

        $query2 = 'INSERT INTO orders (memberid, total_harga, tgl_order) VALUES (:memberID, :Total, :TglOrder)';
        $stmt2 = $conn->prepare($query2);
        date_default_timezone_set("Asia/Jakarta");
        $TglOrder = date('Y-m-d H:i:s');
        $stmt2->bindParam(':memberID', $memberID);
        $stmt2->bindParam(':Total', $GrandTotal);
        $stmt2->bindParam(':TglOrder', $TglOrder);
        $stmt2->execute();
        $lastInsertId = $conn->lastInsertId();

        foreach($cartt as $item){
            $sql = "SELECT * FROM produk WHERE itemid = :product_id";
            $stmt = $conn->prepare($sql);
            $data['product_id'] = $item['id'];
            $stmt->execute($data);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $total = $product['Harga'] * $item['jumlah'];
            $imageURL = 'admin/produk/img/'.$product['photo'];

            $query = 'INSERT INTO orderdetails (orderid, itemid, tgl_order, nama, nm_barang, jml_barang, total_harga) VALUES (:lastInsertId, :itemID, :TglOrder, :Nama, :Nm_Barang, :Jumlah, :Total)';
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':lastInsertId', $lastInsertId);
            date_default_timezone_set("Asia/Jakarta");
            $TglOrder = date('Y-m-d H:i:s');
            $stmt->bindParam(':itemID', $item['id']);
            $stmt->bindParam(':TglOrder', $TglOrder);
            $stmt->bindParam(':Nama', $Nama);
            $stmt->bindParam(':Nm_Barang', $product['Nm_Barang']);
            $stmt->bindParam(':Jumlah', $item['jumlah']);
            $stmt->bindParam(':Total', $total);
            $stmt->execute();

            $query2 = $conn->prepare("SELECT stok FROM produk where itemid = :itemId");
            $query2->bindParam(':itemId', $item['id']);
            $query2->execute();
            if ($query2->rowCount() > 0) {
                $row = $query2->fetch(PDO::FETCH_ASSOC);
                $OldStok = $row['stok'];
            }

            $query3 = $conn->prepare('UPDATE produk set stok = :Newstok where itemid = :itemId');
            $NewStok = $OldStok - $item['jumlah'];
            $query3->bindParam(':Newstok', $NewStok);
            $query3->bindParam(':itemId', $item['id']);
            $query3->execute();
        }

        unset($_SESSION['keranjang']);
        $this->closeConnection();
    }
}
?>