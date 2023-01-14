<?php 
	session_start();
	$koneksi = new mysqli("localhost:3308","root","1234","toko_online");

	//jik tidak ada session pelanggan yang login maka dilarikan ke login
	if (!isset($_SESSION["pelanggan"])) {
		echo "<script> alert('silahkan login'); </script>";
		echo "<script>location='login.php'; </script>";
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>halaman checkout</title>
 	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
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

<section class="konten">
        <div class="container">
            <h1>Halaman Checkout</h1>
            <hr>
            <table class="table-bordered table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <!-- menampilkan produk yang sedang di perulangkan bedasarkan id_produk -->
                    <?php 
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah["harga_produk"]*$jumlah;

                        // echo "<pre>";
                        // print_r($pecah);
                        // echo "</pre>";
                     ?>
                    <tr>
                        <td><?php echo $nomor ?></td>
                        <td><?php echo $pecah["nama_produk"]; ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="" class="form-control" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
                        </div>   
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="" class="form-control" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value=""> Pilih Ongkos kirim</option>
                        <?php 
                            $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while ($perongkir = $ambil->fetch_assoc()) { ?>
                                <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                    <?php echo $perongkir['nama_kota']; ?> -
                                    Rp. <?php  echo number_format($perongkir['tarif']);?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button class="btn-primary btn" name="checkout">Checkout</button>
            </form>

            <?php 
                if (isset($_POST["checkout"])) {
                    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                    $id_ongkir = $_POST['id_ongkir'];
                    $tanggal_pembelian = date('y-m-d');

                    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                    $arrayongkir = $ambil->fetch_assoc();
                    $tarif = $arrayongkir['tarif'];

                    $total_pembelian = $totalbelanja + $tarif;

                    //menyimpan data ketabel pembelian

                    $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");

                    //mendapatkan id_pembelian yang baru terjadi
                    $id_pembelian_barusan = $koneksi->insert_id;

                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah) VALUES ('$id_pembelian_barusan','$id_produk', '$jumlah' )");
                    }

                    //menglosongkan keranjang
                    unset($_SESSION['keranjang']);

                    //tampilan di alihkan ke halaman nota, nota dari pembelian yang barusan
                    echo "<script> alert('pemebelian sukses'); </script>";
                    echo "<script> location='nota.php?id=$id_pembelian_barusan'; </script>";
                }
             ?>
        </div>
    </section>
 
    <pre><?php print_r($_SESSION['pelanggan']) ?></pre>
    <pre><?php print_r($_SESSION['keranjang']) ?></pre>
 
 </body>
 </html>