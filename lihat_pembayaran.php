<?php
session_start();
include 'koneksi.php';
$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian' ");
$detbay = $ambil->fetch_assoc();

//jika blm ada data pembayaran
if (empty($detbay))
{
  echo "<script>alert('Belum ada data pembayaran')</script>";
  echo "<script>location='riwayat.php';</script>";
  exit();
}

//jika data pembayaran tidak sesuai dengan yang login
if ($_SESSION["user"]["id_user"]!==$detbay["id_user"]) 
{
	echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain')</script>";
  	echo "<script>location='riwayat.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lihat Pembayaran</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
	<h2></h2><br>
	<h3>Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Id Pembelian</th>
					<td><?php echo $detbay["id_pembelian"] ?></td>
				</tr>
				<tr>
					<th>Nama</th>
					<td><?php echo $detbay["nama"] ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $detbay["metode_pembayaran"] ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td><?php echo $detbay["tanggal"] ?></td>
				</tr>
				<tr>
					<th>Jumlah</th>
					<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
		</div>
	</div>
</div>
</body>
</html>