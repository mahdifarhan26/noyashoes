<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])){
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}
if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
	echo "<script>alert('Produk Kosong, Silahkan Anda Belanja Terlebih Dahulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>NoyaShoes | Checkout</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<form method="POST">
<section class="konten">
	<div class="container">
		<h1></h1><br>
		<h1>Checkout</h1> <br>
		<table class="table table-bordered text-center">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Produk</th>
					<th class="text-center">Ukuran</th>
					<th class="text-center">Harga</th>
					<th class="text-center">Jumlah</th>
					<th class="text-center">Subharga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor = 1; ?>
				<?php $total_belanja = 0; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
				$pecah = $ambil->fetch_assoc();
				if ($pecah['diskon'] != 0) {		
				$subharga = ($pecah['harga_produk'] - ($pecah['diskon'] * $pecah['harga_produk']))*$jumlah;
				} else {
					$subharga = $pecah['harga_produk']*$jumlah;
				}
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah['nama_produk']; ?></td>
					
					<!--ukuran-->
					<td>
					<div class="row">
					<div class="col-md-7">
					<div class="form-group">
						<select name="id_ukuran[]" class="form-control">
							<option value="">--Pilih ukuran--</option>
							<?php 
							$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk = '$id_produk'");
							while($perukuran = $ambil->fetch_assoc()) { 
							?>
							<option value="<?php echo $perukuran['id_ukuran']; ?>">
								<?php 
									echo $perukuran['size'];
									echo ' - Stok : ';
									echo $perukuran['stok']; 
								?>
							</option>
							<?php } ?>
						</select>
					</div>
					</div>
					</div>	
					</td>
					<?php if ($pecah['diskon'] == 0) { ?>
					<td>Rp <?php echo number_format($pecah['harga_produk']); ?></td>
					<?php } else { ?>
					<td>Rp <?php echo number_format($pecah['harga_produk'] - ($pecah['diskon'] * $pecah['harga_produk'])); ?></td>
					<?php }  ?>
					<?php if ($pecah['diskon'] != 0) { ?>
					<?php } ?>
					<td><?php echo $jumlah; ?></td>
					<td>Rp <?php echo number_format($subharga); ?></td>
				</tr>
				<?php $nomor++; ?>
				<?php $total_belanja+=$subharga; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<th class="text-center" colspan="5">Total</th>
				<th class="text-center">Rp <?php echo number_format($total_belanja); ?></th>
			</tfoot>
		</table>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly class="form-control text-center" value="<?php echo $_SESSION['user']['nama_user']; ?>">
					</div>
				</div>
				<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly class="form-control text-center" value="<?php echo $_SESSION['user']['telepon_user']; ?>">
					</div>
				</div>
				<!--ongkir-->
				<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<select name="id_ongkir" class="form-control">
							<option value="">-- Pilih Ongkir --</option>
							<?php 
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while($perongkir = $ambil->fetch_assoc()) { 
							?>
							<option value="<?php echo $perongkir['id_ongkir']; ?>">
								<?php echo $perongkir['nama_kota']; ?> -
								Rp. <?php echo number_format($perongkir['tarif']); ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Konfirmasi Alamat Pengiriman</label>
				<textarea name="alamat_pengiriman" rows="2" class="form-control" style="resize: none;" placeholder="Masukkan Alamat Pengiriman Secara Lengkap"></textarea>
				<label>Pesan</label>
				<textarea name="pesan" rows="2" class="form-control" style="resize: none;" placeholder="Silahkan Tinggalkan Pesan"></textarea>
			</div>
			<input type="submit" name="checkout" class="btn btn-success" value="Checkout">
		</form>

		<?php
		if (isset($_POST['checkout'])) {
			$id_user = $_SESSION['user']['id_user'];
			$id_ongkir 			= $_POST['id_ongkir'];
			$tanggal_pembelian 	= date("Y-m-d");
			$alamat_pengiriman 	= $_POST['alamat_pengiriman'];
			$pesan 				= $_POST['pesan'];
			$ambil 				= $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir' ");
			$array_ongkir 		= $ambil->fetch_assoc();
			$nama_kota			= $array_ongkir['nama_kota'];
			$tarif 				= $array_ongkir['tarif'];
			$id_ukuran	 		= $_POST['id_ukuran'];
			$total_pembelian = $total_belanja + $tarif;

			//menyimpan data ke tabel pembelian
			$koneksi->query("INSERT INTO pembelian(id_user, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman,pesan) VALUES('$id_user','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman','$pesan')");
			$id_pembelian_barusan = $koneksi->insert_id;
			$i = 0;
			foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
			
			$id_ukuran_receive = $id_ukuran[$i];
			//mendapatkan data produk berdasarkan id_produk

			$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
			$perproduk = $ambil->fetch_assoc();
			$nama = $perproduk['nama_produk'];			
			if ($perproduk['diskon'] != 0){  
			$harga = ($perproduk['harga_produk']-($perproduk['diskon']*$perproduk['harga_produk']));
			} else {
			$harga = $perproduk['harga_produk']* $jumlah;
			}
			$berat = $perproduk['berat'];
			if ($perproduk['diskon'] != 0){
			$subharga = ($perproduk['harga_produk']- ($perproduk['diskon']* $perproduk['harga_produk']))*$jumlah;
			} else {
			$subharga = $perproduk['harga_produk']*$jumlah;
			}
			$subberat = $perproduk['berat']* $jumlah;
			
			$koneksi->query("INSERT INTO detail_order(id_pembelian, id_produk, nama, id_ukuran, harga, berat, subharga, subberat, jumlah) VALUES('$id_pembelian_barusan','$id_produk','$nama','$id_ukuran_receive', '$harga','$berat','$subharga','$subberat','$jumlah')");
			$koneksi->query("UPDATE produk SET id_stok = id_stok - $jumlah WHERE id_produk ='$id_produk' ");

			$koneksi->query("INSERT INTO produk(id_produk, jumlah_terjual) VALUES('$id_produk','$jumlah_terjual')");
			$koneksi->query("UPDATE produk SET jumlah_terjual = jumlah_terjual + $jumlah WHERE id_produk = '$id_produk' "); 
			$i++;
			}
			//mengkosongkan keranjang belanja
			unset($_SESSION['keranjang']);
			//tampilan akan dialihkan ke nota, nota pembelian barusan
			echo "<script>alert('Pembelian Sukses');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
		}
		?>
	</div>
</section><br>
<!--link dropdown-->
<script>
$(document).ready(function(){
  $('.dropdown a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
</body>
</html>