<?php
$side = "Distribusi";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_distribusi.php";
require_once "../Controllers/c_databarang.php";
require_once "../Controllers/c_toko.php";

$distribusiController = new DistribusiController();
$barangController = new BarangController();
$tokoController = new TokoController();

$data_barang = $barangController->getDataBarang();
$data_toko = $tokoController->getDataToko();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Tambah Distribusi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="v_distribusibarang.php">Distribusi</a></li>
        <li class="breadcrumb-item active">Tambah Distribusi</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <form action="../Controllers/c_distribusi.php?action=tambah" method="POST">
          <div>
            <label class="form-label mt-4">Nama Barang</label>
            <select name="nama_barang" class="form-select" required>
              <option disabled selected>Pilih Barang</option>
              <?php foreach ($data_barang as $barang) : ?>
                <option value="<?= $barang['nama_barang']; ?>"><?= $barang['nama_barang']; ?> (Stok: <?= $barang['jumlah_barang']; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah_distribusi" class="form-control" required>
          </div>

          <div>
            <label class="form-label">Tujuan (Toko)</label>
            <select name="tujuan" class="form-select" required>
              <option disabled selected>Pilih Toko Tujuan</option>
              <?php foreach ($data_toko as $toko) : ?>
                <option value="<?= $toko['nama_toko']; ?>"><?= $toko['nama_toko']; ?> - <?= $toko['alamat']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label class="form-label">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" class="form-control" required>
          </div>

          <br>
          <button type="submit" class="btn btn-success">Tambah</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include_once "./Layouts/footer.php"; ?>