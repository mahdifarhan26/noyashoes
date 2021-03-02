<?php
$koneksi = new mysqli("localhost","root","","noyashoes"); 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if (isset($_GET["Kirim"])) {
	$tgl_mulai = $_GET["tglm"];
	$tgl_selesai = $_GET["tgls"];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN user pl ON 
		pm.id_user=pl.id_user WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
	while ($pecah = $ambil->fetch_assoc()) {
		$semuadata[]=$pecah; }	 }
?>
<html>
<head>
	<title>Laporan Penjualan</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif; }
	table{
		margin: 20px auto;
		border-collapse: collapse; }
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px; }
	a {
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px; }
	</style>
	<center>
		<h1>Laporan</h1>
	</center>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian'] ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $value["nama_user"] ?></td>
			<td><?php echo $value["tanggal_pembelian"] ?></td>
			<td><?php echo number_format($value["total_pembelian"]) ?></td>
			<td><?php echo $value["status_pembelian"] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">Total</th>
			<th>Rp. <?php echo number_format($total) ?></th>
			<th></th>
		</tr>
	</tfoot>
</table>