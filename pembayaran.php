<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user']) or empty($_SESSION['user'])) {
	echo "<script>alert('Silahkan login dulu');</script>";
	echo "<script>location='login.php'; </script>"; }
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem' ");
$detpem = $ambil->fetch_assoc();
$id_pel_beli = $detpem ["id_user"];
$id_pel_login = $_SESSION["user"]["id_user"];
if ($id_pel_login !== $id_pel_beli) {
echo "<script>alert('Jangan diubah');</script>";
echo "<script>location='riwayat.php'; </script>"; } ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include'menu.php'; ?>
<div class="container">
	<h1></h1><br>
	<h1>Konfirmasi Pembayaran</h1>
	<p>Kirim bukti pembayaran anda disini </p>
	<div class="alert alert-info">Total Tagihan <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ;?></strong></div>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Masukkan Id Pembelian</label>
			<input type="number" class="form-control" name="id_pembelian">
		</div>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Penyetor</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label>Metode Pembayaran </label>
			<input type="text" class="form-control" name="metode_pembayaran">
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" class="form-control" name="jumlah" min="1" >
		</div>
		<div class="form-group">
			<label>Foto Bukti</label>
			<input type="file" class="form-control" name="bukti">
			<p class="text text-danger">foto bukti harus jpg/jpeg maksimal 2MB</p>
		</div>
		<button class="btn btn-primary" name="kirim">Kirim</button>
	</form>
</div>
<?php
if (isset($_POST['kirim'])) {
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

	$idpem =$_POST["id_pembelian"];
	$nama =$_POST["nama"];
	$metode_pembayaran =$_POST["metode_pembayaran"];
	$jumlah =$_POST["jumlah"];
	$tanggal =date("Y-m-d");

	$koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, metode_pembayaran, jumlah, tanggal, bukti)VALUES ('$idpem','$nama','$metode_pembayaran','$jumlah','$tanggal','$namafix') ");

	$koneksi->query("UPDATE pembelian SET status_pembelian='Menunggu Konfirmasi Pembayaran' WHERE id_pembelian ='$idpem' ");

	echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
} ?>
</body>
</html>