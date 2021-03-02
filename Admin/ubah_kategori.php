<h2 class="text-center">Ubah Kategori</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]' ");
$pecah= $ambil->fetch_assoc();
?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label>Nama Kategori</label>
<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_kategori']; ?>">	
</div>	
<button class="btn btn-primary" name="ubah">Ubah</button>
<a href="index.php?halaman=kategori" class="btn btn-warning">Kembali</a>
</form>

<?php 
if (isset($_POST['ubah']))
{
		$koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama]'
			WHERE id_kategori='$_GET[id]' ");
	
	echo "<script>alert('data kategori telah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}
?>