<?php
$side = "Data Barang";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_databarang.php";

$controller = new BarangController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_barang = $_POST['nama_barang'];
  $id_suplayer = $_POST['id_suplayer'];
  $jumlah_barang = $_POST['jumlah_barang'];
  $kategori = $_POST['kategori'];
  $tanggal_masuk = $_POST['tanggal_masuk'];

  $barangController = new BarangController();
  if ($barangController->tambahBarang($nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk)) {
    echo "<script>alert('Barang berhasil ditambahkan!'); window.location.href = 'v_databarang.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan barang!');</script>";
  }
  exit();
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="v_databarang.php">Data Barang</a></li>
        <li class="breadcrumb-item active">Tambah Barang</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <form action="" method="POST">
          <div>
            <label class="form-label mt-4">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
          </div>
          <div>
            <label for="id_suplayer" class="form-label">Suplayer</label>
            <select class="form-control" id="id_suplayer" name="id_suplayer">
              <option value="" disabled selected>Suplayer</option>
              <?php
              require_once '../Models/m_suplayer.php';
              $suplayerModel = new Suplayer();
              $suplayers = $suplayerModel->getAllSuplayer();
              foreach ($suplayers as $suplayer) {
                echo "<option value='{$suplayer['id_suplayer']}'>{$suplayer['nama_suplayer']}</option>";
              }
              ?>
            </select>
          </div>
          <div>
            <label class="form-label">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select id="kategori" name="kategori" class="form-select" required>
              <option value="" disabled selected>Pilih Kategori</option>
              <option value="makanan_olahan">Makanan Olahan</option>
              <option value="daging">Daging</option>
              <option value="buah">Buah</option>
              <option value="sayur">Sayur</option>
            </select>
          </div>
          <div>
            <label class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" required>
          </div>
          <br>
          <button type="submit" class="btn btn-success">Tambah</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include_once "./Layouts/footer.php"; ?>