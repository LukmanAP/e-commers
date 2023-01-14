<?php 
	session_start();
	include 'koneksi.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login html</title>
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

	<!-- BODY -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel-default panel">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<button class="btn-primary btn" name="login">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
	//jika ada tombol simpan di klik
if (isset($_POST["login"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	//melakukan query ngecek akun tabel di data base
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	//Ngitung Akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	//jika 1 akun yang cocok, maka diloginkan
	if ($akunyangcocok==1) {
		//anda sukses login
		//mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session penlanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script> alert('anda sukses untuk login'); </script>";
		echo "<script> location='checkout.php'; </script>";
	} else {
		//anda Gagal Login
		echo "<script> alert('anda gagal login, coba periksa kembali akun anda'); </script>";
		echo "<script> location='login.php'; </script>";
	}
}
?>

</body>
</html>