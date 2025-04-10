<?php
$side = "Suplayer";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_suplayer.php";

$suplayerController = new SuplayerController();
$suplayer_barang = $suplayerController->getDataSuplayer();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Suplayer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Suplayer</a></li>
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
                  <th class="text-center">Nama Suplayer</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Telepon</th>
                </tr>
              </thead>
              <?php $no = 1; ?>
              <tbody>
                <?php if (!empty($suplayer_barang)): ?>
                  <?php foreach ($suplayer_barang as $suplayer) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= htmlspecialchars($suplayer['nama_suplayer']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($suplayer['alamat']) ?></td>
                      <td class="text-center"><?= htmlspecialchars($suplayer['telepon']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center">Tidak ada data Suplayer.</td>
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