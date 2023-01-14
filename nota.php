<?php 
	$koneksi = new mysqli("localhost:3308","root","1234","toko_online");
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
 	<!-- NAVBAAR -->
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

	<section class="konten">
		<div class="container">
			
			<h2>Halaman Detail</h2>

			<?php 
				$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'");
				$detail = $ambil->fetch_assoc(); 
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