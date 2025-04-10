<?php
require_once '../Models/m_distribusi.php';

if (isset($_GET['action']) && $_GET['action'] == 'tambah') {
  $distribusiController = new DistribusiController();
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $distribusiController->tambahDistribusi(
      $_POST['nama_barang'],
      $_POST['jumlah_distribusi'],
      $_POST['tujuan'],
      $_POST['tanggal_kirim']
    );
  }
}

class DistribusiController
{
  public function getDistribusiById($id_distribusi)
  {
    $distribusi = new Distribusi();
    return $distribusi->getDistribusiById($id_distribusi);
  }

  public function getDataDistribusi()
  {
    $distribusi = new Distribusi();
    return $distribusi->getAllDistribusi();
  }

  public function tambahDistribusi($nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim)
  {
    $distribusi = new Distribusi();
    $stok_tersedia = $distribusi->getStokBarang($nama_barang);

    if ($jumlah_distribusi > $stok_tersedia) {
      echo "<script>alert('Gagal! Jumlah distribusi melebihi stok yang tersedia.'); window.history.back();</script>";
      exit();
    }

    if ($distribusi->addDistribusi($nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim)) {
      echo "<script>alert('Distribusi berhasil ditambahkan!'); window.location='../Views/v_distribusibarang.php';</script>";
    } else {
      echo "<script>alert('Gagal menambahkan distribusi!'); window.history.back();</script>";
    }
    exit();
  }

  public function editDistribusi($id_distribusi, $nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim)
  {
    $distribusi = new Distribusi();
    return $distribusi->editDistribusi($id_distribusi, $nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim);
  }

  public function hapusDistribusi($id_distribusi)
  {
    $distribusi = new Distribusi();
    return $distribusi->deleteDistribusi($id_distribusi);
  }
}
