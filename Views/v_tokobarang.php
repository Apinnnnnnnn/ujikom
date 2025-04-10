<?php
$side = "Toko";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_toko.php";

$tokoController = new TokoController();
$toko_barang = $tokoController->getDataToko();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Toko</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Toko</a></li>
      </ol>
    </nav>
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
                  <th class="text-center">Nama Toko</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Telepon</th>
                </tr>
              </thead>
              <?php $no = 1; ?>
              <tbody>
                <?php if (!empty($toko_barang)): ?>
                  <?php foreach ($toko_barang as $toko) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= htmlspecialchars($toko['nama_toko']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($toko['alamat']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($toko['telepon']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Tidak Ada Data Toko.</td>
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

<?php
include_once "./Layouts/footer.php";
?>