<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>NoyaShoes | Login</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'menu.php'; ?>

<div class="container">
	<div class="row" style="margin-top: 100px">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title text-center">
						<label>NoyaShoes | Login</label>
					</div>
				</div>
				<div class="panel-body">
					<form method="POST">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary btn-lg btn-block" name="login">Login</button><br>
						<p>Daftar Sebagai Pelanggan? <a href="daftar.php" style="text-decoration: none;"><b>Daftar</b></a></p>
					</form>
					<?php
					if (isset($_POST['login'])){
						$email = $_POST['email'];
						$password = $_POST['password'];

						$ambil = $koneksi->query("SELECT * FROM user WHERE email_user = '$email' AND 
							password_user = '$password' ");
						$akun_cocok = $ambil->num_rows;

						if ($akun_cocok == 1) {
							$akun = $ambil->fetch_assoc();

							$_SESSION['user'] = $akun;
							echo "<div class='alert alert-success text-center'>Login Berhasil</div>";
							if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {
								echo "<meta http-equiv='refresh' content='1;url=checkout.php'>";
							} else {
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
							}
						} else {
							echo "<div class='alert alert-danger text-center'>Login Gagal, Silahkan Periksa Akun Anda</div>";
							echo "<meta http-equiv='refresh' content='1;url=login.php'>";
						}
					}
					?>
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
</body>
</html>