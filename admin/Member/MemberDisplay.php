<?php 
    include "../../config/MemberConfig.php";
    include "../../config/LoginConfig.php";
    $lib = new MemberConfig();
    $data_siswa = $lib->show();

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $status_hapus = $lib->delete($id);
        if($status_hapus){
            header('Location: MemberDisplay.php');
        }
    }

    session_start();
    if(isset($_SESSION['nama'])){
        $nama = $_SESSION['nama'];
        $memberID = $_SESSION['memberid'];
    }

    if(isset($_GET['Gender'])){
        $selectedGender = $_GET['Gender'];
        $gender = $lib->getItemsByCategory($selectedGender);
    }

    if(isset($_POST['cari'])) {
        $search = $_POST['keyword'];
        $data_search = $lib->ShowSearch($search);
    }

    if (isset($_POST['register'])) {
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];
        $role = "Admin";
        $addadmin = new MemberConfig();
        $addadmin->createMember($name, $gender, $email, $password, $telp, $alamat, $role);
        if ($addadmin) {
            header('Location: ../Member/MemberDisplay.php');
        }
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
    <link rel="stylesheet" href="css/AddAdmin.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Admin - MemberDisplay</title>

    <style>
        /* The Modal (background) */
        .modalL {
            display: none; /* Hidden by default */
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
        .modal-contentT {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 26%; /* Could be more or less, depending on screen size */
            height: 80%;
        }

        /* Modal Header */
        .modal-headerR {
            margin: auto;
            text-align: center;
            margin-bottom: 10%;
        }

        /* Modal Body */
        .modal-bodyY .input-formM {
            display: flex;
            flex-direction: column;
            margin: 2%;
            width: 100%;
        }

        .input-formM .nama {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }
        
        .input-formM .gender {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-formM .email {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-formM .password {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-formM .telp {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-formM .alamat {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            padding: 2%;
            margin: 3%;
        }

        .input-formM .file,img {
            font-size: 18px;
            font-family: 'Plain', sans-serif;
            /* padding: 2%; */
            margin-left: 3%;
        }

        .input-formM .Button {
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

        .input-formM .Button:hover {
            background-color: #171819;
            color: #f13a11;
        }

        .input-formM .Button::selection {
            background-color: transparent;
        }

        .input-formM .checkbox {
            margin-top: 5%;
            margin-bottom: -33px;
            margin-left: -38px;
            width: 100px;
            height: 20px;

        }

        .input-formM .permission {
            font-size: 18px;
            margin-left: 30px;
            margin-top: 2%;
        }

        .input-formM .permission a {
            color: #f13a11;
        }

        .input-formM .permission a:hover {
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
            .modal-contentT {
                width: 35%;
                height: 90%;
            }
        }

        @media screen and (max-width: 1200px) {
            .modal-contentT {
                width: 36%;
                height: 87%;
            }

            .modal-headerR .ModalTittle {
                font-size: var(--h3-font-size);
            }
        }

        @media screen and (max-width: 1000px) {
            .modal-contentT {
                width: 46%;
                height: 90%;
            }
        }

        @media screen and (max-width: 885px) {
            .modal-contentT {
                width: 50%;
                height: 88%;
            }
        }

        @media screen and (max-width: 815px) {
            .input-formM .nama {
                font-size: var(--base-font-size);
            }
            .input-formM .email {
                font-size: var(--base-font-size);
            }
            .input-formM .telp {
                font-size: var(--base-font-size);
            }
            .input-formM .message {
                font-size: var(--base-font-size);
            }
            .input-formM .Button {
                font-size: var(--base-font-size);
            }
            .input-formM .permission {
                font-size: var(--base-font-size);
            }

            .modal-contentT {
                width: 55%;
                height: 82%;
            }
        }

        @media screen and (max-width: 630px) {
            .modal-contentT {
                width: 62%;
                height: 80%;
                margin: 10% auto;
            }
        }

        @media screen and (max-width: 560px) {
            .modal-contentT {
                width: 65%;
                height: 75%;
            }

            .modal-headerR .ModalTittle {
                font-size: var(--h5-font-size);
            }

            .input-formM .nama {
                font-size: var(--menu-font-size);
            }
            .input-formM .email {
                font-size: var(--menu-font-size);
            }
            .input-formM .telp {
                font-size: var(--menu-font-size);
            }
            .input-formM .message {
                font-size: var(--menu-font-size);
            }
            .input-formM .Button {
                font-size: var(--menu-font-size);
            }
            .input-formM .permission {
                font-size: var(--menu-font-size);
            }
        }

        @media screen and (max-width: 500px) {
            .modal-contentT {
                margin: 18% auto;
                width: 75%;
                height: 78%;
            }
        }

        @media screen and (max-width: 425px) {
            .modal-headerR .ModalTittle {
                font-size: var(--h6-font-size);
            }

            .input-formM .nama {
                font-size: 12px;
            }
            .input-formM .email {
                font-size: 12px;
            }
            .input-formM .telp {
                font-size: 12px;
            }
            .input-formM .message {
                font-size: 12px;
            }
            .input-formM .Button {
                font-size: 12px;
            }
            .input-formM .permission {
                font-size: 12px;
            }

            .input-formM .permission a {
                font-size: 12px;
            }

            .modal-contentT {
                height: 69%;
            }
        }

        @media screen and (max-width: 380px) {
            .modal-headerR .ModalTittle {
                font-size: var(--p-font-size);
            }

            .input-formM .nama {
                font-size: 10px;
            }
            .input-formM .email {
                font-size: 10px;
            }
            .input-formM .telp {
                font-size: 10px;
            }
            .input-formM .message {
                font-size: 10px;
            }
            .input-formM .Button {
                font-size: 10px;
            }
            .input-formM .permission {
                font-size: 10px;
                margin-top: 5%;
            }

            .input-formM .permission a {
                font-size: 10px;
            }

            .input-formM .checkbox {
                height: 15px;
            }

            .modal-contentT {
                height: 60%;
                margin: 34% auto;
            }
        }
        /* Akhir Responsive Modal */

        

    </style>


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
                    <a class="nav-link" href="MemberDisplay.php"><i class="fas fa-user-graduate pr-2 pl-1" style="font-size: 27px;"></i> Daftar Member</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../produk/ProdukDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Produk</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../kategori/KategoriDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Kategori</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../orderdetails/DetailsDisplay.php"><i class="fas fa-calendar-alt pr-3" style="font-size: 27px;"></i>Order Details</a><hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="../order/OrderDisplay.php"><i class="fas fa-paper-plane pr-3" style="font-size: 27px;"></i> Daftar Order</a><hr class="bg-secondary">
                    </li>
                </ul>
                </div>
            </div>
            <div class="col-md-10 p-5 pt-2">
                <h3>DAFTAR MEMBER</h3><hr>
                <form action="" class="form-inline my-2 my-lg-0 ml-auto" method="post" id="search">
                    <input name="keyword" class="form-control" type="text" placeholder="Search" aria-label="Search" autocomplete="off">
                    <button name="cari" class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Search</button>
                </form>
                <form action="" class="GenderCtgry" method="GET" id="GenderSelect">
                    <select style="width: 10%; cursor: pointer;" name="Gender" onchange="document.getElementById('GenderSelect').submit()">
                        <option value="" selected disabled>Gender</option>
                        <option value="All">All</option>
                        <option value="P">P</option>
                        <option value="L">L</option>
                    </select>
                </form>

                <a href="#" id="AddBtn" class="btn btn-primary mb-2" style="float: right;"><i class="bi bi-plus-square"></i> Add Admin</a>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead bg-info">
                        <tr>
                        <th scope="col">NO</th>
                        <th scope="col">MEMBER ID</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">GENDER</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">PASSWORD</th>
                        <th scope="col">TELP</th>
                        <th scope="col">ALAMAT</th>
                        <th scope="col">ROLE</th>
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
                                echo "<td>".$row['MemberID']."</td>";
                                echo "<td>".$row['Nama']."</td>";
                                echo "<td>".$row['Gender']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Password']."</td>";
                                echo "<td>".$row['Telp']."</td>";
                                echo "<td>".$row['Alamat']."</td>";
                                echo "<td>".$row['Role']."</td>";
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdateMember.php?id=".$row['MemberID']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='MemberDisplay.php?delete=".$row['MemberID']."'><i class='bi bi-trash'></i></a></td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                        else if(isset($_GET['Gender'])) {
                            $no = 1;
                            foreach($gender as $row){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['MemberID']."</td>";
                                echo "<td>".$row['Nama']."</td>";
                                echo "<td>".$row['Gender']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Password']."</td>";
                                echo "<td>".$row['Telp']."</td>";
                                echo "<td>".$row['Alamat']."</td>";
                                echo "<td>".$row['Role']."</td>";
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdateMember.php?id=".$row['MemberID']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='MemberDisplay.php?delete=".$row['MemberID']."'><i class='bi bi-trash'></i></a></td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                        else{
                            $no = 1;
                            foreach($data_siswa as $row){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['MemberID']."</td>";
                                echo "<td>".$row['Nama']."</td>";
                                echo "<td>".$row['Gender']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Password']."</td>";
                                echo "<td>".$row['Telp']."</td>";
                                echo "<td>".$row['Alamat']."</td>";
                                echo "<td>".$row['Role']."</td>";
                                echo "<td class='text-center'><a class='btn btn-warning' href='UpdateMember.php?id=".$row['MemberID']."'><i class='bi bi-pencil-fill'></i></a>
                                <a class='btn btn-danger' href='MemberDisplay.php?delete=".$row['MemberID']."'><i class='bi bi-trash'></i></a></td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                    ?>
                        
                    <!-- <i class="bi bi-pencil-fill"></i> -->
                    </tbody>
                </table>

                <!-- The Modal -->
                <div id="AddModal" class="modalL">

                    <!-- Modal content -->
                    <div class="modal-contentT">
                        <span class="close">&times;</span>
                        
                        <div class="modal-headerR">
                            <h2 class="ModalTittle">Add</h2>
                            <h2 class="ModalTittle">New Admin</h2>
                        </div>

                        <div class="modal-bodyY">
                            <div class="container">
                                <div class="form">
                                    <!-- <div class="btn">
                                        <button class="signUpBtn">SIGN UP</button>
                                    </div> -->
                                    <form class="signUp" action="" method="post">
                                        <div class="formGroup">
                                            <input type="text" id="userName" name="name" placeholder="Nama" required>
                                        </div>
                                        <div class="formGroup">
                                            <input type="email" placeholder="Email" name="email" required>
                                        </div>
                                        <div class="formGroup">
                                            <input type="password" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="formGroup">
                                            <input class="radio1" type="radio" name="gender" value="L" />
                                            <label class="label1" for="Male">Male</label>    
                                            <input type="radio" name="gender" value="P" />
                                            <label class="label2" for="Male">Female</label>
                                        </div>
                                        <div class="formGroup" style="padding-top: 3%;">
                                            <input type="text" id="Telp" name="telp" placeholder="0812-3456-7890" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" required>
                                        </div>
                                        <div class="formGroup">
                                            <textarea name="alamat" id="Alamat" placeholder="Alamat" cols="30" rows="5" required></textarea>
                                        </div>
                                        <div class="checkBox">
                                            <input type="checkbox" name="checkbox" id="checkbox" required>
                                            <span class="text">I agree with term & conditions</span>
                                        </div>
                                        <div class="formGroup">
                                            <button type="submit" name="register" class="btn2">REGISTER</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        













    <!-- Optional JavaScript; choose one of the two! -->

    <script>
        // ======================================================
        // About Modal Box
        // Get the modal
        var modal = document.getElementById("AddModal");

        // // Get the button that opens the modal
        var btn = document.getElementById("AddBtn");

        // // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
    </script>



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