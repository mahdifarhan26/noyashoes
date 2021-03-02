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
	<title>NoyaShoes | Detail</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<section class="konten">
	<div class="container">
		<h1></h1><br>
		<h1>Detail Produk</h1><br>

		<?php
		$id_produk = $_GET['id'];

		$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
		$detail = $ambil->fetch_assoc();
		?>

		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail['nama_produk']; ?></h2>
				<?php if ($detail['diskon'] == 0) { ?>
				<h3>Rp.<?php echo number_format($detail['harga_produk']); ?></h3>
				<?php } else { ?>
				<h5><s>Rp <?php echo number_format($detail['harga_produk']); ?></s></h5>
				<?php }  ?>
				<?php if ($detail['diskon'] != 0) { ?>
				<h5>Diskon menjadi:  
				Rp<?php echo number_format($detail['harga_produk'] - ($detail['diskon'] * $detail['harga_produk'])); ?> 
				</h5>
				<?php } ?>
				<h3><?php echo number_format( $detail['berat']); ?>Gr</h3>
				<!-- <h4>Stock: <?php echo $detail['id_stok'] ?></h4> -->

				<table class="table table-bordered text-center">
					<?php
						$ambil = $koneksi->query("SELECT * FROM ukuran WHERE id_produk = '$id_produk'");
								$perukuran = $ambil->fetch_assoc();
					?>
					<tr>
						<td><b>Ukuran</b></td>
						<td><b>Stok</b></td>
						<!-- <td> -->
							<?php
								while($perukuran = $ambil->fetch_assoc()) { 
							?>
						<!-- </td> -->
					</tr>
					<tr>
						<td>
							<?php
								echo $perukuran['size'];
									
							?>
						</td>
						<td>
							<?php
								echo $perukuran['stok'];
								}
							?>
						</td>
					</tr>
				</table>
				
				<form method="POST">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['id_stok'] ?>" required autofocus>
							<div class="input-group-btn">
								<button class="btn btn-success" name="beli">Beli Sekarang</button>
							</div>
						</div>
					</div>
				</form>
				<?php
				if (isset($_POST['beli'])) {
				$jumlah = $_POST["jumlah"];
				if (isset($_SESSION['keranjang'][$id_produk]))
				{
					$_SESSION['keranjang'][$id_produk]+=$jumlah;
				}
				else
				{
					$_SESSION['keranjang'][$id_produk]=$jumlah;
				}

				echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
				echo "<script>location='keranjang.php';</script>";
				}
				?>
				<!-- <p><?php echo $detail['deskripsi']; ?></p> -->
				<a href="index.php" class="btn btn-warning">Kembali</a>
			</div>
		</div>
	</div>
</section>
</body>
</html>