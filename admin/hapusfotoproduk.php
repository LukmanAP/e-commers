<?php 
	
	$id_foto = $_GET["idfoto"];
	$id_produk = $_GET["idproduk"];

	//ambil dulu datanya
	$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto'");
	$detailfoto = $ambilfoto->fetch_assoc();

	//hanya mengambil nama foto
	$namafilefoto = $detailfoto["nama_produk_foto"];

	// echo "<pre>";
	// print_r($detailfoto);
	// echo "</pre>";

	//hapus file foto dari folder
	unlink("../foto_produk/".$namafilefoto);

	//hapus file foto dari mysql
	$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto'");

	echo "<script>alert('foto produk berhasil di hapus');</script>";
	echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";

 ?>