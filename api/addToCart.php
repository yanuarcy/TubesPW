<?php 
    include 'config/ProdukConfig.php';
    $lib = new ProdukConfig();

    session_start();
    // session_destroy();
    // $inputValue = $_GET['inputValue'];
    // $_SESSION['inputValue'] = $inputValue;

    
    $id             = $_GET['id'];
    $data_produk    = $lib->get_by_id($id);
    $jml            =  1;

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        if($_SESSION['keranjang'][$id]){
            $jml = $_SESSION['keranjang'][$id]['jumlah'] + 1;
        }
        // if($_SESSION['orderdetail'][$id]){
        //     $jml = $_SESSION['orderdetail'][$id]['jumlah'] + 1;
        // }
    }else {
        if($_SESSION['cart'][$id]){
            $jml = $_SESSION['cart'][$id]['jumlah'] + 1;
        }
    }

    
    $item           = [
        'id'        => $id,
        'jumlah'    => $jml,
    ];

    $_SESSION['cart'][$id] = $item;
    $_SESSION['keranjang'][$id] = $item;
    // $_SESSION['orderdetail'][$id] = $item;


    // if(!isset($_SESSION['cart'][$id])) {
    //     $_SESSION['cart'][$id]['jumlah'] = $jml;
    // }
    // else if(isset($_SESSION['cart'][$id])) {
    //     $_SESSION['cart'][$id]['jumlah'] += 1;
    // }
    


    // $qty = 1;
    // if(isset($_POST['qty'])) {
    //     $qty = max($_POST['qty'],1);
    // }

    // if(!isset($_SESSION['keranjang'])){
    //     $_SESSION['keranjang'] = [];
    // }

    // $id = $_GET['id'];
    // if(!isset($_SESSION['keranjang'][$id])){
    //     $_SESSION['keranjang'][$id] = $qty;
    // }else {
    //     $_SESSION['keranjang'][$id] += $qty;
    // }

    if(isset($_SESSION['ProdukPage'])) {
        echo '<script> window.location = "/product"; </script>';
    }else {
        echo '<script> window.location = "/"; </script>';
    }
    


?>