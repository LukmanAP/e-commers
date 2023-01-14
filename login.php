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
	<?php include 'menu.php'; ?>

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

		//jika sudah belanja
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) {
			echo "<script>location='checkout.php';</script>";
		} else {
			echo "<script>location='riwayat.php';</script>";
		}
		
	} else {
		//anda Gagal Login
		echo "<script> alert('anda gagal login, coba periksa kembali akun anda'); </script>";
		echo "<script> location='login.php'; </script>";
	}
}
?>

</body>
</html>