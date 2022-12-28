<?php
include '../utils.php';

if (isset($_POST['submit'])) {
  unset($_POST['submit']);

  $_POST['gambar'] = uploadFile($_FILES['gambar'], '../uploads/', '../barang.php');

  (create('barang', $_POST, "ssns"))
    ? setSuccess("Data berhasil diinput")
    : setError("Data gagal diinput");
}

redirect('../barang.php');
