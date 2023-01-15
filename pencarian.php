<?php 
	include 'koneksi.php';
	$keyword = $_GET["keyword"];

	$semuadata=array();
	$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
	while($pecah = $ambil->fetch_assoc()) {
		$semuadata[]=$pecah;
	}

	//echo $keyword;

	// echo "<pre>";
	// print_r($semuadata);
	// echo "</pre>";
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pencarian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php'; ?>
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>

		<?php if (empty($semuadata)): ?>
			<div class="alert-danger alert">Produk <strong><?php echo $keyword ?></strong>Tidak Ditemukan</div>
		<?php endif ?>

		<div class="row">
			<?php foreach ($semuadata as $key => $value): ?>
				<div class="col-md-3">
					<div class="thumbnail" height="300">
						<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive" width="200" height="200">
						<div class="caption">
							<h3><?php echo $value["nama_produk"] ?></h3>
							<h5>Rp. <?php echo number_format($value["harga_produk"]); ?></h5>
							<a class="btn-primary btn" href="beli.php?id=<?php echo $value["id_produk"]; ?>">Beli</a>
							<a class="btn-dafault btn" href="detail.php?id=<?php echo $value["id_produk"]; ?>">Detail</a>
						</div>
					</div>
				</div>			
			<?php endforeach ?>
		</div>
	</div>

</body>
</html>