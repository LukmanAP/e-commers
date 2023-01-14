<?php 
	session_start();
	include 'koneksi.php';

	//jika tidak ada session pelanggan (belum login)
	if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
		echo "<script>alert('Silahkan login terlebih dahulu');</script>";
		echo "<script>location='login.php';</script>";
		exit();
	}

	//mendapatkan id pembelian dari url
	$idpem = $_GET["id"];
	$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
	$detpem = $ambil->fetch_assoc();

	//mendapatkan id pelanggan yang beli
	$id_pelanggan_beli = $detpem["id_pelanggan"];
	//mendapatkan id pelanggan yang login
	$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

	if ($id_pelanggan_login !== $id_pelanggan_beli) {
		echo "<script>alert('jangan melihat pembayaran orang lain');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim Bukti pembayaran anda disini</p>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" name="nama" class="form-control">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" name="bank" class="form-control">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" name="jumlaj" class="form-control" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" name="bukti" class="form-control">
				<p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
			</div>
			<button class="btn-primary btn" name="kirim">Kirim</button>
		</form>
	</div>

</body>	
</html>