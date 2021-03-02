<?php
ession_start();
session_destroy();
echo "<script>alert('Logout Berhasil');</script>";
echo "<script>location='index.php';</script>";
?>