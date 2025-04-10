<?php
require_once '../Config/Koneksi.php';

class Toko
{
  private $db;

  public function __construct()
  {
    $this->db = new Koneksi();
  }

  public function getTokoById($id_toko)
  {
    $query = "SELECT * FROM tb_toko WHERE id_toko = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("i", $id_toko);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getAllToko()
  {
    $query = "SELECT * FROM tb_toko";
    $result = $this->db->conn->query($query);

    if (!$result) {
      die('Query Error: ' . $this->db->conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
