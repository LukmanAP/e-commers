<?php 
	session_start();
	include 'koneksi.php';
 ?>


<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>Toko Online</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-default">
        <div class="container">
            <ul class=" nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <?php if(isset($_SESSION["pelanggan"])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <!-- <li><a href="daftar.php">Daftar</a></li> -->
                <?php endif ?>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
	</nav>

	<!-- conten -->
	<section class="konten">
		<div class="container">
			<h1>Produk Terbaru	</h1>

			<div class="row">
				<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
				<?php while($perproduk = $ambil->fetch_assoc()) { ?>

				<div class="col-md-3">
					<div class="thumbnail" height="300">
						<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" width="200" height="200">
						<div class="caption">
							<h3><?php echo $perproduk['nama_produk']; ?></h3>
							<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
							<a class="btn btn-primary" href="beli.php?id=<?php echo $perproduk['id_produk']; ?>">Beli</a>
							<a class="btn-default btn" href="detail.php?id=<?php echo $perproduk['id_produk']; ?>">Detail</a>
						</div>
					</div>
				</div>

				<?php } ?>

			</div>
		</div>
	</section>



</body>
</html>