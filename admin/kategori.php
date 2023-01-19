<h3>Data Kategori</h3>
<hr>

<?php  
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$semuadata[] = $tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>


<table class="table-bordered table">
	<thead>
		<tr>
			<th>No</th>
			<td>Kategori</td>
			<td>Aksi</td>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($semuadata as $key => $value): ?>

		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"] ?></td>
			<td>
				<a href="" class="btn btn-warning btn-sm">Ubah</a>
				<a href="" class="btn btn-danger btn-sm">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Tambah Kategori</label>
		<input type="text" name="kategori" class="form-control">
	</div>

	

	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php 
	if (isset($_POST['save'])) {
		$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$_POST[kategori]')");

		echo "<div class='alert alert-info'>Data Tersimpan</div>";
 		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
	}
 ?>

<!-- <a class="btn-default btn" href="index.php?halaman=tambahkategori">Tambah Data</a> -->
