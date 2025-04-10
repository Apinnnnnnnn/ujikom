<?php
require_once '../Config/Koneksi.php';

class Barang
{
  private $db;

  public function __construct()
  {
    $this->db = new Koneksi();
  }

  public function getBarangById($id_barang)
  {
    $query = "SELECT * FROM tb_barang WHERE id_barang = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getAllBarang()
  {
    $query = "SELECT tb_barang.*, tb_suplayer.nama_suplayer, tb_suplayer.alamat, tb_suplayer.telepon FROM tb_barang JOIN tb_suplayer ON tb_barang.id_suplayer = tb_suplayer.id_suplayer";

    $result = $this->db->conn->query($query);

    if (!$result) {
      die("Query error: " . $this->db->conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function addBarang($nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk)
  {
    $query = "INSERT INTO tb_barang (nama_barang, id_suplayer, jumlah_barang, kategori, tanggal_masuk) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("siiss", $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk);
    return $stmt->execute();
  }

  public function editBarang($id_barang, $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk)
  {
    $query = "UPDATE tb_barang SET nama_barang = ?, id_suplayer = ?, jumlah_barang = ?, kategori = ?, tanggal_masuk = ? WHERE id_barang = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("siissi", $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk, $id_barang);
    return $stmt->execute();
  }

  public function deleteBarang($id_barang)
  {
    $query = "DELETE FROM tb_barang WHERE id_barang = '$id_barang'";
    return $this->db->conn->query($query);
  }
}
