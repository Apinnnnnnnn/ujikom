<?php
session_start();
include "../Models/UserModel.php";

$user = new Login();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $usernameOrEmail = trim($_POST['usernameOrEmail']);
  $password = $_POST['password'];

  if (empty($usernameOrEmail) || empty($password)) {
    echo "<script>alert('Username/Email dan Password wajib diisi!'); </script>";
    exit;
  }

  $loginStatus = $user->prosesLogin($usernameOrEmail, $password);

  if ($loginStatus) {
    echo "<script>alert('Anda Berhasil Login'); window.location='../Views/index.php';</script>";
    exit;
  } else {
    echo "<script>alert('Username/Email atau Password salah'); window.location='../login.php';</script>";
    exit;
  }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'logout') {
  session_destroy();
  echo "<script>alert('Anda telah keluar dari sistem'); window.location='../login.php';</script>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_akun'])) {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if ($username == "") {
    echo "<script>alert('Username tidak boleh kosong atau hanya spasi!'); window.location='../register.php';</script>";
    exit;
  }

  $registerStatus = $user->tambahAkun($username, $email, $password);

  if ($registerStatus === true) {
    echo "<script>alert('Akun berhasil ditambahkan!'); window.location='../login.php';</script>";
    exit;
  } elseif ($registerStatus === "Username tidak boleh kosong atau hanya spasi!") {
    echo "<script>alert('Username tidak boleh kosong atau hanya spasi!'); window.location='../register.php';</script>";
    exit;
  } elseif ($registerStatus === "Username atau email sudah digunakan!") {
    echo "<script>alert('Username atau email sudah digunakan!'); window.location='../register.php';</script>";
    exit;
  } else {
    echo "<script>alert('Gagal menambahkan akun'); window.location='../register.php';</script>";
    exit;
  }
}
