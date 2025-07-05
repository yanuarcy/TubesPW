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
    // $cartt = $_SESSION['keranjang'];
    // print_r($cartt);

    if(isset($_GET['OrderID'])){
        $id = $_GET['OrderID'];
    }
    
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['memberid'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>DetailDisplay</title>

    <style>
        /* The Modal (background) */
        .modal {
            display: block; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            /* margin-right: 2%; */
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
            height: 80%;
        }

        /* Modal Header */
        .modal-header {
            margin: auto;
            /* margin-top: %; */
        }

        /* Modal Body */
        .modal-body .input-form {
            display: flex;
            flex-direction: column;
            margin: 2%;
            width: 100%;
        }

        .input-form .nama {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }
        
        .input-form .gender {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .email {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .password {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .telp {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .alamat {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-form .file,img {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            /* padding: 2%; */
            margin-left: 3%;
        }

        .input-form .Button {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            background-color: #f13a11;
            color: white;
            text-transform: uppercase;
            outline: none;
            border: none;
            padding: 2%;
            margin: 3%;
            text-align: center;
            cursor: pointer;
        }

        .input-form .Button:hover {
            background-color: #171819;
            color: #f13a11;
        }

        .input-form .Button::selection {
            background-color: transparent;
        }

        .input-form .checkbox {
            margin-top: 5%;
            margin-bottom: -33px;
            margin-left: -38px;
            width: 100px;
            height: 20px;

        }

        .input-form .permission {
            font-size: 18px;
            margin-left: 30px;
            margin-top: 2%;
        }

        .input-form .permission a {
            color: #f13a11;
        }

        .input-form .permission a:hover {
            color: #171819;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            display: flex;
            justify-content: right;
            font-size: 28px;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Responsive Modal */
        @media screen and (max-width: 1500px) {
            .modal-content {
                width: 35%;
                height: 90%;
            }
        }

        @media screen and (max-width: 1200px) {
            .modal-content {
                width: 36%;
                height: 87%;
            }

            .modal-header .ModalTittle {
                font-size: var(--h3-font-size);
            }
        }

        @media screen and (max-width: 1000px) {
            .modal-content {
                width: 46%;
                height: 90%;
            }
        }

        @media screen and (max-width: 885px) {
            .modal-content {
                width: 50%;
                height: 88%;
            }
        }

        @media screen and (max-width: 815px) {
            .input-form .nama {
                font-size: var(--base-font-size);
            }
            .input-form .email {
                font-size: var(--base-font-size);
            }
            .input-form .telp {
                font-size: var(--base-font-size);
            }
            .input-form .message {
                font-size: var(--base-font-size);
            }
            .input-form .Button {
                font-size: var(--base-font-size);
            }
            .input-form .permission {
                font-size: var(--base-font-size);
            }

            .modal-content {
                width: 55%;
                height: 82%;
            }
        }

        @media screen and (max-width: 630px) {
            .modal-content {
                width: 62%;
                height: 80%;
                margin: 10% auto;
            }
        }

        @media screen and (max-width: 560px) {
            .modal-content {
                width: 65%;
                height: 75%;
            }

            .modal-header .ModalTittle {
                font-size: var(--h5-font-size);
            }

            .input-form .nama {
                font-size: var(--menu-font-size);
            }
            .input-form .email {
                font-size: var(--menu-font-size);
            }
            .input-form .telp {
                font-size: var(--menu-font-size);
            }
            .input-form .message {
                font-size: var(--menu-font-size);
            }
            .input-form .Button {
                font-size: var(--menu-font-size);
            }
            .input-form .permission {
                font-size: var(--menu-font-size);
            }
        }

        @media screen and (max-width: 500px) {
            .modal-content {
                margin: 18% auto;
                width: 75%;
                height: 78%;
            }
        }

        @media screen and (max-width: 425px) {
            .modal-header .ModalTittle {
                font-size: var(--h6-font-size);
            }

            .input-form .nama {
                font-size: 12px;
            }
            .input-form .email {
                font-size: 12px;
            }
            .input-form .telp {
                font-size: 12px;
            }
            .input-form .message {
                font-size: 12px;
            }
            .input-form .Button {
                font-size: 12px;
            }
            .input-form .permission {
                font-size: 12px;
            }

            .input-form .permission a {
                font-size: 12px;
            }

            .modal-content {
                height: 69%;
            }
        }

        @media screen and (max-width: 380px) {
            .modal-header .ModalTittle {
                font-size: var(--p-font-size);
            }

            .input-form .nama {
                font-size: 10px;
            }
            .input-form .email {
                font-size: 10px;
            }
            .input-form .telp {
                font-size: 10px;
            }
            .input-form .message {
                font-size: 10px;
            }
            .input-form .Button {
                font-size: 10px;
            }
            .input-form .permission {
                font-size: 10px;
                margin-top: 5%;
            }

            .input-form .permission a {
                font-size: 10px;
            }

            .input-form .checkbox {
                height: 15px;
            }

            .modal-content {
                height: 60%;
                margin: 34% auto;
            }
        }
        /* Akhir Responsive Modal */
    </style>

</head>
<body>
    <!-- The Modal -->
    <div id="AddModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <div class="modal-header">
                <h2 class="ModalTittle">Detail </h2>
                <h2 class="ModalTittle">Order</h2>
            </div>

            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" >
                    <thead class="thead bg-info">
                        <tr>
                        <th>NO</th>
                        <th>ORDER ID</th>
                        <th>ITEM ID</th>
                        <th>JUMLAH BARANG</th>
                        <th class="text-center">HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php     
                            $no = 1;
                            $Total = 0;
                            
                            // Membuat koneksi yang akan ditutup setelah digunakan
                            try {
                                $pdo = new PDO(
                                    'mysql:host=fm07c.h.filess.io;port=3307;dbname=solaris_pleasuremy;charset=utf8', 
                                    'solaris_pleasuremy', 
                                    '8c9eb5761d390d7147a2f9e4013c3680ac16fb69',
                                    [
                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                        PDO::ATTR_PERSISTENT => false
                                    ]
                                );
                                $query = "SELECT * FROM orderdetails WHERE orderid = :Orderid";
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(':Orderid', $id);
                                $stmt->execute();
                                $data = $stmt->fetchAll();
                                
                                foreach($data as $row){
                                    echo "<tr>";
                                    echo "<td style='width: 10%;'>".$no."</td>";
                                    echo "<td style='width: 10%;'>".$row['OrderID']."</td>";
                                    echo "<td style='width: 10%;'>".$row['ItemID']."</td>";
                                    echo "<td style='width: 10%;'>".$row['Jml_Barang']."</td>";
                                    echo "<td style='width: 20%;'>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>";
                                    echo "</tr>";
                                    $Total += $row['Total_Harga'];
                                    $no++;
                                }
                                
                                // Tutup koneksi setelah selesai
                                $pdo = null;
                                
                            } catch(PDOException $e) {
                                echo "Error: " . $e->getMessage();
                                $pdo = null;
                            }
                        ?>
                        <tr>
                            <td colspan="4" class="text-right"><b>Total Harga :</b></td>
                            <td colspan="5">Rp <?php echo number_format($Total,0,',','.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
            
            ?>

                
                
            </tbody>
            </table>
            
        </div>
        </div>


    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            window.location = "OrderDisplay.php";
        }
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>