<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php 
	//mrndapatkan id produk dari url
	$id_produk = $_GET["id"];

	//query ambil data
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
	$detail = $ambil->fetch_assoc();

	echo "<pre>";
	print_r($detail);
	echo "</pre>"

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>detail produk</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<!-- NAVBAR -->
	<?php include 'menu.php'; ?>

	<session class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive" alt="">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail["nama_produk"]; ?></h2>
					<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input class="form-control" type="number" min="1" name="jumlah">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>
					<?php 
						if (isset($_POST["beli"])) {
							//mendapatkan jumlah yang diinputkan
							$jumlah = $_POST['jumlah'];
							//masukan di kernajang belanja
							$_SESSION["keranjang"]["$id_produk"] = $jumlah;

							echo "<script>alert('produk telah masuk ke keranjang belaja');</script>";
							echo "<script>location='keranjang.php';</script>";
						}
					 ?>

					<p><?php echo $detail['deskripsi_produk']; ?></p>
				</div>
			</div>
		</div>
	</session>

</body>
</html>