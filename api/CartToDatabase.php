<?php 
    include 'config/CartConfig.php';
    $lib = new CartConfig();
    $lib->AddItems();
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

        if(isset($_SESSION['MemberID'])){
            $memberID = $_SESSION['MemberID'];
        }

        if($lib){
            // unset($_SESSION['keranjang']);
            echo '<script> window.location.href = "OrderSuccess.php?MemberID='.$memberID.'; "</script>';
            // header("Location : index.php");
            // echo 'berhasil';
        }
    }

?>