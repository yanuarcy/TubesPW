<?php 
    class Login {
        private $conn;
    
        public function __construct() {
            $hostname = 'fm07c.h.filess.io';
            $dbname = 'solaris_pleasuremy';
            $username = 'solaris_pleasuremy';
            $password = '8c9eb5761d390d7147a2f9e4013c3680ac16fb69';
            $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
        }

        public function ShowSearch($search) {
            $query1 = $this->conn->prepare(
                                            "SELECT * FROM member where
                                            email like '%$search%' ");
            // $query1->bindParam(':username', $search);
            $query1->execute();
            $searchdata = $query1->fetchAll();  
            return $searchdata;
    
        }

        public function MemberID($search) {
            $query1 = $this->conn->prepare(
                                            "SELECT * FROM member where
                                            email like '%$search%' ");
            // $query1->bindParam(':username', $search);
            $query1->execute();
            $searchdata = $query1->fetchAll();  
            return $searchdata;
    
        }

        public function countingRow() {
            $Qmember = $this->conn->prepare("SELECT COUNT(*) FROM member where role = 'User'");
            $Qmember->execute();
            $Membercount = $Qmember->fetchColumn();

            $Qadmin = $this->conn->prepare("SELECT COUNT(*) FROM member where role = 'Admin'");
            $Qadmin->execute();
            $Admincount = $Qadmin->fetchColumn();

            $Qproduk = $this->conn->prepare("SELECT COUNT(*) FROM produk");
            $Qproduk->execute();
            $Produkcount = $Qproduk->fetchColumn();

            $Qkategori = $this->conn->prepare("SELECT COUNT(*) FROM kategori");
            $Qkategori->execute();
            $Kategoricount = $Qkategori->fetchColumn();

            $Qorder = $this->conn->prepare("SELECT COUNT(*) FROM orders");
            $Qorder->execute();
            $Ordercount = $Qorder->fetchColumn();

            // $Qorder = $this->conn->prepare("SELECT COUNT(*) FROM order");
            // $Qorder->execute();
            // $Ordercount = $Qorder->fetchColumn();

            return array($Membercount, $Admincount, $Produkcount, $Kategoricount, $Ordercount);
            

        }
    
        public function checkCredentials($username, $password) {
            $query = "SELECT role FROM member WHERE email = :username AND password = :password";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $Rolee = $row['role'];
            


                if ($Rolee == 'User'){
                    $query = "SELECT * FROM member WHERE email = :username AND password = :password";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();

                    $query2 = "SELECT nama FROM member WHERE email = :username AND password = :password";
                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bindParam(':username', $username);
                    $stmt2->bindParam(':password', $password);
                    $stmt2->execute();

                    $query4 = "SELECT email FROM member WHERE email = :username AND password = :password";
                    $stmt4 = $this->conn->prepare($query4);
                    $stmt4->bindParam(':username', $username);
                    $stmt4->bindParam(':password', $password);
                    $stmt4->execute();

                    $query3 = "SELECT memberid FROM member WHERE email = :username AND password = :password";
                    $stmt3 = $this->conn->prepare($query3);
                    $stmt3->bindParam(':username', $username);
                    $stmt3->bindParam(':password', $password);
                    $stmt3->execute();

                    

                    if ($stmt->rowCount() > 0) {
                        // Login successful
                        // $_SESSION['nama'] = true;
                        // session_start();
                        $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
                        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['logged_in'] = true;
                        $_SESSION['cart'] = true;
                        $_SESSION['RoleUser'] = $Rolee;
                        $_SESSION['MemberID'] = $row3['memberid'];
                        $_SESSION['Nama'] = $row2['nama'];
                        $_SESSION['Email'] = $row['Email'];
                        $_SESSION['Telp'] = $row['Telp'];
                        $_SESSION['Alamat'] = $row['Alamat'];
                        $_SESSION["username"] = $username;
                        // header("Location: index.php");
                        // Console log untuk login berhasil
                        echo "<script>console.log('Login berhasil untuk user: " . $row['Nama'] . "');</script>";
                        echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 1000);</script>";
                    } else {
                        // Login failed
                        // echo "Invalid username or password";
                        echo "<script>console.log('Login gagal: Invalid username or password');</script>";
                        echo "Invalid username or password";
                    }
                }
                elseif ($Rolee == 'Admin'){
                    $query = "SELECT * FROM member WHERE email = :username AND password = :password";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
                    
                    $query2 = "SELECT nama FROM member WHERE email = :username AND password = :password";
                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bindParam(':username', $username);
                    $stmt2->bindParam(':password', $password);
                    $stmt2->execute();

                    $query3 = "SELECT memberid FROM member WHERE email = :username AND password = :password";
                    $stmt3 = $this->conn->prepare($query3);
                    $stmt3->bindParam(':username', $username);
                    $stmt3->bindParam(':password', $password);
                    $stmt3->execute();

                    // $stmt = $this->conn->prepare("SELECT AdminID FROM admin WHERE email = ?");
                    // $stmt->execute([$_SESSION['username']]);
                    // $adminID = $stmt->fetchColumn();
                    
                    
                    if ($stmt->rowCount() > 0) {
                        // Login successful
                        session_start();
                        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                        $row2 = $stmt3->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['nama'] = $row['nama'];
                        $_SESSION['memberid'] = $row2['memberid'];
                        $_SESSION["username"] = $username;
                        $_SESSION["RoleAdmin"] = $Rolee;
                        header("Location: admin/Dashboard.php");
                    } else {
                        // Login failed
                        echo "Invalid username or password";
                    }
                }
            }else{
                
            }
        }
    }

    
    





?>