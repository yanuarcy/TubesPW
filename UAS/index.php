<?php 
    include 'config/LoginConfig.php';
    include 'config/ProdukConfig.php';
    include 'config/MemberConfig.php';
    // include 'addToCart.php';
    session_start();
    // session_destroy();
    // unset($_SESSION['logged_in']);
    unset($_SESSION['ProdukPage']);
    // $inputValue = $_SESSION['inputValue'];
    
    $lib        = new ProdukConfig();
    $lib2       = new Login();
    $lib3       = new MemberConfig();

    $data_produk = $lib->show();
    
    if(isset($_SESSION['cart'])){
        $cartT = $_SESSION['cart'];
        // print_r(($cartT));
    }
    
    
    
    // $data_search = $lib2->ShowSearch($search);
    
    
    
    
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


    if (isset($_POST['Loginn'])) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $login = new Login();
        $login->checkCredentials($username, $password);

        

    }
    
    if(isset($_POST['Registerr'])){
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];
        $role = "User";
        $register = new MemberConfig();
        $register->createMember($name, $gender, $email, $password, $telp, $alamat, $role);
        if ($register) {
            header('Location: index.php');
        }
    }
    

    
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="refresh" content="2; URL=index.php"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/ResponsiveIndex.css">

    <!-- CSS Bootstrap -->
    <!-- <link href="css/bootstrap.css" rel="stylesheet"/> -->
    <!-- <link href="css/style.css" rel="stylesheet"/> -->

    <!-- CSS Lightbox -->
    <link href="css/lightbox.css" rel="stylesheet"/>

    <title>Komputer</title>

    <style>

    </style>

</head>
<body dat-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- The Modal -->
    <div id="LoginModal" class="modalL">

        <!-- Modal content -->
        <div class="modal-contentT">
            <span class="close">&times;</span>
            
            <div class="modal-headerR">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn"onclick="Register()">Register</button>
            </div>

            <div class="modal-bodyY">
                    <div class="form-box">
                        
                        <form id="login" class="input-group" method="post">
                            <input type="email" class="input-field" name="username" placeholder="Email" required>
                            <input type="password" class="input-field" name="password" placeholder="Password" required>
                            <div class="Btn">
                                <button type="submit" name="Loginn" class="submit-btn">Log in</button>
                            </div>
                        </form>

                        <form id="Register" class="input-group" method="post">
                            <input type="text" class="input-field" name="name" placeholder="Nama" required>
                            <input type="email" class="input-field" name="email" placeholder="Email" required>
                            <input type="password" class="input-field" name="password" placeholder="Password" style="margin-bottom: 5%;" required>
                            <div class="formGroup">
                                <label class="label1" for="Male">
                                    <input class="radio1" type="radio" name="gender" value="L" />Male
                                </label>
                                <label class="label2" for="Male">
                                    <input class="radio2" type="radio" name="gender" value="P" />Female
                                </label>
                            </div>
                            <input type="text" name="telp" class="input-field" placeholder="0812-3456-7890" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" required>
                            <textarea name="alamat" class="input-field" id="Alamat" placeholder="Alamat" cols="30" rows="5" required></textarea>
                            <div class="checkBox">
                                <input type="checkbox" name="checkbox" id="checkbox" required>
                                <span class="text">I agree with term & conditions</span>
                            </div>
                            <div class="Btn">
                                <button type="submit" name="Registerr" class="submit-btn">Register</button>
                            </div>
                        </form>
                    </div> 
            </div>
        </div>
    </div>

    

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
                    <a class="nav-link" id="NavHome" href="">Home<span class="sr-only"></span></a>
                    <a class="nav-link page-scroll" href="About.php">About</a>
                    <a class="nav-link smoothScroll" href="Produk.php">Product</a>
                    <a class="nav-link smoothScroll" href="#contact">Contact</a>
                    <!-- <div id="search">
                        <input type="text" id="input" placeholder="Search..">
                        <button id="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div> -->
                    
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
                <?php 
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<button onclick="Logout();" class="loginBtn">
                                Logout
                            </button>';
                    } else {
                        echo '<button id="LoginBtn" class="loginBtn">
                                Login
                            </button>';
                    }
                ?>
            </div>
        </nav>
    </div>
    <!-- akhir navbar -->

    <!-- Jumbotron -->
    <section class="home" id="section-home">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <div class="komponen">
                    <h1 style="margin-top: 5%;">
                        <?php 
                            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                if(isset($_SESSION['Nama'])){
                                    $Nama = $_SESSION['Nama'];
                                    echo "Welcome $Nama";
                                }
                            } else {
                                echo '';
                            }
                        ?>
                    </h1>
                    <h2 class="display-4">
                        <span>Find</span> and <span>Get</span> <br> What You Need
                    </h2>
                    <?php 
                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                            echo '<a href="" onclick="Sudalogin();" class="btn button">Get Started</a>';
                            echo '<a href="#section-catalog" class="btn button ml-5">Our Product</a>';
                        } else {
                            echo '<a href="#" id="LoginBtn2" class="btn button">Get Started</a>';
                            echo '<a href="#section-catalog" class="btn button ml-5">Our Product</a>';
                        }
                    ?>
                    <!-- <a href="login.php" class="btn button">Get Started</a> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Jumbotron -->

    <!-- Catalog -->
    <section class="catalog" id="section-catalog">
        <div class="container ">
            <h1 class="Judulcatalog text-center">Catalog Product</h1>
            <div class="row">
                <div class="container center">
                    <div id="carouselExampleIndicators" class="carousel slide" data-touch="true" data-interval="true" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <?php 
                                foreach($data_produk[1] as $row){
                                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>';
                                }  
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-interval="3000">
                                <img src="admin/produk/img/PC-3.png" class="d-block w-100" alt="...">
                            </div>
                            <?php 
                                foreach($data_produk[1] as $row) {
                                    $imageURLl = 'admin/produk/img/'.$row['photo'];
                                
                            ?>
                            <div class="carousel-item" data-interval="3000">
                                <img src="<?php echo $imageURLl ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                    //Menyertakan file konfigurasi database
                    foreach($data_produk[2] as $row) {
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
                        <a href="ViewProduk_index.php?ItemID= <?php echo $row['ItemID']?>" class="btn btn-warning viewproduk"><i class="fa-regular fa-eye"></i></a>
                        <a href="addToCart.php?id=<?php echo $row['ItemID'] ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                </div>
        
                <?php }
                ?>
        
            </div>
            
            
        </div>
    </section>


    <!-- CONTACT -->
    <section class="contact" id="contact">
            <div class="container">
                <div class="contactKonten">

                    <div class="inputForm">
                        <h2 data-aos="fade-up" data-aos-delay="200">Feel free to ask anything</h2>
                        <?php 
                            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                                if(isset($_SESSION['Nama'])){
                                    $nama = $_SESSION['Nama'];
                                    
                                }
                                if(isset($_SESSION['Email'])){
                                    $email = $_SESSION['Email'];
                                    
                                }


                            
                        ?>
                        <form onsubmit="sendEmail(); reset(); return false" class="contact-form webform" data-aos="fade-up" data-aos-delay="400" role="form">
                            <input type="text" class="form-control" id="nama" name="cf-name" value="<?php echo $nama?>" placeholder="<?php echo $nama?>">

                            <input type="email" class="form-control" id="email" name="cf-email" value="<?php echo $email?>" placeholder="<?php echo $email?>">

                            <textarea class="form-control" rows="5" id="message" name="cf-message" placeholder="Message"></textarea>

                            <button type="submit" class="form-control btnContact" id="submit-button" name="submit">Send Message</button>
                        </form>
                        <?php }else {

                        
                        ?>
                        <form onsubmit="sendEmail(); reset(); return false" class="contact-form webform" data-aos="fade-up" data-aos-delay="400" role="form">
                            <input type="text" class="form-control" id="nama" name="cf-name" placeholder="Name">

                            <input type="email" class="form-control" id="email" name="cf-email" placeholder="Email">

                            <textarea class="form-control" rows="5" id="message" name="cf-message" placeholder="Message"></textarea>

                            <button type="submit" class="form-control btnContact" id="submit-button" name="submit">Send Message</button>
                        </form>
                        <?php }
                        ?>
                        
                    </div>

                    <div class="Gmaps">
                        <h2 data-aos="fade-up" data-aos-delay="600">Where you can <span>find us</span></h2>

                        <p data-aos="fade-up" data-aos-delay="800"><i class="fa fa-map-marker mr-1"></i> Indonesia, Jawa Timur, Surabaya</p>
                        <div class="google-map" data-aos="fade-up" data-aos-delay="900">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.6890359139206!2d112.7278014663343!3d-7.311354774284881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd1cb925a1d%3A0x1dbecb0b2e9b059f!2sInstitut%20Teknologi%20Telkom%20Surabaya!5e0!3m2!1sid!2sid!4v1675212852356!5m2!1sid!2sid" width="1920" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    
                </div>
            </div>
    </section>

    <footer class="footer" style="padding: 2%; background-color: rgb(17,17,17);">
        <div class="row wide-container" style="width: 100%;">
            <div class="col text-white">
                <h4 class="Judul">Solaris</h4>
                <p style="font-size: 18px;">Solaris is an online store website that sells various electronics. Solaris Your favorite online Electronic store.</p>
            </div>
            <div class="col support">
                <h5 class="Judul text-white">Customer Care</h5>
                <a href="#section-home" class="smoothScroll">Home</a>
                <br>
                <a href="About.php">About Us</a>
                <br>
                <a href="Produk.php">Our Product</a>
            </div>
            <div class="col text-white">
                <h5 class="Judul">Find Us</h5>
                <p style="font-size: 18px;">
                    Monday to Sunday : <br> 10.00am to 8.00pm
                </p>
                <p style="font-size: 18px;">
                    Jl. Ketintang No.156, Ketintang, <br> Kec. Gayungan, Kota SBY, <br> Jawa Timur 60231
                </p>
            </div>
            <div class="Social col text-white">
                <h5 class="Judul">Social</h5>
                <a class="facebook" href="https://github.com/yanuarcy">
                    <i class="fa fa-github fa-fw"></i> Github
                </a>
                <br>
                <br>
                <a class="instagram" href="http://instagram.com/yanuarcy">
                    <i class="fa fa-instagram fa-fw"></i> Instagram
                </a>
            </div>
            <div class="col text-white">
                <h5 class="Judul">Our Partners</h5>
                <img src="img/OurPartners.png" />
            </div>
        </div>
        <div class="row text-white justify-content-center" >
            <h4>© 2023 Solaris - Electronic</h4>
        </div>

    </footer>










    <!-- Optional JavaScript; choose one of the two! -->




    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f52d9e5e58.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="js/index.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <!-- <script src="js/smoothscroll.js"></script> -->
    <button id="topBtn"><i class="fas fa-angle-double-up"></i></button>
    
    
    <!-- jQuery Lightbox -->
    <script src="js/lightbox-plus-jquery.min.js"></script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>
</html>