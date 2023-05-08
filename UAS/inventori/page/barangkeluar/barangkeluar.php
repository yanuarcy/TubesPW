




 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                                        <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Keluar</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Volume Barang</th>
											<th>Satuan</th>
											<th>Tujuan</th>
											<th>Rak</th>
											<th>Space Rak Tersisaa</th>
											<th>Pengaturan</th>
                                         
                                        </tr>
										</thead>
										
               
                  <tbody>
                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select barang_keluar.*,rak.nama_rak from barang_keluar INNER JOIN rak ON barang_keluar.id_rak=rak.id_rak");
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
											<td><?php echo $data['satuan'] ?></td>
											<td><?php echo $data['tujuan'] ?></td>
											<td><?php echo $data['nama_rak'] ?></td>
											<td><?php echo $rak['space_rak'] - $jumlah['jumlah']; ?></td>

											<td>
											
											<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangkeluar&aksi=hapusbarangkeluar&id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-danger" >Hapus</a>
											</td>
                                        </tr>
									<?php }?>

										   </tbody>
                                </table>
								<a href="?page=barangkeluar&aksi=tambahbarangkeluar" class="btn btn-primary" >Tambah</a>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>












