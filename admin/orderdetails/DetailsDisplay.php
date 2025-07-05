<?php 
    include "../../config/CartConfig.php";
    include "../../config/LoginConfig.php";
    $lib = new CartConfig();
    $data_details = $lib->show();

    // if(isset($_GET['delete'])){
    //     $id = $_GET['delete'];
    //     $status_hapus = $lib->delete($id);
    //     if($status_hapus){
    //         header('Location: KategoriDisplay.php');
    //     }
    // }

    // session_start();
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
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <title>Daftar OrderDetails</title>

    <style>
        .Button {
            background-color: #0081B4;
            outline: none;
            border: none;
            margin: 1%;
            padding: 8px;
            border-radius: 10px;
            color: white;
        }

        .Button:hover {
            background-color: orange;
        }

        #start_date {
            padding: 5px;
            border-radius: 15px;
            border: none;
            background-color: rgb(199, 155, 74);
            color: white;
            cursor: pointer;
        }

        #end_date {
            padding: 5px;
            border-radius: 15px;
            border: none;
            background-color: rgb(199, 155, 74);
            color: white;
            cursor: pointer;
        }

        .Dateinput input:focus {
            outline: none !important;
            border-bottom: 2px solid rgb(91, 243, 131);
            font-size: 17px;
            font-weight: bold;
            color: black;
        }

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
                <a class="nav-link" href="../Member/MemberDisplay.php"><i class="fas fa-user-graduate pr-2 pl-1" style="font-size: 27px;"></i> Daftar Member</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../produk/ProdukDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Produk</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../kategori/KategoriDisplay.php"><i class="fas fa-user-edit pr-2" style="font-size: 27px;"></i> Daftar Kategori</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="DetailsDisplay.php"><i class="fas fa-calendar-alt pr-3" style="font-size: 27px;"></i> Order Details</a><hr class="bg-secondary">
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="../order/OrderDisplay.php"><i class="fas fa-paper-plane pr-3" style="font-size: 27px;"></i> Daftar Order</a><hr class="bg-secondary">
                </li>
            </ul>
            </div>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3>DAFTAR ORDER DETAILS</h3><hr>
            <?php 
                if(isset($_POST['kirim'])){
                    $start_date = $_POST["start_date"];
                    $end_date = $_POST["end_date"];
                
            ?>
            <h3>Data Periode <?php echo $start_date ?> s/d <?php echo $end_date ?></h3>
            <?php }else {
            ?>
            <h3>Data Periode s/d </h3>
            <?php }
            ?>

            <form action="DetailsDisplay.php" class="Dateinput" method="post">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date">

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date">

                <input class="Button" name="kirim" type="submit" value="Tampilkan" readonly>
            </form>

            <div class="data-tables datatable-dark">
                <table class="table table-striped table-bordered table-hover" id="ExportPDF">
                    <thead class="thead bg-info">
                        <tr class="text-center">
                        <th scope="col">NO</th>
                        <th scope="col">TGL ORDER</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">NAMA BARANG</th>
                        <th scope="col">JUMLAH BARANG</th>
                        <th scope="col">TOTAL HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php    
                        $no = 1;
                        if(isset($_POST['kirim'])) {
                            $start_date = $_POST["start_date"];
                            $end_date = $_POST["end_date"];
                            $data_Date = $lib->ShowWithDate($start_date, $end_date);
                            foreach($data_Date as $row){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['Tgl_Order']."</td>";
                                echo "<td style='width: 16%;'>".$row['Nama']."</td>";
                                echo "<td style='width: 40%;'>".$row['Nm_Barang']."</td>";
                                echo "<td style='width: 10%;'>".$row['Jml_Barang']."</td>";
                                echo "<td>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                        else {
                            foreach($data_details[1] as $row){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$row['Tgl_Order']."</td>";
                                echo "<td style='width: 16%;'>".$row['Nama']."</td>";
                                echo "<td style='width: 40%;'>".$row['Nm_Barang']."</td>";
                                echo "<td style='width: 10%;'>".$row['Jml_Barang']."</td>";
                                echo "<td>Rp ".number_format($row['Total_Harga'], 0, ',', '.')."</td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                    ?>
                        
                        
                    </tbody>
                </table>
            </div>
            
        </div>
        </div>

        













    <!-- Optional JavaScript; choose one of the two! -->
    <script>
    $(document).ready(function() {
        $('#ExportPDF').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );
    } );
    </script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="../js/admin.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>
</html>