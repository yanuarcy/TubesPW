<?php 
    // include "../../config/KategoriConfig.php";
    include "../../config/LoginConfig.php";
    include "../../config/CartConfig.php";
    $lib = new CartConfig();
    $daftar_order = $lib->show();
    // $lib = new KategoriConfig();
    // $data_siswa = $lib->show();

    // if(isset($_GET['delete'])){
    //     $id = $_GET['delete'];
    //     $status_hapus = $lib->delete($id);
    //     if($status_hapus){
    //         header('Location: KategoriDisplay.php');
    //     }
    // }

    // session_start();
    $cartt = $_SESSION['keranjang'];
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['memberid'];
    }

    if(isset($_POST['cari'])) {
        $search = $_POST['keyword'];
        $data_search = $lib->ShowSearch($search);
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
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Admin - OrderDisplay</title>
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
                <a href="../../logout.php" style="font-size: 25px;"><i class="bi bi-box-arrow-right mr-3" data-toggle="tooltip" title="Sign Out"></i></a>
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
                <a class="navbar-brand" href="#"><?php echo $nama ?></a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../Dashboard.php"><i class="bi bi-speedometer2 pr-2 pl-1" style="font-size: 30px;"></i>Dasboard</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../Member/MemberDisplay.php"><i class="fas fa-user-graduate pr-2 pl-1" style="font-size: 27px;"></i> Daftar Member</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../produk/ProdukDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Produk</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../kategori/KategoriDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Kategori</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../orderdetails/DetailsDisplay.php"><i class="fas fa-calendar-alt pr-3" style="font-size: 27px;"></i> Order Details</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="OrderDisplay.php"><i class="fas fa-paper-plane pr-3" style="font-size: 27px;"></i> Daftar Order</a><hr class="bg-secondary">
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3>DAFTAR ORDER</h3><hr>
            <form action="" class="form-inline my-2 my-lg-0 ml-auto py-4" method="post" id="search">
                <input name="keyword" class="form-control" type="text" placeholder="Search" aria-label="Search">
                <button name="cari" class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Search</button>
            </form>

            <!-- <a href="AddKategori.php" class="btn btn-primary mb-2"><i class="fas fa-plus-square mr-2"></i>TAMBAH DATA</a> -->
            <table class="table table-striped table-bordered table-hover">
            <thead class="thead bg-info">
                <tr>
                <th scope="col">NO</th>
                <th scope="col">ORDER ID</th>
                <th scope="col">MEMBER ID</th>
                <th scope="col">TOTAL HARGA</th>
                <th scope="col">TGL ORDER</th>
                <th colspan="3" class="text-center" scope="col">AKSI</th>
                </tr>
            </thead>
            <tbody>
            <?php     
                if(isset($_POST['cari'])){
                    $no = 1;
                    foreach($data_search as $row){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['OrderID']."</td>";
                        echo "<td>".$row['MemberID']."</td>";
                        echo "<td>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>";
                        echo "<td>".$row['Tgl_Order']."</td>";
                        echo "<td class='text-center'><a class='btn btn-warning' href='DetailDisplay.php?OrderID=".$row['OrderID']."'>View</a></td>";
                        echo "</tr>";
                        $no++;
                    }
                }
                else{
                    $no = 1;
                    foreach($daftar_order[0] as $row){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['OrderID']."</td>";
                        echo "<td>".$row['MemberID']."</td>";
                        echo "<td>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>";
                        echo "<td>".$row['Tgl_Order']."</td>";
                        echo "<td class='text-center'><a class='btn btn-warning' href='DetailDisplay.php?OrderID=".$row['OrderID']."'>View</a></td>";
                        echo "</tr>";
                        $no++;
                    }
                }
            
            ?>
                
                
            </tbody>
            </table>
            
        </div>
        </div>

        













    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>
</html>