<?php include 'koneksi.php'; ?>
<?php
$keyword = $_GET["keyword"];
$semuadata=array();
$ambil = $koneksi->query("SELECT*FROM produk WHERE nama_produk LIKE '%$keyword%' OR 
	deskripsi LIKE '%keyword%' ");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[]=$pecah; } ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>Pencarian</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<div class="container">
	<h3></h3><br>
	<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
	<?php if(empty($semuadata)): ?>
		<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> Tidak Ditemukan</div>
	<?php endif ?>
	<div class="row">
		<?php foreach ($semuadata as $key => $value): ?>
		<div class="col-md-3">
			<div class="thumbnail">
				<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
				<div class="caption">
					<h3><?php echo $value["nama_produk"] ?></h3>
					<h5>Rp. <?php echo number_format($value["harga_produk"]) ?></h5>
					<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default"><i class="glyphicon glyphicon-shopping-cart"></i>Beli Sekarang</a>
				</div> </div> </div>
		<?php endforeach ?>
	</div> </div>
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