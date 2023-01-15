<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>Kategori</th>
			<th>nama</th>
			<th>harga</th>
			<th>berat</th>
			<th>foto</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>

		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_kategori'] ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td><?php echo $pecah['harga_produk']; ?></td>
			<td><?php echo $pecah['berat_produk']; ?></td>
			<td>
				<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
			</td>
			<td>
				<a class="btn-danger btn" href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>">hapus</a>
				<a class="btn btn-warning" href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>

<a class="btn btn-primary" href="index.php?halaman=tambahproduk"> Tambah Produk</a>