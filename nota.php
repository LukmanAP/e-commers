<?php 
session_start();
include 'koneksi.php';
 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Nota Pembelian</title>
 	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
 </head>
 <body>
 	<!-- NAVBAR -->
	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container">
			
			<h2>Halaman Detail</h2>

			<?php 
				$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'");
				$detail = $ambil->fetch_assoc(); 
			 ?>

			 <h1>data orang yang beli $detail</h1>
			 <pre><?php print_r($detail); ?></pre>

			 <h1>data orang yang logindi session</h1>
			 <pre><?php print_r($_SESSION); ?></pre>

			 <!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayt.php karena tidak berhak melihat nota dari orng lain -->
			 <!-- pelanggan yang beli harus pelanggan yang login -->
			 <?php 
			 //mendapatkan id_pelanggan yang beli
			 $idpelangganyangbeli = $detail["id_pelanggan"];

			 //mendapatkan id pelanggan yang login
			 $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

			 if ($idpelangganyangbeli!==$idpelangganyanglogin) {
			 	echo "<script>alert('jangan masuk ke riwayat orang lain');</script>";
			 	echo "<script>location='riwayat.php';</script>";
			 }

			  ?>

			 <div class="row">
			 	<div class="col-md-4">
			 		<h3>Pembelian</h3>
			 		<strong>No. Pembelian : <?php echo $detail['id_pembelian'] ?></strong>
			 		Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
			 		Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
			 	</div>
			 	<div class="col-md-4">
			 		<h3>Pelanggan</h3>
			 		<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
			 		<p>
			 			<?php echo $detail['telepon_pelanggan']; ?> <br>
			 			<?php echo $detail['email_pelanggan']; ?>
			 		</p>
			 	</div>
			 	<div class="col-md-4">
			 		<h3>Pengiriman</h3>
			 		<strong><?php echo $detail['nama_kota'] ?></strong><br>
			 		Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?> <br>
			 		Alamat : <?php echo $detail['alamat_pengiriman']; ?>
			 	</div>
			 </div>

			 <table class="table table-bordered">
			 	<thead>
			 		<tr>
			 			<th>no</th>
			 			<th>nama produk</th>
			 			<th>harga</th>
			 			<th>berat</th>
			 			<th>jumlah</th>
			 			<th>subberat</th>
			 			<th>subtotal</th>
			 		</tr>
			 	</thead>
			 	<tbody>
			 		<?php $nomor=1 ?>
			 		<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'" );?>
			 		<?php while($pecah=$ambil->fetch_assoc()) { ?>
			 			<tr>
			 				<td><?php echo $nomor; ?></td>
			 				<td><?php echo $pecah['nama']; ?></td>
			 				<td>Rp.<?php echo number_format($pecah['harga']); ?></td>
			 				<td><?php echo $pecah['berat']; ?></td>
			 				<td><?php echo $pecah['jumlah']; ?></td>
			 				<td><?php echo $pecah['subberat']; ?></td>
			 				<td>Rp.<?php echo number_format($pecah['subharga']); ?></td>
			 			</tr>
			 		<?php $nomor++; ?>
			 		<?php } ?>
			 	</tbody>
			 </table>

			 <div class="row">
			 	<div class="col-md-7">
			 		<div class="alert-info alert">
			 			<p>
			 				silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
			 				<strong>BANK MANDIRI 123-00450063-1234 AN. Lukman Agung P.</strong>
			 			</p>
			 		</div>
			 	</div>
			 </div>

		</div>
	</section>
 
 </body>
 </html>