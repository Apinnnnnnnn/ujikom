<?php
require_once '../Models/m_toko.php';

class TokoController
{
  public function getTokoById($id_toko)
  {
    $toko = new Toko();
    return $toko->getTokoById($id_toko);
  }

  public function getDataToko()
  {
    $toko = new Toko();
    $toko_barang = $toko->getAllToko();

    return $toko_barang;
  }
}
