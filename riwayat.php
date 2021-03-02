<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user']) or empty($_SESSION['user'])) {
	echo "<script>alert('Silahkan login dulu');</script>";
	echo "<script>location='login.php'; </script>"; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>NoyaShoes | Riwayat</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include'menu.php' ; ?>
<section class="riwayat">
	<div class="container">
		<h2></h2><br>
		<h3>Riwayat Belanja <?php echo $_SESSION["user"]["nama_user"] ?></h3>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor=1;
				$id_user = $_SESSION["user"]["id_user"];
				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_user = $id_user"); 
				while ($pecah = $ambil->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
					<td>
						<?php echo $pecah["status_pembelian"]; ?>
						<br>
						<?php if (!empty($pecah['resi_pengiriman'])): ?>
						Resi : <?php echo $pecah['resi_pengiriman']; ?>
						<?php endif ?>		
					</td>
					<td>Rp.<?php echo number_format($pecah["total_pembelian"]); ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Nota</a>
						<?php if ($pecah['status_pembelian']=="Pending"): ?>
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Input Pembayaran</a>
						<?php else: ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">Lihat Pembayaran</a>
					<?php endif ?> </td> </tr>
				<?php $nomor++; ?>
			<?php }?> </tbody> </table> </div> </section>
			
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
