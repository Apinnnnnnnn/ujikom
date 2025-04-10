<?php
require_once '../Models/m_databarang.php';

class BarangController
{
  public function getBarangById($id_barang)
  {
    $barang = new Barang();
    return $barang->getBarangById($id_barang);
  }

  public function getDataBarang()
  {
    $barang = new Barang();
    $data_barang = $barang->getAllBarang();

    return $data_barang;
  }

  public function tambahBarang($nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk)
  {
    $barang = new Barang();
    try {
      $result = $barang->addBarang($nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk);
      if (!$result) {
        throw new Exception("Gagal menambahkan barang.");
      }
      return true;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function editBarang($id_barang, $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk)
  {
    $barang = new Barang();
    return $barang->editBarang($id_barang, $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk);
  }

  public function hapusBarang($id_barang)
  {
    $barang = new Barang();
    return $barang->deleteBarang($id_barang);
  }
}
