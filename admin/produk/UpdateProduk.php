<?php
    include '../../config/ProdukConfig.php';
    include '../../config/KategoriConfig.php';
    include "../../config/LoginConfig.php";
    $lib = new ProdukConfig();
    $Kategorikolom = new KategoriConfig();
    $showKtgKolom = $Kategorikolom->ShowRow();
    $data_siswa = $lib->show();
    if(isset($_GET['ItemID'])){
        $id = $_GET['ItemID']; 
        $data_produk = $lib->get_by_id($id);
        $nm_barang = $data_produk['Nm_Barang'];
        $poto = $data_produk['photo'];
    }
    else{
        header('Location: ProdukDisplay.php');
    }

    session_start();
    if(isset($_SESSION['memberid'])){
        $memberID = $_SESSION['memberid'];
    }

    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
    }

    // if(isset($_SESSION['kategoriid'])){
    //     $KategoriID = $_SESSION['kategoriid'];
    // }
    
    $id = $_GET['ItemID'];
    if(isset($_POST['submit'])){
        // $id = $_POST['id'];
        $nm_barang = $_POST['nm_barang'];
        $kategori = $_POST['kategori'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $foto = $_POST["photo"];

        $targetDir = "img/";
        $fileName = basename($_FILES["photo"]['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf', 'svg');

        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                $status_update = $lib->update($id,$nm_barang, $kategori, $stok, $harga, $deskripsi, $memberID, $fileName);
                if($status_update)
                {
                    header('Location: ProdukDisplay.php');
                }
                
                /* Make sure that code below does not get executed when we redirect. */
                exit;
            }
        }
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
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>UpdateProduk</title>

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
            margin: 3% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 26%; /* Could be more or less, depending on screen size */
            height: 87%;
        }

        /* Modal Header */
        .modal-header {
            margin: auto;
            margin-top: -10%;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="#">SELAMAT DATANG ADMIN | Apel - Shopping</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
            <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <div class="icon ml-4">
            <h5>
                <a href="../../logout.php"><i class="bi bi-box-arrow-right mr-3" data-toggle="tooltip" title="Sign Out"></i></a>
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
                    <a class="nav-link active" href="ProdukDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Produk</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../kategori/KategoriDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Kategori</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../orderdetails/DetailsDisplay.php"><i class="fas fa-calendar-alt pr-3" style="font-size: 27px;"></i> Order Details</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../order/OrderDisplay.php"><i class="fas fa-paper-plane pr-3" style="font-size: 27px;"></i> Daftar Order</a><hr class="bg-secondary">
                    </li>
                </ul>
                </div>
            </div>
            <div class="col-md-10 p-5 pt-2">
                <h3>DAFTAR PRODUK</h3><hr>

                <a href="#" id="AddBtn" class="btn btn-primary mb-2"><i class="bi bi-plus-square"></i></a>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead bg-info">
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ITEM ID</th>
                        <th scope="col">KATEGORI ID</th>
                        <th scope="col">MEMBER ID</th>
                        <th scope="col">NAMA BARANG</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">STOK</th>
                        <th scope="col">DESKRIPSI</th>
                        <th scope="col">FOTO</th>
                        <th colspan="3" class="text-center" scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php    
                        $no = 1;
                        foreach($data_siswa[0] as $row){
                            $description = $row['Deskripsi'];
                            $short_description = wordwrap($description, 50, '<br>');
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$row['ItemID']."</td>";
                            echo "<td>".$row['KategoriID']."</td>";
                            echo "<td>".$row['MemberID']."</td>";
                            echo "<td>".$row['Nm_Barang']."</td>";
                            echo "<td>Rp ".number_format($row['Harga'], 0, ',', '.')."</td>";
                            echo "<td>".$row['Stok']."</td>";
                            echo "<td>".$short_description."</td>";
                            echo "<td>".$row['photo']."</td>";
                            echo "<td class='text-center'><a class='btn btn-warning' href='UpdateProduk.php?ItemID=".$row['ItemID']."'><i class='bi bi-pencil-fill'></i></a>
                            <a class='btn btn-danger mt-4' href='ProdukDisplay.php?delete=".$row['ItemID']."'><i class='bi bi-trash'></i></a></td>";
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                        
                    </tbody>
                </table>
                
                
            </div>
        </div>
    <!-- The Modal -->
    <div id="UpdateModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <div class="modal-header">
                <h2 class="ModalTittle">Update</h2>
                <h2 class="ModalTittle">Product</h2>
            </div>

            <div class="modal-body">
            <form class="input-form" method="POST" role="form" enctype="multipart/form-data">
                    <label for="itemID">ItemID : <?php echo $id ?> </label>
                    <input class="nama" id="nama" name="nm_barang" type="text" placeholder="<?php echo $nm_barang ?>" required>
                    <?php 
                        echo "<select name='kategori' id='kategori' class='gender'>";
                            echo "<option value='' disabled selected>Kategori Barang</option>";
                        foreach($showKtgKolom as $row){
                            echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
                        }
                        echo "</select>";
                    ?>
                    <!-- <input class="gender" id="gender" name="kategori" type="text" placeholder="Kategori Barang"> -->
                    <input class="email" id="email" name="stok" type="text" placeholder="Stok" required>
                    <input class="password" id="password" name="harga" type="text" placeholder="Harga" required>
                    <textarea class="alamat" name="deskripsi" id="alamat" cols="30" rows="3" placeholder="Deskripsi"></textarea>
                    <input class="file" id="file" type="file" name="photo" required>Before :<img src="img/<?php echo $poto ?>" height="150px" width="150px" alt="<?php echo $poto ?>">
                    <input class="Button" name="submit" type="submit" value="Kirim" readonly>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            window.location = "ProdukDisplay.php";
        }
        
        // window.onclick = function() {
        //     window.location = "ProdukDisplay.php";
        // }


    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>
</html>