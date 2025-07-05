<?php 
class Login {
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
                                        "SELECT * FROM member where
                                        email like '%$search%' ");
        $query1->execute();
        $searchdata = $query1->fetchAll();
        $this->closeConnection();
        return $searchdata;
    }

    public function MemberID($search) {
        $conn = $this->getConnection();
        $query1 = $conn->prepare(
                                        "SELECT * FROM member where
                                        email like '%$search%' ");
        $query1->execute();
        $searchdata = $query1->fetchAll();
        $this->closeConnection();
        return $searchdata;
    }

    public function countingRow() {
        $conn = $this->getConnection();
        
        $Qmember = $conn->prepare("SELECT COUNT(*) FROM member where role = 'User'");
        $Qmember->execute();
        $Membercount = $Qmember->fetchColumn();

        $Qadmin = $conn->prepare("SELECT COUNT(*) FROM member where role = 'Admin'");
        $Qadmin->execute();
        $Admincount = $Qadmin->fetchColumn();

        $Qproduk = $conn->prepare("SELECT COUNT(*) FROM produk");
        $Qproduk->execute();
        $Produkcount = $Qproduk->fetchColumn();

        $Qkategori = $conn->prepare("SELECT COUNT(*) FROM kategori");
        $Qkategori->execute();
        $Kategoricount = $Qkategori->fetchColumn();

        $Qorder = $conn->prepare("SELECT COUNT(*) FROM orders");
        $Qorder->execute();
        $Ordercount = $Qorder->fetchColumn();

        $this->closeConnection();
        return array($Membercount, $Admincount, $Produkcount, $Kategoricount, $Ordercount);
    }

    public function checkCredentials($username, $password) {
        $conn = $this->getConnection();
        
        $query = "SELECT role FROM member WHERE email = :username AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $Rolee = $row['role'];

            if ($Rolee == 'User'){
                $query = "SELECT * FROM member WHERE email = :username AND password = :password";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['logged_in'] = true;
                    $_SESSION['cart'] = true;
                    $_SESSION['RoleUser'] = $Rolee;
                    $_SESSION['MemberID'] = $row['MemberID'];
                    $_SESSION['Nama'] = $row['Nama'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['Telp'] = $row['Telp'];
                    $_SESSION['Alamat'] = $row['Alamat'];
                    $_SESSION["username"] = $username;
                    
                    $this->closeConnection();
                    // echo "<script>console.log('Login berhasil untuk user: " . $row['nama'] . "');</script>";
                    echo "<script>setTimeout(function(){ window.location.href = '/'; }, 1000);</script>";
                } else {
                    $this->closeConnection();
                    echo "<script>console.log('Login gagal: Invalid username or password');</script>";
                    echo "Invalid username or password";
                }
            }
            elseif ($Rolee == 'Admin'){
                $query = "SELECT * FROM member WHERE email = :username AND password = :password";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    session_start();
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['memberid'] = $row['memberid'];
                    $_SESSION["username"] = $username;
                    $_SESSION["RoleAdmin"] = $Rolee;
                    
                    $this->closeConnection();
                    header("Location: /admin");
                } else {
                    $this->closeConnection();
                    echo "Invalid username or password";
                }
            }
        } else {
            $this->closeConnection();
        }
    }
}
?>