<?php
class MemberConfig
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

    public function UpdatePw($Psswd, $memberIDnoLogin){
        $conn = $this->getConnection();
        $query = $conn->prepare("UPDATE member set password = :password where memberid = :memberid ");
        $query->bindParam(':password', $Psswd);
        $query->bindParam(':memberid', $memberIDnoLogin);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }

    public function ShowSearch($search) {
        $conn = $this->getConnection();
        $query1 = $conn->prepare(
                                        "SELECT * FROM member where 
                                        memberid like '%$search%'or
                                        nama like '%$search%' or
                                        email like '%$search%' or
                                        telp like '%$search%' or
                                        alamat like '%$search%' or
                                        role like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();
        $this->closeConnection();
        return $searchdata;
    }

    public function getItemsByCategory($selectedGender) {
        $conn = $this->getConnection();
        
        if($selectedGender == "All") {
            $query = "SELECT * FROM member";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->closeConnection();
            return $result;
        }
        else if ($selectedGender == "P"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->closeConnection();
            return $result;
        }
        else if ($selectedGender == "L"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $this->closeConnection();
            return $result;
        }
    }
    
    public function show()
    {
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM member");
        $query->execute();
        $data = $query->fetchAll();
        $this->closeConnection();
        return $data;
    }

    public function createMember($name, $gender, $email, $password, $telp, $alamat, $role) {
        $conn = $this->getConnection();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO member (nama, gender, email, password, telp, alamat, role) VALUES (:name, :gender, :email, :password, :telp, :alamat, :role)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        $this->closeConnection();
    }

    public function get_by_id($id){
        $conn = $this->getConnection();
        $query = $conn->prepare("SELECT * FROM member where MemberID=?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch();
        $this->closeConnection();
        return $result;
    }

    public function update($id,$nama, $gender, $email, $password, $telp, $alamat){
        $conn = $this->getConnection();
        $query = $conn->prepare('UPDATE member set nama=?, gender=?, email=?, password=?, telp=?, alamat=? where MemberID=?');
        $query->bindParam(1, $nama);
        $query->bindParam(2, $gender);
        $query->bindParam(3, $email);
        $query->bindParam(4, $password);
        $query->bindParam(5, $telp);
        $query->bindParam(6, $alamat);
        $query->bindParam(7, $id);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }

    public function delete($id)
    {
        $conn = $this->getConnection();
        $query = $conn->prepare("DELETE FROM member where MemberID=?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->rowCount();
        $this->closeConnection();
        return $result;
    }
}
?>