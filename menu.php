<nav class="navbar navbar-light navbar-fixed-top" style="background-color: #e3f2fd;" >	
<div class="container">
<ul class="nav navbar-nav">
			<li><a href="index.php"><b>HOME </b></a></li>
			<!-- dropdown produk-->
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href=""><b>Produk</b>
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="best_seller.php">Best Seller</a></li>
			<li><a href="promosi.php">Promosi</a></li>
			<li>
			<a class="test" href="#">Kategori <span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="Sepatu_kulit.php">Sepatu Kulit</a></li>
          	<li><a href="sepatu_gunung.php">Sepatu Gunung</a></li>
          	<li><a href="sepatu_sekolah.php">Sepatu Sekolah</a></li>
          	<li><a href="sepatu_anak.php">Sepatu Anak-Anak</a></li>
          	<li><a href="sepatu_sport.php">Sepatu Sport</a></li>
			</ul>
			</li>
      		</ul>
			</li>
			<li><a href="keranjang.php" ><b>Keranjang</b></a></li>
			<!-- jika sudah login -->
			<li><a href="checkout.php"><b>Checkout</b></a></li>
			<li><a href="riwayat.php"><b>Riwayat Belanja</b></a></li>
			<?php if(isset($_SESSION['user'])): ?>
			<li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin Logout ?')"><b>Logout</b></a></li>
			<!-- jika belum login -->
			<?php else: ?>
			<li><a href="daftar.php"><b>Daftar</b></a></li>
			<li><a href="login.php"><b>Login</b></a></li>
		<?php endif ?>
      <li><a href="bantuan.php"><b>Bantuan</b></a></li>
		</ul>
		<form action="pencarian.php" method="get" class="navbar-form navbar-right">
			<input type="text" class="form-control" name="keyword">
			<button class="btn btn-primary">Cari</button>
		</form>
	
</div>
</nav>