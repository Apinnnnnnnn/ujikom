<?php
include "../Config/Koneksi.php";

class Login extends Koneksi
{
  // Fungsi untuk login
  public function prosesLogin($usernameOrEmail, $password)
  {
    $query = "SELECT * FROM tb_user WHERE username = ? OR email = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Cek apakah user ditemukan
    if (!$user) {
      return false;
    }

    // Bandingkan password langsung (tanpa hashing)
    if ($password === $user['password']) {
      session_start(); // Pastikan session hanya dijalankan sekali
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      return true;
    } else {
      return false;
    }
  }

  // Fungsi untuk register
  public function tambahAkun($username, $email, $password)
  {
    if (trim($username) == "") {
      return "Username tidak boleh kosong atau hanya spasi!";
    }

    // Cek apakah username atau email sudah ada
    $queryCheck = "SELECT * FROM tb_user WHERE username = ? OR email = ?";
    $stmtCheck = $this->conn->prepare($queryCheck);
    $stmtCheck->bind_param("ss", $username, $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
      return "Username atau email sudah digunakan!";
    }

    // Simpan password langsung
    $query = "INSERT INTO tb_user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $password);

    return $stmt->execute();
  }
}
