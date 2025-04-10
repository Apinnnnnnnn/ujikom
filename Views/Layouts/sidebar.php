<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link <?= $side == 'Dashboard' ? '' : 'collapsed'; ?>" href="index.php">
        <i class="bi bi-house-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $side == 'Data Barang' ? '' : 'collapsed'; ?>" href="v_databarang.php">
        <i class="bi bi-box-seam-fill"></i>
        <span>Barang</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $side == 'Suplayer' ? '' : 'collapsed'; ?>" href="v_suplayerbarang.php">
        <i class="bi bi-duffle-fill"></i>
        <span>Suplayer</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $side == 'Distribusi' ? '' : 'collapsed'; ?>" href="v_distribusibarang.php">
        <i class="bi bi-building-fill-down"></i>
        <span>Distribusi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $side == 'Toko' ? '' : 'collapsed'; ?>" href="v_tokobarang.php">
        <i class="bi bi-luggage-fill"></i>
        <span>Toko</span>
      </a>
    </li>
  </ul>
</aside><!-- End Sidebar-->