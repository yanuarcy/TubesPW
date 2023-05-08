
<?php
if (isset($_POST['submit']))
{?>

 <?php



	$koneksi = new mysqli("localhost","yanuar","@boboho567","login");

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (".date('d-m-Y').").xls");
	
	$bln = $_POST['bln'] ;
	$thn = $_POST['thn'] ;

?>	

<body>
<center>
<h2>Laporan Barang Masuk Bulan <?php echo $bln;?> Tahun <?php echo $thn;?></h2>
</center>
<table border="1">
  <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Masuk</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
										
											<th>Pengirim</th>
											

											<th>Jumlah Masuk</th>
											<th>Satuan Barang</th>
											<th>Nama Rak</th>
											<th>Space Rak</th>
                                         
                                        </tr>
	

                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from barang_masuk select barang_masuk.*,rak.nama_rak from barang_masuk INNER JOIN rak ON barang_masuk.id_rak=rak.id_rak  where MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'");
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
											
											<td><?php echo $data['pengirim'] ?></td>

											<td><?php echo $data['jumlah'] ?></td>
										<td><?php echo $data['satuan'] ?></td>
										
										<td><?php echo $data['nama_rak'];?></td>
											<td><?php echo $rak['space_rak'] - $jumlah['jumlah']; ?></td>
								

                                        </tr>
									<?php }?>
					</table>	
					</body>
                                
	<?php 
	}
	?>
	
	<?php

	$koneksi = new mysqli("localhost","yanuar","@boboho567","login");
	

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
											<th>Tanggal Masuk</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Pengirim</th>
											<th>Jumlah Masuk</th>
											<th>Satuan Barang</th>
											<th>Nama Rak</th>
											<th>Space Rak</th>
                                         
                                        </tr>
                                    </thead>
		<tbody>
									
		
		<?php
		$no = 1;
		$sql = $koneksi->query("select barang_masuk.*,rak.nama_rak from barang_masuk INNER JOIN rak ON barang_masuk.id_rak=rak.id_rak where YEAR(tanggal) = '$thn'");
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
											
											<td><?php echo $data['pengirim'] ?></td>
									
                                         
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['satuan'] ?></td>

											<td><?php echo $data['nama_rak'];?></td>
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
											<th>Tanggal Masuk</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Pengirim</th>
											<th>Jumlah Masuk</th>
											<th>Satuan Barang</th>
											<th>Nama Rak</th>
											<th>Space Rak</th>
						
                                        </tr>
                                    </thead>
		<tbody>
									
		
		<?php
		$no = 1;
		$sql = $koneksi->query("select * from barang_masuk INNER JOIN rak ON barang_masuk.id_rak=rak.id_rak where MONTH(tanggal) = '$bln' and YEAR(tanggal) = '$thn'");
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
											
											<td><?php echo $data['pengirim'] ?></td>
									
                                         
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['satuan'] ?></td>
								
								
											<td><?php echo $data['nama_rak'];?></td>
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