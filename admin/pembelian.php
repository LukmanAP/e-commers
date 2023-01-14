<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomer=1; ?>
		<?php $ambil = $koneksi->query("SELECT * FROM Pembelian JOIN Pelanggan ON Pembelian.id_pelanggan = Pelanggan.id_pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomer ?> </td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo $pecah['total_pembelian']; ?></td>
			<td>
				<a class="btn-info btn" href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>">Detail</a>
			</td>
		</tr>
		<?php $nomer++ ?>
		<?php } ?>
	</tbody>

</table>