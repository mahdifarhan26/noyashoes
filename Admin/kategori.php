<h2 class="text-center">Data Kategori </h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM kategori"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_kategori']; ?></td>
			<td>
				<a href="index.php?halaman=ubah_kategori&id=<?php echo $pecah['id_kategori'];?>" class="btn btn-warning">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	    <?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambah_kategori" class="btn btn-primary">Tambah Kategori</a>