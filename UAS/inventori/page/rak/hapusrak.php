 <?php
 
 $kode_supplier = $_GET['id'];
 $sql = $koneksi->query("delete from rak where id_rak = '$kode_supplier'");

 if ($sql) {
 
 ?>
 
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=rak";
	</script>
	
 <?php
 
 }
 
 ?>