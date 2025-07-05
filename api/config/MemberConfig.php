<?php
class MemberConfig
{
    private $conn;
    
    public function __construct() {
        $hostname = 'fm07c.h.filess.io';
        $dbname = 'solaris_pleasuremy';
        $username = 'solaris_pleasuremy';
        $password = '8c9eb5761d390d7147a2f9e4013c3680ac16fb69';
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$password");
    }

    public function UpdatePw($Psswd, $memberIDnoLogin){
        $query = $this->conn->prepare("UPDATE member set password = :password where memberid = :memberid ");
        // $query->bindParam(1, $Psswd);
        $query->bindParam(':password', $Psswd);
        $query->bindParam(':memberid', $memberIDnoLogin);

        $query->execute();
        return $query->rowCount();
    }

    public function ShowSearch($search) {
        $query1 = $this->conn->prepare(
                                        "SELECT * FROM member where 
                                        memberid like '%$search%'or
                                        nama like '%$search%' or
                                        email like '%$search%' or
                                        telp like '%$search%' or
                                        alamat like '%$search%' or
                                        role like '%$search%'");
        $query1->execute();
        $searchdata = $query1->fetchAll();  
        return $searchdata;

    }

    public function getItemsByCategory($selectedGender) {
        if($selectedGender == "All") {
            $query = "SELECT * FROM member";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        else if ($selectedGender == "P"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        else if ($selectedGender == "L"){
            $query = "SELECT * FROM member where gender = :gender";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':gender', $selectedGender);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
    
    public function show()
    {
        $query = $this->conn->prepare("SELECT * FROM member");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function createMember($name, $gender, $email, $password, $telp, $alamat, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO member (nama, gender, email, password, telp, alamat, role) VALUES (:name, :gender, :email, :password, :telp, :alamat, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telp', $telp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    public function get_by_id($id){
        $query = $this->conn->prepare("SELECT * FROM member where MemberID=?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch();
    }

    public function update($id,$nama, $gender, $email, $password, $telp, $alamat){
        $query = $this->conn->prepare('UPDATE member set nama=?, gender=?, email=?, password=?, telp=?, alamat=? where MemberID=?');
        $query->bindParam(1, $nama);
        $query->bindParam(2, $gender);
        $query->bindParam(3, $email);
        $query->bindParam(4, $password);
        $query->bindParam(5, $telp);
        $query->bindParam(6, $alamat);
        $query->bindParam(7, $id);

        $query->execute();
        return $query->rowCount();
    }

    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM member where MemberID=?");

        $query->bindParam(1, $id);

        $query->execute();
        return $query->rowCount();
    }

}
?>