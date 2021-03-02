<h2 class="text-center">Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN user 
	ON pembelian.id_user = user.id_user 
	WHERE pembelian.id_pembelian = '$_GET[id]' ");
$detail = $ambil->fetch_assoc();
?>

<!--<pre><?php //print_r($detail); ?></pre>-->


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
			Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
			Status : <?php echo $detail["status_pembelian"]; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong>Nama Pelanggan : <?php echo $detail['nama_user']; ?></strong> <p>
		<p>
			Telepon : <?php echo $detail['telepon_user']; ?> <br>
			Email &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $detail['email_user']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong>Kota/Kab: <?php echo $detail["nama_kota"]; ?></strong><br>
		<p>
			Tarif : Rp. <?php echo number_format($detail["tarif"]); ?><br>
			Alamat : <?php echo $detail["alamat_pengiriman"]; ?><br>
			Pesan : <?php echo $detail["pesan"]; ?>
		</p>
	</div>
</div>
<table class="table table-bordered text-center">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama Produk</th>
			<th>Ukuran</th>
			<th>Harga Produk</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?> 
		<?php $ambil = $koneksi->query("SELECT * FROM detail_order JOIN produk 
		ON detail_order.id_produk = produk.id_produk
		WHERE detail_order.id_pembelian = '$_GET[id]' "); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { 
		$size 	= $pecah['id_ukuran'];
			$query	= "SELECT * FROM ukuran WHERE id_ukuran = '$size'";
			$query 	= mysqli_query($koneksi, $query);
			$data 	= mysqli_fetch_array($query);
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			
			<td><?php echo $data['size']; ?></td>
			<?php if ($pecah['diskon'] == 0) { ?>
			<td>Rp.<?php echo number_format($pecah['harga_produk']) ; ?></td>
			<?php } else { ?>
			<td>Rp <?php echo number_format($pecah['harga_produk']-($pecah['diskon'] * $pecah['harga_produk'])); ?></td>
					<?php }  ?>
					<?php if ($pecah['diskon'] != 0) { ?>
			<?php } ?>
			<td><?php echo $pecah['jumlah']; ?></td>

			<td>Rp.<?php echo number_format($pecah['harga_produk']-($pecah['diskon'] * $pecah['harga_produk']* $pecah['jumlah'])) ; ?></td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>