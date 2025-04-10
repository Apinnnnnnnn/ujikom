<?php
class Koneksi
{
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $db = "sigudang";
  public $conn;

  public function __construct()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    if ($this->conn->connect_error) {
      die("Koneksi gagal: " . $this->conn->connect_error);
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function Query_Tampil($query)
  {
    $result = $this->conn->query($query);

    if ($result) {
      return $result->fetch_assoc();
    } else {
      return "Query failed: " . $this->conn->error;
    }
  }

  public function Query_Perintah($query)
  {
    if ($this->conn->query($query)) {
      return true;
    } else {
      return "Query failed: " . $this->conn->error;
    }
  }
}
