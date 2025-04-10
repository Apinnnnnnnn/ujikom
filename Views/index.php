<?php
SESSION_START();
if (!isset($_SESSION["username"])) {
  header("Location: ../login.php");
  exit();
}

$username = $_SESSION['username'];

$side = "Dashboard";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <h2 class="text-center text-capitalize">Selamat Datang, <i class="text-bold font-monospace"><?= $username; ?></i>!</h2>
</main><!-- End #main -->

<?php
include_once "./Layouts/footer.php";
?>