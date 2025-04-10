<?php
$side = "Data Barang";
include_once "./Layouts/header.php";
include_once "./Layouts/sidebar.php";
require_once "../Controllers/c_databarang.php";

$controller = new BarangController();
$id_barang = $_GET['id_barang'] ?? null;
$barang = $id_barang ? $controller->getBarangById($id_barang) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_barang = $_POST['nama_barang'];
  $id_suplayer = $_POST['id_suplayer'];
  $jumlah_barang = $_POST['jumlah_barang'];
  $kategori = $_POST['kategori'];
  $tanggal_masuk = $_POST['tanggal_masuk'];

  $controller->editBarang($id_barang, $nama_barang, $id_suplayer, $jumlah_barang, $kategori, $tanggal_masuk);
  echo "<script>alert('Barang berhasil diubah!'); window.location='v_databarang.php';</script>";
  exit();
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="v_databarang.php">Data Barang</a></li>
        <li class="breadcrumb-item active">Edit Barang</li>
      </ol>
    </nav>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <form action="" method="POST">
            <div>
              <label class="form-label mt-4" for="">Nama Barang</label>
              <input type="text" name="nama barang" value="<?php echo $barang['nama_barang'] ?? '' ?>" class="form-control" required>
            </div>
            <div>
              <label for="id_suplayer" class="form-label">Suplayer</label>
              <select class="form-control" id="id_suplayer" name="id_suplayer">
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
              <label class="form-label" for="">Jumlah Barang</label>
              <input type="number" name="jumlah barang" value="<?php echo $barang['jumlah_barang'] ?? '' ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <select id="kategori" name="kategori" class="form-select" required>
                <option value="" disabled>Pilih Kategori</option>
                <option value="makanan_olahan" <?= ($barang['kategori'] == 'Makanan_Olahan') ? 'selected' : '' ?>>Makanan Olahan</option>
                <option value="daging" <?= ($barang['kategori'] == 'Daging') ? 'selected' : '' ?>>Daging</option>
                <option value="buah" <?= ($barang['kategori'] == 'Buah') ? 'selected' : '' ?>>Buah</option>
                <option value="sayur" <?= ($barang['kategori'] == 'Sayur') ? 'selected' : '' ?>>Sayur</option>
              </select>
            </div>
            <div>
              <label class="form-label" for="">Tanggal Masuk</label>
              <input type="date" name="tanggal masuk" value="<?php echo $barang['tanggal_masuk'] ?? '' ?>" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
  </div>
</main>

</section>
<?php
include_once "./Layouts/footer.php";
?>