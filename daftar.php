<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>NoyaShoes | Daftar</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center"><b>NoyaShoes | Daftar Pelanggan</b></h3>
				</div>
				<div class="panel-body">
					<form method="POST" class="form-horizontal">
						<div class="form-group">
						<label class="col-md-3 control-label">Nama</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="nama" required>
						</div>	
						</div>
						<div class="form-group">
						<label class="col-md-3 control-label">Email</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" required>
						</div>	
						</div>
						<div class="form-group">
						<label class="col-md-3 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" required>
						</div>	
						</div>
						<div class="form-group">
						<label class="col-md-3 control-label">Alamat</label>
						<div class="col-md-6">
							<textarea name="alamat" rows="2" class="form-control" style="resize: none;" required>
							</textarea>
						</div>	
						</div>
						<div class="form-group">
						<label class="col-md-3 control-label">No. Telepon</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="telepon" required>
						</div>	
						</div>
						<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button class="btn btn-primary btn-block btn-lg" name="daftar">Daftar</button>
						</div>	
						</div>
					</form>
					<?php
					if (isset($_POST["daftar"]))
					{
						$nama = $_POST["nama"];
						$email = $_POST["email"];
						$password = $_POST["password"];						
						$alamat = $_POST["alamat"];
						$telepon = $_POST["telepon"];
						//cek apakah email sudah digunakan atau belum
						$ambil = $koneksi->query("SELECT * FROM user WHERE email_user ='$email'");
						$cocok = $ambil->num_rows;
						if ($cocok == 1)  {
							echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan');</script>";
							echo "<script>location='daftar.php';</script>";
						} 
						else  {
							//queryy memasukkan kedalam database
							$koneksi->query("INSERT INTO user(email_user, password_user, nama_user telepon_user, alamat_user)VALUES('$email','$password','$nama','$telepon','$alamat')");
							echo "<script>alert('Pendaftaran Berhasil, Silahkan Anda Login');</script>";
							echo "<script>location='login.php';</script>";
						} } ?>
				</div>
			</div>
		</div>
	</div>
</div>
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
  });
});
</script>
</body>
</html>