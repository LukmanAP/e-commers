<?php 
	session_start();
	//mendapatkan id produk id dari url
	$id_produk = $_GET['id'];

	//jika sudah ada produk di keranjang maka produk akan di tambah 1
	if (isset($_SESSION['keranjang'][$id_produk])) {
		$_SESSION['keranjang'][$id_produk]+=1;
	}
	//jika tidak, maka produk akan di anggap 1
	else  {
		$_SESSION['keranjang'][$id_produk] = 1;
	}

	//echo "<pre>";
	//print_r($_SESSION); 
	//echo "</pre>";

	//larika ke halaman keranjang
	echo "<script> alert('produk telah masuk ke keranjang belanja'); </script>";
	echo "<script> location='keranjang.php'; </script>"

	
 ?>