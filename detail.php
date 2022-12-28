<?php

include 'utils.php';
$data = readOne('barang', $_GET['id']);

function content()
{
  global $data;
?>
  <div class="row">
    <div class="col">
      <h1><?= $data['nama'] ?></h1>
      <hr>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <a class="btn btn-primary" href="barang.php">&laquo; Kembali ke daftar barang</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <img src="uploads/<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>" class="img-fluid">
    </div>
    <div class="col-md-6">
      <p><?= $data['deskripsi'] ?></p>
      <p>Stok: <?= $data['stok'] ?></p>
    </div>
  </div>
<?php
}

include 'layout.php';
