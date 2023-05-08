<?php 
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else {
        $id = null;
    }

    if(isset($_SESSION['keranjang'][$id])){
        unset($_SESSION['keranjang'][$id]);
        unset($_SESSION['cart'][$id]);
    }

    echo '<script> window.location = "Cart.php"; </script>';



?>