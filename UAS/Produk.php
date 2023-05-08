<?php 
    include 'config/LoginConfig.php';
    include 'config/ProdukConfig.php';
    include 'config/MemberConfig.php';
    include 'config/KategoriConfig.php';
    // include 'addToCart.php';
    session_start();
    // session_destroy();
    // unset($_SESSION['logged_in']);
    // $inputValue = $_SESSION['inputValue'];
    $Kategorikolom = new KategoriConfig();
    $showKtgKolom = $Kategorikolom->ShowRow();

    
    $lib = new ProdukConfig();
    $data_produk = $lib->show();

    if(isset($_POST['cari'])) {
        $search = $_POST['keyword'];
        $data_search = $lib->ShowSearch($search);
    }

    if(isset($_SESSION['cart'])){
        $cartT = $_SESSION['cart'];
        // print_r(($cartT));
    }
    
    $_SESSION['ProdukPage'] = true;

    if (isset($_GET['category'])) {
        if(isset($_POST['cari'])) {
            $search = $_POST['keyword'];
            $data_search = $lib->ShowSearch($search);
        }
        else {
            $selectedCategory = $_GET['category'];
            $items = $lib->getItemsByCategory($selectedCategory);
        }
    }
    
    
    
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        unset($_SESSION['cart']);
        // session_regenerate_id();
        if(isset($_SESSION['MemberID'])){
            $cart = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
            // $newcart = [];
            $user_id = $_SESSION['MemberID'];
            $_SESSION['UserCart'.$user_id] = $cart;
            $CarTT = $_SESSION['UserCart'.$user_id];
        }
        // $_SESSION['keranjang'] = $cart;

        
        // if(isset($_SESSION['keranjang'])){
            //     $carT = $_SESSION['keranjang'];
            // }
    } else {
            // unset($_SESSION['cart']);
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
            // $_SESSION['keranjang'] = $cart;
    }
    

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/produk.css">
    <link rel="stylesheet" href="css/ResponsiveProduk.css">


    <title>Solaris - Product</title>

</head>
<body dat-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand page-scroll" href="#home">
                <p>Solaris</p> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto" id="navScroll">
                    <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
                    <a class="nav-link page-scroll" href="About.php">About</a>
                    <a class="nav-link smoothScroll" id="NavProduk" href="Produk.php">Product</a>
                    <form action="" method="post" id="search">
                        <input type="text" id="Search" name="keyword" placeholder="Search By Name.." autocomplete="off">
                        <button id="button" type="submit" name="cari">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    
                </div>
                <div class="Keranjang">
                    <?php 
                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        
                    ?>
                    <h5 class="TextKranjang">
                        <a class="" href="Cart.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Cart <span class="badge badge-warning badge-pill"><?php echo count($CarTT) ?></span></a>
                    </h5 class="TextKranjang">
                    
                    <?php } else {
                        
                    ?>
                    <h5 class="TextKranjang">
                        <a class="" href="Cart.php"><i class="fa-solid fa-cart-shopping mr-2"></i>Cart <span class="badge badge-warning badge-pill"><?php echo count($cart) ?></span></a>
                    </h5 class="TextKranjang">
                    <?php }
                    ?>

                </div>
            </div>
        </nav>
    </div>
    <!-- akhir navbar -->

    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-white" style="margin-top: 2%; font-family: monospace;">Our Product</h1>
        </div>
    </div>

    <div class="container">
        <div class="row SelectRow">
            <form action="" class="formSelect" method="GET" id="formSearch">
                <h1>Kategori Produk</h1>
                <select name="category" class="kategori" onchange="document.getElementById('formSearch').submit()">
                    <option value="All">All</option>
                    <?php 
                        foreach($showKtgKolom as $row){
                            $selected = '';
                            if(isset($_GET['category']) && $_GET['category'] == $row['KategoriID']) {
                                $selected = 'selected';
                            }
                            echo "<option value='".$row['KategoriID']."' ".$selected.">".$row['Nama']."</option>";
                        }
                    ?>
                </select>
            </form>
        </div>
    </div>

    <section class="catalog" id="section-catalog">
        <div class="container">
            <div class="row justify-content-center" id="tampil">
                    <?php
                        if(isset($_GET['category'])){
                            if(isset($_POST['cari'])){
                                foreach($data_search as $row) {
                                    $imageURL = 'admin/produk/img/'.$row['photo'];   
                            
                        ?>
                                    <div class="card">
                                        <img src="<?php echo $imageURL ?>" class="card-img-top" alt="<?php echo $row['Nm_Barang'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['Nm_Barang'] ?></h5>
                                            <p class="card-text">Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                                            <!-- <a href="#" class="btn btn-warning mr-2"><i class="fa-regular fa-eye"></i></a> -->
                                        </div>
                                        <div class="card-footer">
                                            <!-- <in put type="number" class="custom-input" value="1" id="inputValue" name="jumlah" min="1" max="100" style="width: 18%; height: 33px;"> -->
                                            <a href="ViewProduk_prdct.php?ItemID= <?php echo $row['ItemID']?>" class="btn btn-warning viewproduk"><i class="fa-regular fa-eye"></i></a>
                                            <a href="addToCart.php?id=<?php echo $row['ItemID'] ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
    
                        <?php }
                            } else {

                        
                                foreach($items as $row){
                                    $imageURL = 'admin/produk/img/'.$row['photo'];

                        ?>
                                    <div class="card">
                                        <img src="<?php echo $imageURL ?>" class="card-img-top" alt="<?php echo $row['Nm_Barang'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['Nm_Barang'] ?></h5>
                                            <p class="card-text">Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                                            <!-- <a href="#" class="btn btn-warning mr-2"><i class="fa-regular fa-eye"></i></a> -->
                                        </div>
                                        <div class="card-footer">
                                            <!-- <input type="number" class="custom-input" value="1" id="inputValue" name="jumlah" min="1" max="100" style="width: 18%; height: 33px;"> -->
                                            <a href="ViewProduk_prdct.php?ItemID= <?php echo $row['ItemID']?>" class="btn btn-warning viewproduk"><i class="fa-regular fa-eye"></i></a>
                                            <a href="addToCart.php?id=<?php echo $row['ItemID'] ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                                        </div>
                                    </div>
                            <?php }
                            }
                            ?>
                    <?php    
                        }
                        
                    else{
                        if(isset($_POST['cari'])) {
                            foreach($data_search as $row) {
                                $imageURL = 'admin/produk/img/'.$row['photo'];
                        
                        ?>
                                <div class="card">
                                    <img src="<?php echo $imageURL ?>" class="card-img-top" alt="<?php echo $row['Nm_Barang'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['Nm_Barang'] ?></h5>
                                        <p class="card-text">Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                                        <!-- <a href="#" class="btn btn-warning mr-2"><i class="fa-regular fa-eye"></i></a> -->
                                    </div>
                                    <div class="card-footer">
                                        <!-- <input type="number" class="custom-input" value="1" id="inputValue" name="jumlah" min="1" max="100" style="width: 18%; height: 33px;"> -->
                                        <a href="ViewProduk_prdct.php?ItemID= <?php echo $row['ItemID']?>" class="btn btn-warning viewproduk"><i class="fa-regular fa-eye"></i></a>
                                        <a href="addToCart.php?id=<?php echo $row['ItemID'] ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>

                        <?php }
                        } else {
                            foreach($data_produk[1] as $row){
                                $imageURL = 'admin/produk/img/'.$row['photo'];
                        ?>
                    
                                <div class="card">
                                    <img src="<?php echo $imageURL ?>" class="card-img-top" alt="<?php echo $row['Nm_Barang'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['Nm_Barang'] ?></h5>
                                        <p class="card-text">Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                                        <!-- <a href="#" class="btn btn-warning mr-2"><i class="fa-regular fa-eye"></i></a> -->
                                    </div>
                                    <div class="card-footer">
                                        <!-- <input type="number" class="custom-input" value="1" id="inputValue" name="jumlah" min="1" max="100" style="width: 18%; height: 33px;"> -->
                                        <a href="ViewProduk_prdct.php?ItemID= <?php echo $row['ItemID']?>" class="btn btn-warning viewproduk"><i class="fa-regular fa-eye"></i></a>
                                        <a href="addToCart.php?id=<?php echo $row['ItemID'] ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                                    </div>
                                </div>
                        <?php   }
                        }
                    }?>

                    
                    
                    
            
            </div>
        </div>
    </section>











    

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        $(document).ready(function() {
            $("#Search").keyup(function(){
                $.ajax({
                    type: 'POST',
                    url : 'search.php',
                    data : {
                        search : $(this).val()
                    },
                    cache : false,
                    success : function(data) {
                        $("#tampil").html(data);
                    }
                });
            });
        });
    </script>


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</body>
</html>