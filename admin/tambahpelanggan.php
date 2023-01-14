<h2>Tambah Pelanggan</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>email pelanggan</label>
		<input type="text" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>password pelanggan</label>
		<input type="text" name="password" class="form-control">
	</div>
	<div class="form-group">
		<label>nama pelanggan</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>telepon</label>
		<input type="text" name="telepon" class="form-control">
	</div>

	

	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php 
	if (isset($_POST['save'])) {
		$koneksi->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan) VALUES ('$_POST[email]','$_POST[password]','$_POST[nama]','$_POST[telepon]')");

		echo "<div class='alert alert-info'>Data Tersimpan</div>";
 		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
	}
 ?>