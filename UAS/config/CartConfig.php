<?php 
    class CartConfig {

        private $conn;
    
        public function __construct() {
            $hostname = 'localhost';
            $dbname = 'uas';
            $username = 'yanuar';
            $password = '@boboho567';
            $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
            
        }

        public function show(){
            session_start();
            $_SESSION['keranjang'] = true;
            $query = $this->conn->prepare("SELECT * FROM orders");
            $query->execute();
            $Orders = $query->fetchAll();

            $query2 = $this->conn->prepare("SELECT * FROM orderdetails");
            $query2->execute();
            $Details = $query2->fetchAll();

            

            return array($Orders, $Details);

        }

        public function ShowSearch($search) {
            $query1 = $this->conn->prepare(
                                            "SELECT * FROM orders where 
                                            orderid like '$search'");
            $query1->execute();
            $searchdata = $query1->fetchAll();  
            return $searchdata;
    
        }

        public function ShowWithDate($start_date, $end_date ){
            $query = "SELECT * FROM orderdetails WHERE tgl_order BETWEEN :start_date AND :end_date";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;

        }

        public function AddItems(){
            session_start();
            $cartt = $_SESSION['keranjang'];
            if(isset($_SESSION['MemberID'])){
                $memberID = $_SESSION['MemberID'];
            }

            if(isset($_SESSION['Nama'])){
                $Nama = $_SESSION['Nama'];
                // echo "Welcome $Nama";
            }

            $GrandTotal = 0;
            foreach($cartt as $item){
                
                // print_r($item);
                // $pdo = new PDO('mysql:host=localhost;dbname=uas;charset=utf8', 'yanuar', '@boboho567');
                $sql                = "SELECT * FROM produk WHERE itemid = :product_id";
                $stmt               = $this->conn->prepare($sql);
                // $pdo->bind_param(':nm_barang', $row['id']);
                $data['product_id'] = $item['id'];
                                    $stmt->execute($data);
                $product            = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $total = $product['Harga'] * $item['jumlah'];
                $GrandTotal += $total;
        
                $imageURL = 'admin/produk/img/'.$product['photo'];
            }

            $query2 = 'INSERT INTO orders (memberid, total_harga, tgl_order) VALUES (:memberID, :Total, :TglOrder)';
            $stmt2 = $this->conn->prepare($query2);
            date_default_timezone_set("Asia/Jakarta");
            $TglOrder = date('Y-m-d H:i:s');
            $stmt2->bindParam(':memberID', $memberID);
            $stmt2->bindParam(':Total', $GrandTotal);
            $stmt2->bindParam(':TglOrder', $TglOrder);
            $stmt2->execute();
            $lastInsertId = $this->conn->lastInsertId();

            
            foreach($cartt as $item){
                $sql                = "SELECT * FROM produk WHERE itemid = :product_id";
                $stmt               = $this->conn->prepare($sql);
                // $pdo->bind_param(':nm_barang', $row['id']);
                $data['product_id'] = $item['id'];
                                    $stmt->execute($data);
                $product            = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $total = $product['Harga'] * $item['jumlah'];
                // $GrandTotal += $total;
        
                $imageURL = 'admin/produk/img/'.$product['photo'];

                
                $query = 'INSERT INTO orderdetails (orderid, itemid, tgl_order, nama, nm_barang, jml_barang, total_harga) VALUES (:lastInsertId, :itemID, :TglOrder, :Nama, :Nm_Barang, :Jumlah, :Total)';
                $stmt = $this->conn->prepare($query);
                // $order_id = $this->conn->lastInsertId();
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

                $query2 = $this->conn->prepare("SELECT stok FROM produk where itemid = :itemId");
                $query2->bindParam(':itemId', $item['id']);
                $query2->execute();
                if ($query2->rowCount() > 0) {
                    // session_start();
                    $row = $query2->fetch(PDO::FETCH_ASSOC);
                    $OldStok = $row['stok'];
                }

                $query3 = $this->conn->prepare('UPDATE produk set stok = :Newstok where itemid = :itemId');
                $NewStok = $OldStok - $item['jumlah'];
                $query3->bindParam(':Newstok', $NewStok);
                $query3->bindParam(':itemId', $item['id']);

                $query3->execute();
                // return $query3->rowCount();
                
                // print_r($product);
            }

            unset($_SESSION['keranjang']);

            
            
        }




    }




?>