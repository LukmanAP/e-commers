<?php 
	session_start();
	include 'koneksi.php';

	//jika tidak ada session pelanggan (belum login)
	if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
		echo "<script>alert('Silahkan login terlebih dahulu');</script>";
		echo "<script>location='login.php';</script>";
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Riwayat</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<pre><?php print_r($_SESSION); ?></pre>

	<section class="Riwayat">
		<div class="container">
			<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

			<table class="table-bordered table">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Total</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$nomor = 1;
						//mendapatkan id pelanggan yang login dari session
					$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
					while($pecah= $ambil->fetch_assoc()) {
					 ?>
					
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
						<td>
							<?php echo  $pecah["status_pembelian"]; ?>
							<br>
							<?php if (!empty($pecah['resi_pengiriman'])):?>
								Resi : <?php echo $pecah['resi_pengiriman']; ?>
							<?php endif ?>
						</td>
						<td><?php echo number_format($pecah["total_pembelian"]); ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn-info btn">Nota</a>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn-success btn">Pembayaran</a>
						</td>
					</tr>
					<?php $nomor++; ?>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</section>



</body>
</html>