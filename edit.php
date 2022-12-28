<?php

include 'utils.php';
$data = readOne('barang', $_GET['id']);

function content()
{
  global $data;
?>
  <div class="row">
    <div class="col">
      <h1>Edit: <?= $data['nama'] ?></h1>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <form action="crud/update.php" method="post" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?= $data['id'] ?>">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input value="<?= $data['nama'] ?>" type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"><?= $data['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
          <label for="stok" class="form-label">Stok</label>
          <input value="<?= $data['stok'] ?>" type="number" class="form-control" id="stok" name="stok" placeholder="Stok">
        </div>
        <div class="mb-3">
          <img src="uploads/<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>" class="img-fluid" style="height: 200px;">
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input type="file" accept="image/*" class="form-control" id="gambar" placeholder="Stok">
        </div>
        <a href="barang.php" class="btn btn-outline-danger">Batal</a>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
      </form>
    <?php
  }

  include 'layout.php';
