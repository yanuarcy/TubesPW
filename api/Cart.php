<?php 
    include 'config/CartConfig.php';
    $lib = new CartConfig();
    // $data_keranjang = $lib->show();
    session_start();
    // session_destroy();
    // unset($_SESSION['ProdukPage']);

    // if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    //     // echo 'suda login';
    //     // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    //     if(isset($_SESSION['cart'])) {
    //         $keranjang = $_SESSION['cart'];
    //         // echo 'sudah ter set';
    //         // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    //     }
    // } else {
    //     // unset($_SESSION['cart']);
    // }
    // $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    // $_SESSION['keranjang'] = $cart;
    
    // $cart = [];

    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        // unset($_SESSION['cart']);
        $cart = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
        // print_r($cart);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/ResponsiveCart.css">


    <title>Keranjang</title>

    <style>
        body {
            height: 150vh;
            background-image: linear-gradient(to top, white, #C58940);
            
        }

        .Box {
            display: flex;
        }

        .form-box{
            width: 25%;
            height: 430px;
            position: relative;
            margin: 0 auto;
            background-color: white;
            padding: 5px;
            overflow: hidden;
            border-radius: 10px;
        }

        .form-box .header {
            text-align: center;
            margin: 3%;
        }

        .header h2 {
            color: black;
            font-weight: 800;
            font-family: monospace;
        }

        .form-box .body {
            margin: 5%;
        }

        .body h5 {
            padding: 2%;
        }

        .form-box .footer {
            margin: 5%;
            display: flex;
            justify-content: center;
        }

        .btnHome {
            /* margin-top: 10%; */
            margin: 5px;
            margin-left: 2%;
        }

        .BackHome {
            /* background-color: white; */
            width: 4%;
            border-radius: 20px;
            background-image: linear-gradient(to right, white, #678983, white);
            background-position: left;
            background-size: 150%;
            transition: background-position 1s;
            font-size: 20px;
            font-weight: 600;
            font-family: monospace;
            text-transform: uppercase;

        }

        .BackHome:hover {
            background-position: right;

        }

        .CheckoutBtn {
            margin-top: 10%;
            /* background-color: white; */
            width: 100%;
            border-radius: 20px;
            background-image: linear-gradient(to right, white, #678983, white);
            background-position: left;
            background-size: 150%;
            transition: background-position 1s;
            font-size: 20px;
            font-weight: 600;
            font-family: monospace;
            text-transform: uppercase;

        }

        .CheckoutBtn:hover {
            background-position: right;

        }



    </style>

</head>
<body>

    <div class="btnHome">
        <button type="button" class="btn BackHome my-3"><a href="index.php" style="text-decoration: none; color:black;"><i class="bi bi-house-fill"></i></a></button>
    </div>
    
    <div class="Box">
        <table class="table" style="width: 55%; margin-left: 10%;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0;
                    $GrandTotal = 0;
                    foreach($cart as $row) {
                        $pdo = new PDO('mysql:host=localhost;dbname=uas;charset=utf8', 'root', '');
                        $sql                = "SELECT * FROM produk WHERE itemid = :product_id";
                        $stmt                = $pdo->prepare($sql);
                        // $pdo->bind_param(':nm_barang', $row['id']);
                        $data['product_id'] = $row['id'];
                                            $stmt->execute($data);
                        $product            = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        $total = $product['Harga'] * $row['jumlah'];
                        $GrandTotal += $total;
    
                        $imageURL = 'admin/produk/img/'.$product['photo'];
                        $no++;
    
                ?>
    
                <tr>
                    <td><?php echo $no ?></td>
                    <td><img src="<?php echo $imageURL ?>" style="width: 100px; height: 100px;" alt=""><?php echo $product['Nm_Barang'] ?></td>
                    <td class="">Rp <?php echo number_format($product['Harga'], 0, ',', '.') ?></td>
                    <td class="text-center"><?php echo $row['jumlah'] ?></td>
                    <td class="text-center pl-5">Rp <?php echo number_format($total,0, ',', '.') ?></td>
                    <td class="text-center pl-5"><a href="HapusCart.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class='bi bi-trash'></i></a></td>
                </tr>
            </tbody>
    
            <?php }
            ?>
        </table>

        <div class="form-box">
            <div class="content">
                <div class="header">
                    <h2>Cart Details</h2>
                </div>
                <div class="body">
                    <?php 
                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            if(isset($_SESSION['Nama'])){
                                $Nama = $_SESSION['Nama'];
                                // echo "Welcome $Nama";
                            }
                            if(isset($_SESSION['MemberID'])){
                                $memberID = $_SESSION['MemberID'];
                            }
                        
                    ?>
                    <h5>Member ID : <?php echo $memberID ?></h5>
                    <h5>Nama Member : <?php echo $Nama ?></h5>
                    <h5>Total Items : <?php echo $no ?></h5>
                    <h5>Total Harga : Rp <?php echo number_format($GrandTotal,0,',','.') ?></h5>
                    <?php } else {
                    ?>
                    <h5>Member ID : Unknown</h5>
                    <h5>Nama Member : Unknown</h5>
                    <h5>Total Items : <?php echo $no ?></h5>
                    <h5>Total Harga : Rp <?php echo number_format($GrandTotal,0,',','.') ?></h5>
                    <?php }
                    ?>
                </div>
                <?php 
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        if(isset($_SESSION['keranjang'])){

                        
                ?>
                <div class="footer">
                    <button type="button" onclick="CheckOut();" class="btn CheckoutBtn">Checkout</button>
                </div>
                <?php }else {
                ?>
                <div class="footer">
                    <button type="button" onclick="InformCartEmpty();" class="btn CheckoutBtn">Checkout</button>
                </div>
                <?php }
                    
                } else {
                    if(!isset($_SESSION['cart'])){

                    
                    ?>
                <div class="footer">
                    <button type="button" onclick="InformCartEmpty();" class="btn CheckoutBtn">Checkout</button>
                </div>
                <?php }
                if(isset($_SESSION['cart'])) {
                ?>
                <div class="footer">
                    <button type="button" onclick="InformToLogin();" class="btn CheckoutBtn">Checkout</button>
                </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        function CheckOut(){
            window.location = "CartToDatabase.php";
            alert('Pesanan anda telah berhasil');
        }

        function StokEmpty(){
            alert('Stok barang telah habis');
        }

        function InformCartEmpty(){
            alert('Keranjang anda masih kosong, harap berlanja terlebih dahulu !');
            window.location = "Produk.php";
        }

        function InformToLogin(){
            alert('Anda Harus Login Terlebih Dahulu agar bisa memulai proses Checkout, Terimakasih !');
            window.location = "index.php";
        }
    </script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>
</html>