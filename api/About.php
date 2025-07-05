<?php 
    include 'config/LoginConfig.php';
    // include 'addToCart.php';
    session_start();
    // session_destroy();
    // unset($_SESSION['logged_in']);
    // $inputValue = $_SESSION['inputValue'];
    

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/About.css">
    <link rel="stylesheet" href="../css/ResponsiveAbout.css">



    <title>Solaris - About</title>

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
                    <a class="nav-link" href="/">Home<span class="sr-only"></span></a>
                    <a class="nav-link page-scroll" id="NavAbout" href="">About</a>
                    <a class="nav-link smoothScroll" href="/product">Product</a>
                    
                    
                </div>
                
            </div>
        </nav>
    </div>
    <!-- akhir navbar -->

    <!-- About -->
    <section class="About" id="section-about">
        <div class="container">
            <div class="row contentAbout">
                <div class="col textabout">
                    <h4>Solaris is an online store website that sells various electronics.</h4>
                    <h4>Our passion towards computers makes us willing to introduce and provide the most advanced and recommeded products to our customers.</h4>
                    <h4>Besides selling Computer Component, our staff will also provide build guides for those who was new to build their PC. We will recommend and help you build your perfect PC according to your budget.</h4>
                    <h4>Solaris also continuously update prices from dozens of the most popular online retailers to help you to save your money.</h4>
                </div>
                <div class="col gambar">
                    <img src="img/SolarisAbout.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <!-- Akhir About -->

    

    <!-- Footer -->
    <footer class="footer" style="padding: 2%; background-color: rgb(17,17,17);">
        <div class="row wide-container" style="width: 100%;">
            <div class="col text-white">
                <h4 class="Judul">Solaris</h4>
                <p style="font-size: 18px;">Solaris is an online store website that sells various electronics. Solaris Your favorite online Electronic store.</p>
            </div>
            <div class="col support">
                <h5 class="Judul text-white">Customer Care</h5>
                <a href="/">Home</a>
                <br>
                <a href="/about">About Us</a>
                <br>
                <a href="/product">Our Product</a>
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
                <a class="facebook" href="">
                    <i class="fa fa-facebook fa-fw"></i> Facebook
                </a>
                <br>
                <br>
                <a class="instagram" href="">
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
    <!-- Akhir Footer -->

    











    

    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/f52d9e5e58.js" crossorigin="anonymous"></script>

</body>
</html>