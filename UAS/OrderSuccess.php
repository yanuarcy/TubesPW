<?php
    include "config/MemberConfig.php";
    $lib = new MemberConfig();
    $data_member = $lib->show();
    session_start();
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Order Success</title>

    <style>
        body {
            background-image: linear-gradient(to bottom,  white, #C58940);
        }

        h3 {
            padding: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content text-center" style="margin-top: 10%;">
            <img src="img/CartDoneBg.png" alt="">
            <h1 class="display-3 mb-5"><b>Order Sukses</b></h1>

            <?php 
                if(isset($_GET['MemberID'])){
                    $id = $_GET['MemberID']; 
                    $data_siswa = $lib->get_by_id($id);
                    $nama = $data_siswa['Nama'];
                    $email = $data_siswa['Email'];
                    $telp = $data_siswa['Telp'];
                    $alamat = $data_siswa['Alamat'];
                }
            
            ?>

            
            <h3 class="text-left">Nama &emsp;&emsp; : <?php echo $nama ?></h3>
            <h3 class="text-left">Email &emsp;&emsp;: <?php echo $email ?></h3>
            <h3 class="text-left">Telp &emsp;&emsp; &emsp;: <?php echo $telp ?></h3>
            <h3 class="text-left">Alamat &emsp;&emsp;: <?php echo $alamat ?></h3>
            <button type="button" class="btn btn-warning my-5"><a href="index.php" style="text-decoration: none; color:white; font-size: 20px;">Back To Home</a></button>
        </div>
    </div>
























    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    
</body>
</html>