<?php 
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>NoyaShoes| Nota</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<section class="konten">
	<div class="container">
		<h2></h2><br>
		<h2>Nota Pembelian</h2>
		<?php
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN user 
			ON pembelian.id_user = user.id_user 
			WHERE pembelian.id_pembelian = '$_GET[id]' ");
		$detail = $ambil->fetch_assoc();
		?>
		<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat-->
		<?php 
		$iduseryangbeli = $detail["id_user"];
		$iduseryanglogin = $_SESSION["user"]["id_user"];
		if ($iduseryangbeli!==$iduseryanglogin) {
			echo "<script>alert('jangan di ubah');</script>";
			echo "<script>location='riwayat.php';</script>";
			exit(); } ?>
		<div class="row">
			<div class="col-md-4">
				<h3>Pembelian</h3>
				<strong>NO. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
				Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
			Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
			</div>
			<div class="col-md-4">
				<h3>Pelanggan</h3>
				<strong>Nama : <?php echo $detail['nama_user']; ?></strong> <p>
			Telepon : <?php echo $detail['telepon_user']; ?> <br>
			Email : <?php echo $detail['email_user']; ?>
			</div>
			<div class="col-md-4">
				<h3>Pengiriman</h3>
				<strong>Kab. / Kota : <?php echo $detail['nama_kota']; ?></strong><br>
				Ongkir : <?php echo $detail['tarif']; ?><br>
				Alamat : <?php echo $detail['alamat_pengiriman']; ?><br>
				Pesan : <?php echo $detail['pesan']; ?>
</div> </div>
<table class="table table-bordered text-center">
	<thead>
		<tr>
			<th class="text-center">No.</th>
			<th class="text-center">Nama Produk</th>
			<th class="text-center">Ukuran</th>
			<th class="text-center">Harga Produk</th>
			<th class="text-center">Berat Produk</th>
			<th class="text-center">Jumlah</th>
			<th class="text-center">Subharga</th>
			<th class="text-center">Subberat</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?> 
		<?php $ambil = $koneksi->query("SELECT * FROM detail_order WHERE id_pembelian = '$_GET[id]' "); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { 
			$size 	= $pecah['id_ukuran'];
			$query	= "SELECT * FROM ukuran WHERE id_ukuran = '$size'";
			$query 	= mysqli_query($koneksi, $query);
			$data 	= mysqli_fetch_array($query); ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $data['size']; ?></td>
			<td>Rp.<?php echo number_format($pecah['harga']) ; ?></td>
			<td><?php echo $pecah['berat'] ; ?>Gr</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp.<?php echo number_format($pecah['subharga']) ; ?></td>
			<td><?php echo $pecah['subberat'];?> Gr</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?> </tbody> </table>
<div class="row">
	<div class="col-md-6 alert alert-success">
		<p>Silahkan Melakukan Pembayaran Rp. <?php echo number_format($detail['total_pembelian']); 
		?> ke  <br>
		<strong>BANK BCA 5460084123 AN. BASUKI </strong><br>
		<strong>Atau</strong><br>
		<strong>MANDIRI 157-00-0432867-1 AN. BASUKI </strong>
	</p> </div> </div> </div> </section>
<!--link dropdown-->
<script>
$(document).ready(function(){
  $('.dropdown a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  }); });
</script>
</body>
</html>