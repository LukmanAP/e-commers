<?php 
	include '../koneksi.php';
	$datakategori = array();

	$ambil = $koneksi->query("SELECT * FROM kategori");
	while($tiap = $ambil->fetch_assoc()) {
		$datakategori[] = $tiap;
	}

	echo "<pre>";
	print_r($datakategori);
	echo "</pre>";
 ?>


<h2>Tambah produk </h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option>Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value):?>
				<option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
			<?php endforeach ?>

		</select>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" name="berat" class="form-control">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="save"><i class="glyphicon-saved">Simpan</i></button>
</form>

<?php 
	if (isset($_POST['save'])) {
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto_produk/".$nama);
		$koneksi->query("INSERT INTO produk (nama_produk, harga_produk, berat_produk, foto_produk,deskripsi_produk,stok_produk, id_kategori) 
			VALUES ('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]','$_POST[id_kategori]')");

		echo "<div class='alert alert-info'>Data Tersimpan</div>";
 		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
 ?>

