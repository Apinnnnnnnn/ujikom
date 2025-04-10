<?php
$side = "Data Barang";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_databarang.php";

$barangController = new BarangController();
$data_barang = $barangController->getDataBarang();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="v_databarang.php">Data Barang</a></li>
      </ol>
    </nav>
    <a href="../Views/v_tambahbarang.php" class="btn btn-success mb-3">Tambah Barang</a>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <table class="table mt-4">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Suplayer</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Telepon</th>
                  <th class="text-center">Jumlah Barang</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Tanggal Masuk</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <?php $no = 1; ?>
              <tbody>
                <?php if (!empty($data_barang)): ?>
                  <?php foreach ($data_barang as $barang) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['nama_barang']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['nama_suplayer']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['alamat']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['telepon']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['jumlah_barang']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['kategori']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($barang['tanggal_masuk']) ?></td>
                      <td class="text-center">
                        <a href="v_editbarang.php?id_barang=<?= urlencode($barang['id_barang']) ?>" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a> ♾️
                        <a href="v_hapusbarang.php?id_barang=<?= urlencode($barang['id_barang']) ?>" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Tidak ada data Barang.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include_once "./Layouts/footer.php"; ?>