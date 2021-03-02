<h2 class="text-center">Data Pelanggan</h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama Pelanggan</th>
			<th>Telepon Pelanggan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php $koneksi = $ambil = $koneksi->query("SELECT * FROM user WHERE jenis='Pelanggan'"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_user']; ?></td>
			<td><?php echo $pecah['telepon_user']; ?></td>
			<td><a href="" class="btn btn-danger"> Hapus</a></td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>