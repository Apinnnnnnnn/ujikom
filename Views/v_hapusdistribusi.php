<?php
require_once "../Controllers/c_distribusi.php";

if (isset($_GET['id_distribusi'])) {
  $id_distribusi = $_GET['id_distribusi'];
  $distribusiController = new DistribusiController();
  $distribusiController->hapusDistribusi($id_distribusi);
}

echo "<script>alert('Distribusi berhasil dihapus!'); window.location='v_distribusibarang.php';</script>";
exit();
