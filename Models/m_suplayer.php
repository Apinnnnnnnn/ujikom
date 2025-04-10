<?php
require_once '../Config/Koneksi.php';

class Suplayer
{
  private $db;

  public function __construct()
  {
    $this->db = new Koneksi();
  }

  public function getSuplayerById($id_suplayer)
  {
    $query = "SELECT * FROM tb_suplayer WHERE id_suplayer = ?";
    $stmt = $this->db->conn->prepare($query);
    $stmt->bind_param("i", $id_suplayer);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getAllSuplayer()
  {
    $query = "SELECT * FROM tb_suplayer";
    $result = $this->db->conn->query($query);

    if (!$result) {
      die("Query error: " . $this->db->conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
