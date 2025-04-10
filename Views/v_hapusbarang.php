<?php
require_once "../Controllers/c_databarang.php";

if (isset($_GET['id_barang'])) {
  $id_barang = $_GET['id_barang'];
  $barangController = new BarangController();
  $barangController->hapusBarang($id_barang);
}

echo "<script>alert('Barang berhasil dihapus!'); window.location='v_databarang.php';</script>";
exit();
