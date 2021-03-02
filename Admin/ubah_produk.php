<h2 class="text-center">Ubah Produk</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]' ");
$pecah= $ambil->fetch_assoc();

?>

<?php 
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) 
{
	$datakategori[] = $tiap;
}
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Kategori</label>
		<select name="id_kategori" class="form-control">
		<option>-Pilih Kategori-</option>
		<?php foreach ($datakategori as $key => $value): ?>
		<option value="<?php echo $value["id_kategori"] ?>" <?php if($pecah["id_kategori"]==$value["id_kategori"]){echo "selected"; } ?> >
		<?php echo $value["nama_kategori"] ?></option>
	<?php endforeach ?>
		</select>	
		</div>
	<div class="form-group">
		<label>Harga Rp</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
	<label>Berat (Gr)</label>
    <input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat']; ?>">
	</div>
	<div class="form-group">
	<label>Diskon</label>
	<input type="float" class="form-control" name="diskon" value="<?php echo $pecah['diskon']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="150" height="100">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="5">
			<?php echo $pecah['deskripsi']; ?>
		</textarea>
	</div>
	<div class="form-group">
		<label>Stock</label>
		<input type="number" class="form-control" name="stock" value="<?php echo $pecah['id_stok']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
	<a href="index.php?halaman=produk" class="btn btn-warning">Kembali</a>
</form>


<?php 
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto'] ['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	// jika foto dirubah
	if (!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat='$_POST[berat]',diskon='$_POST[diskon]',
			foto_produk='$namafoto',deskripsi='$_POST[deskripsi]',id_stok='$_POST[stock]',id_kategori=$_POST[id_kategori]
			WHERE id_produk='$_GET[id]' ");
	}
	else
	{
	$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat='$_POST[berat]',diskon='$_POST[diskon]',
			deskripsi='$_POST[deskripsi]',id_stok='$_POST[stock]',id_kategori=$_POST[id_kategori] WHERE id_produk='$_GET[id]' ");	
	}
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
?>