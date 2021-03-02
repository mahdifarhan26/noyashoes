 <?php include 'header.php'; ?>
  <div class="content-wrapper">
    <section class="content-header">
    <section class="content container-fluid">
     <?php
     if (isset($_GET['halaman'])) {
       if ($_GET['halaman'] == "produk") {
         include 'produk.php';
      }elseif ($_GET['halaman'] == "pelanggan") {
       include 'pelanggan.php';
      } elseif ($_GET['halaman'] == "pembelian") {
        include 'pembelian.php';
      } elseif ($_GET['halaman'] == "detail") {
        include 'detail.php'; 
      } elseif ($_GET['halaman'] == "tambah_produk") {
        include 'tambah_produk.php'; 
      } elseif ($_GET['halaman'] == "hapus_produk") {
        include 'hapus_produk.php';
      } elseif ($_GET['halaman'] == "ubah_produk") {
        include 'ubah_produk.php';
      }elseif ($_GET['halaman'] == "logout") {
        include 'logout.php';
      }
        elseif ($_GET["halaman"]=='pembayaran') {
        include 'pembayaran.php';
      }
        elseif ($_GET["halaman"]=="laporan_pembelian") {
        include 'laporan_pembelian.php';
      }
      elseif ($_GET["halaman"]=="kategori") {
        include 'kategori.php';
      }
      elseif ($_GET["halaman"]=="tambah_kategori") {
        include 'tambah_kategori.php';
      }
      elseif ($_GET["halaman"]=="ubah_kategori") {
        include 'ubah_kategori.php';
      }
      } else {
      include 'home.php';
     }
     ?>
    </section>
  </div>
 <?php include 'footer.php'; ?>