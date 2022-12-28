<?php

include 'utils.php';
$data = read('barang');

function content()
{
  global $data;
?>
  <div class="row">
    <div class="col">
      <h1>Daftar Barang</h1>
      <hr>
    </div>
  </div>

  <div class="row">
    <?php foreach ($data as $barang) : ?>
      <div class="col-md-4 mb-3">
        <h5><?= $barang['nama'] ?></h5>
        <div class="card">
          <img src="uploads/<?= $barang['gambar'] ?>" class="card-img-top" alt="">
          <div class="card-body">
            <p class="card-text"><?= $barang['deskripsi'] ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>


<?php
}

include 'layout.php';
