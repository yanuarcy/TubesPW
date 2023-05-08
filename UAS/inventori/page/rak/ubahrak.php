

<?php
 $kode_supplier = $_GET['id_rak'];
 $sql2 = $koneksi->query("select * from rak where id_rak = '$kode_supplier'");
 $tampil = $sql2->fetch_assoc();
 

 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Rak</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">
<!-- 							
							<label for="">Kode Supplier</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="kode_supplier" value="<?php echo $tampil['kode_supplier']; ?>" class="form-control" />
	 
							</div>
                            </div> -->
							
							<label for="">Nama RAK</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama_rak" value="<?php echo $tampil['nama_rak']; ?>" class="form-control" />
	 
							</div>
                            </div>
<!-- 							
							<label for="">Alamat</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="alamat" value="<?php echo $tampil['alamat']; ?>" class="form-control" />
	 
							</div>
                            </div> -->
							
							<label for="">Space Rak</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="number" name="space_rak" value="<?php echo $tampil['space_rak']; ?>" class="form-control" />
	 
							</div>
                            </div>
							
						
							
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								
								$nama_rak= $_POST['nama_rak'];
								$space_rak= $_POST['space_rak'];
								
								
								$sql = $koneksi->query("update rak set nama_rak='$nama_rak', space_rak='$space_rak' where id_rak='$kode_supplier'"); 
								
								if ($sql) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=rak";
										</script>
										
										<?php
								}
							
								}
							
							
								
							?>
										
										
										
								
								
								
								
								
