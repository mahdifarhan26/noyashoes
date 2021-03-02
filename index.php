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
	<title>NoyaShoes | Beranda</title>
	<link rel="stylesheet" href="Admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'menu.php'; ?>
<!-- Content -->
<section class="konten">
	<div class="container">
		<h1></h1><br>
		<h1>Produk </h1> <br>
		<div class="row">
			<?php 
				if (isset($_GET['page'])) {
					(int) $page = $_GET['page'];
				} else {
					$page = 1;
				}
				$page_view_end = $page * 8;
				$page_view_start = $page_view_end - 8;
				$ambil = $koneksi->query("SELECT * FROM produk limit $page_view_start,8"); ?>
			<?php while($perproduk = $ambil->fetch_assoc()) {?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" >
					<div class="caption text-center">
						<h3><?php echo $perproduk['nama_produk']; ?></h3>
							<?php if ($perproduk['diskon'] == 0) { ?>
						<h5>Rp <?php echo number_format($perproduk['harga_produk']); ?> </h5>
							<?php } else { ?>
						<h5><s>Rp <?php echo number_format($perproduk['harga_produk']); ?></s></h5>
							<?php }  ?>
						<?php if ($perproduk['diskon'] != 0) { ?>
							<h5>Diskon menjadi:  
					Rp<?php echo number_format($perproduk['harga_produk'] - ($perproduk['diskon'] * $perproduk['harga_produk'])); ?> 
							 </h5>
						<?php } ?>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary "><i class="glyphicon glyphicon-shopping-cart"></i> Beli Sekarang</a>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</section>
<div class="text-center">
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <!-- <span class="sr-only">Previous</span> -->
      </a>
    </li>
    	<?php $ambil = $koneksi->query("SELECT count(*) as count_of_product FROM produk"); ?>
    	<?php while($perproduk = $ambil->fetch_assoc()) {
    		$jumlah_produk = $perproduk['count_of_product'];
    		 } ?>
    	<?php 	
    		(int) $jumlah_produk = ($jumlah_produk / 8) + 1;
    		for ($i=1; $i <= $jumlah_produk; $i++) { ?>
    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
	<?php } ?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next"> 
        <span aria-hidden="true">&raquo;</span>
        <!-- <span class="sr-only">Next</span> -->
      </a>
    </li>
  </ul>
</nav>
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
<footer class="main-footer text-center">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="index.php">Company</a>.</strong> All rights reserved.
  </footer>