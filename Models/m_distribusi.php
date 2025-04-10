<?php
require_once '../Config/Koneksi.php';

class Distribusi
{
  private $db;

  public function __construct()
  {
    $this->db = new Koneksi();
  }

  public function getDistribusiById($id_distribusi)
  {
    $query = "SELECT * FROM tb_distribusi WHERE id_distribusi = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("i", $id_distribusi);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getAllDistribusi()
  {
    $query = "SELECT d.*, b.nama_barang, t.alamat, t.telepon 
              FROM tb_distribusi d 
              JOIN tb_barang b ON d.nama_barang = b.nama_barang 
              JOIN tb_toko t ON d.tujuan = t.nama_toko";
    $result = $this->db->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function addDistribusi($nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim)
  {
    $this->db->conn->begin_transaction();

    try {
      $query1 = "INSERT INTO tb_distribusi (nama_barang, jumlah_distribusi, tujuan, tanggal_kirim) VALUES (?, ?, ?, ?)";
      $stmt1 = $this->db->conn->prepare($query1);
      $stmt1->bind_param("siss", $nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim);
      $stmt1->execute();

      $query2 = "UPDATE tb_barang SET jumlah_barang = jumlah_barang - ? WHERE nama_barang = ?";
      $stmt2 = $this->db->conn->prepare($query2);
      $stmt2->bind_param("is", $jumlah_distribusi, $nama_barang);
      $stmt2->execute();

      $this->db->conn->commit();
      return true;
    } catch (Exception $e) {
      $this->db->conn->rollback();
      return false;
    }
  }

  public function editDistribusi($id_distribusi, $nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim)
  {
    $query = "UPDATE tb_distribusi SET nama_barang = ?, jumlah_distribusi = ?, tujuan = ?, tanggal_kirim = ? WHERE id_distribusi = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("sdssi", $nama_barang, $jumlah_distribusi, $tujuan, $tanggal_kirim, $id_distribusi);
    return $stmt->execute();
  }

  public function getStokBarang($nama_barang)
  {
    $db = new Koneksi();
    $conn = $db->getConnection();

    $query = "SELECT jumlah_barang FROM tb_barang WHERE nama_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama_barang);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row ? $row['jumlah_barang'] : 0;
  }

  public function deleteDistribusi($id_distribusi)
  {
    $this->db->conn->begin_transaction();

    try {
      // Ambil data distribusi dulu
      $query1 = "SELECT nama_barang, jumlah_distribusi FROM tb_distribusi WHERE id_distribusi = ?";
      $stmt1 = $this->db->conn->prepare($query1);
      $stmt1->bind_param("i", $id_distribusi);
      $stmt1->execute();
      $result = $stmt1->get_result();
      $data = $result->fetch_assoc();

      if (!$data) {
        throw new Exception("Data distribusi tidak ditemukan.");
      }

      // Tambahkan kembali stok barang
      $query2 = "UPDATE tb_barang SET jumlah_barang = jumlah_barang + ? WHERE nama_barang = ?";
      $stmt2 = $this->db->conn->prepare($query2);
      $stmt2->bind_param("is", $data['jumlah_distribusi'], $data['nama_barang']);
      $stmt2->execute();

      // Hapus distribusi
      $query3 = "DELETE FROM tb_distribusi WHERE id_distribusi = ?";
      $stmt3 = $this->db->conn->prepare($query3);
      $stmt3->bind_param("i", $id_distribusi);
      $stmt3->execute();

      $this->db->conn->commit();
      return true;
    } catch (Exception $e) {
      $this->db->conn->rollback();
      return false;
    }
  }
}
