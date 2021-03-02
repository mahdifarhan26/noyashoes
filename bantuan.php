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
	<title>NoyaShoes | Bantuan</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>

<!--kontent-->
<section class=" kontent">
	<div class=" container">
		<h1></h1><br>
		<h1 class="text-center">Bantuan</h1><br>
		<div class=" row">
	<div class=" col-md-6 alert alert-success">
	<p>
		<strong> Kontak Kami </strong><br>
		Jika anda mengalami kendala dalam proses transaksi atau proses pendaftaran <br>
		<strong>Dapat Hubungi Kontak Dibawah ini :</strong><br>
		<strong>Email : mahdifarhan78@gmail.com</strong><br>
		<strong>Atau</strong><br>
		<strong>No.Telepon : 081225221762</strong>
	</p>
	</div></div>
	<div class=" row">
	<div class=" col-md-6 alert alert-success">
	<p>
		<strong> Pandauan Belanja: </strong><br>
		1. Membuka halaman atau halaman produk yang ingin dibeli.  <br>
		2. Pilih produk yang ingin dibeli lalu tekan tombol "beli sekarang"<br>
		3. Setalah tekan tombol "beli sekarang" akan berpindah ke detail order<br>
		4. Memasukkan jumlah barang yang akan dibeli lalu tekan tombol "Beli sekarang"<br>
		5. Secara otomatis barang akan masuk dikeranjang belanja <br>
		6. Selanjutnya menekan tombol "Checkout" <br>
		7. Barang akan berpindah ke menu checkout <br>
		8. Pelanggan memilih ukuran, memilih ongkir, mengisi konfirmasi alamat, dan <br>
		   Mengisi pesan jika ada pesan yang ingin disampaikan <br>
		9. Selanjutnya menekan tombol "Checkout" <br> 
	</p> </div> </div> </div> </section>
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f48d1de1e7ade5df444c26c/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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