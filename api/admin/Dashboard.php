<?php
    include "../config/LoginConfig.php";
    $lib = new Login();
    $data = $lib -> countingRow();

    session_start();
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['memberid'];
    }




?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Admin - Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="#">SELAMAT DATANG ADMIN | Solaris - Shopping</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <form class="form-inline my-2 my-lg-0 ml-auto">

        </form>

        <div class="icon ml-4">
            <h5>
            <a href="../logout.php" style="font-size: 25px;"><i class="bi bi-box-arrow-right mr-3" data-toggle="tooltip" title="Sign Out"></i></a>
            </h5>
        </div>
    </nav>

    <div class="row no-gutters mt-5">
        <div class="col-md-2 bg-dark mt-2 pr-3">
            <div class="bglink">
                <ul class="nav flex-column ml-3">
                <li class="nav-item">
                    <!-- <img src="img/profil1.jpg" class="d-inline-block align-bottom rounded-circle mr-1 ml-3  " alt=""> -->
                    <i class="bi bi-person-fill d-inline-block align-bottom rounded-circle mr-1 ml-3 " style="font-size: 24px; color: white;"></i>
                    <a class="navbar-brand" href="dashboard.php"><?php echo $nama ?></a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php"><i class="bi bi-speedometer2 pr-2 pl-1" style="font-size: 30px;"></i>Dasboard</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Member/MemberDisplay.php"><i class="fas fa-user-graduate pr-2 pl-1" style="font-size: 27px;"></i> Daftar Member</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="produk/ProdukDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Produk</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kategori/KategoriDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Kategori</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="orderdetails/DetailsDisplay.php"><i class="fas fa-calendar-alt pr-3" style="font-size: 27px;"></i> Order Details</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="order/OrderDisplay.php"><i class="fas fa-paper-plane pr-3" style="font-size: 27px;"></i> Daftar Order</a><hr class="bg-secondary">
                </li>
                </ul>
            </div>
        </div>

    
        <div class="col-md-10 p-5 pt-2">
            <h3 id="Home">Dasboard</h3><hr>

            <div class="row text-white justify-content-center">

                <div class="card bg-info ml-3 mr-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-people mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH MEMBER</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[0] ?></div>
                        <a href="Member/MemberDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

                <div class="card bg-danger ml-5 mr-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-person-lines-fill mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH ADMIN</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[1] ?></div>
                        <a href="Member/MemberDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

                <div class="card bg-success mr-4 ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-box-seam mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH PRODUK</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[2] ?></div>
                        <a href="produk/ProdukDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

            </div>
            
            <div class="row text-white justify-content-center mt-5 mr-5">
                
                <div class="card bg-warning ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-tags mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH KATEGORI</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[3] ?></div>
                        <a href="kategori/KategoriDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>
                
                <div class="card bg-primary ml-5" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body-icon">
                        <i class="bi bi-cart mr-2"></i>
                        </div>
                        <h5 class="card-title">JUMLAH ORDER</h5>
                        <div class="display-4 font-weight-bold"><?php echo $data[4] ?></div>
                        <a href="order/OrderDisplay.php"><p class="card-text text-white">Lihat Detail <i class="bi bi-chevron-double-right ml-1"></i></p></a>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center gmaps mt-5" style="width: 70%; margin: 0 auto;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.6890359139206!2d112.7278014663343!3d-7.311354774284881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd1cb925a1d%3A0x1dbecb0b2e9b059f!2sInstitut%20Teknologi%20Telkom%20Surabaya!5e0!3m2!1sid!2sid!4v1675212852356!5m2!1sid!2sid" width="1920" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>














    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>
</html>

