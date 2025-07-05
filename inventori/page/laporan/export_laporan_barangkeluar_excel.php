
<?php
if (isset($_POST['submit']))
{?>

 <?php



	$koneksi = new mysqli("localhost","root","","inventori");

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Keluar (".date('d-m-Y').").xls");
	
	$bln = $_POST['bln'] ;
	$thn = $_POST['thn'] ;

?>	

<body>
<center>
<h2>Laporan Barang Keluar Bulan <?php echo $bln;?> Tahun <?php echo $thn;?></h2>
</center>
<table border="1">
  <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Keluar</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>			
											<th>Jumlah Keluar</th>
											<th>Tujuan</th>
											<th>Nama Rak</th>

                                        </tr>
	

                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from barang_keluar where MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'");
									while ($data = $sql->fetch_assoc()) {
										
									?>
									
                                  <tr>
                                            <td><?php echo $no++; ?></td>
											<td><?php echo $data['id_transaksi'] ?></td>
											<td><?php echo $data['tanggal'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['tujuan'] ?></td>

                                        </tr>
									<?php }?>
					</table>	
					</body>
                                
	<?php 
	}
	?>
	
	<?php

	$koneksi = new mysqli("localhost","root","","inventori");
	

	$bln = $_POST['bln'] ;
	$thn = $_POST['thn'] ;
	?>
	
	<?php
	if ($bln == 'all') {
		?>
	<div class="table-responsive">
							
                                <table  class="display table table-bordered" id="transaksi">
								
                                    <thead>
                                      <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Keluar</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>			
											<th>Jumlah Keluar</th>
											<th>Tujuan</th>
											<th>Nama Rak</th>
											<th>Space Rak</th>
                                        </tr>
                                    </thead>
		<tbody>
									
		
		<?php
		$no = 1;
		$sql = $koneksi->query("select * from barang_keluar  INNER JOIN rak ON barang_keluar.id_rak=rak.id_rak where YEAR(tanggal) = '$thn'");
		$sql2 = $koneksi->query("select * from gudang");
		$jumlah = $sql2->fetch_assoc();
		$sql3 = $koneksi->query("select * from rak");

		$rak = $sql3->fetch_assoc();
		while ($data = $sql->fetch_assoc()) {
									
		?>
	
						
				  <tr>
                                            <td><?php echo $no++; ?></td>
											<td><?php echo $data['id_transaksi'] ?></td>
											<td><?php echo $data['tanggal'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['tujuan'] ?></td>
											
											<td><?php echo $data['nama_rak'] ?></td>
											<td><?php echo $rak['space_rak'] - $jumlah['jumlah']; ?></td>

                                        </tr>
						<?php 
						}
						?>

					</tbody>
                    </table>
					</div>
					
					
					<?php
					}
					else{ ?>
						<div class="table-responsive">
							
                                <table  class="display table table-bordered" id="transaksi">
								
                                     <thead>
                                     <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Keluar</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>			
											<th>Jumlah Keluar</th>
											<th>Tujuan</th>
											<th>Nama Rak</th>
											<th>Space Rak</th>
                                        </tr>
                                    </thead>
		<tbody>
									
		
		<?php
		$no = 1;
		$sql = $koneksi->query("select * from barang_keluar  INNER JOIN rak ON barang_keluar.id_rak=rak.id_rak  where MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'");
		$sql2 = $koneksi->query("select * from gudang");
		$jumlah = $sql2->fetch_assoc();
		$sql3 = $koneksi->query("select * from rak");

		$rak = $sql3->fetch_assoc();
		while ($data = $sql->fetch_assoc()) {
									
		?>
	
					  <tr>
                                            <td><?php echo $no++; ?></td>
											<td><?php echo $data['id_transaksi'] ?></td>
											<td><?php echo $data['tanggal'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['tujuan'] ?></td>
											
											<td><?php echo $data['nama_rak'] ?></td>
											<td><?php echo $rak['space_rak'] - $jumlah['jumlah']; ?></td>

                                        </tr>
						<?php 
		}
		?>
    </tbody>
	</table>
</div>
	
	<?php

}

?>