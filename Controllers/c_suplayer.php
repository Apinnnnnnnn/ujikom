<?php
require_once '../Models/m_suplayer.php';

class SuplayerController
{
  public function getSuplayerById($id_suplayer)
  {
    $suplayer = new Suplayer();
    return $suplayer->getSuplayerById($id_suplayer);
  }

  public function getDataSuplayer()
  {
    $suplayer = new Suplayer();
    $suplayer_barang = $suplayer->getAllSuplayer();

    return $suplayer_barang;
  }
}
