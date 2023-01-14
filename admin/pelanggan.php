<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>nomor</th>
			<th>nama</th>
			<th>email</th>
			<th>telepon</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1 ?>
		<?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah=$ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['email_pelanggan']; ?></td>
			<td><?php echo $pecah['telepon_pelanggan'];?></td>
			<td>
				<a class="btn-danger btn" href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>">Hapus</a>
				<a class="btn btn-warning" href="index.php?halaman=ubahpelanggan&id=<?php echo $pecah['id_pelanggan']; ?>">ubah</a>
			</td>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>

</table>
<a class="btn btn-primary" href="index.php?halaman=tambahpelanggan"> Tambah Pelanggan</a>