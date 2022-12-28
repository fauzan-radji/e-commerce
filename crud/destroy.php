<?php
include "../utils.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  unset($_GET['id']);

  (delete('barang', $id))
    ? setSuccess("Data berhasil dihapus")
    : setError("Data gagal dihapus");
}

redirect('../barang.php');
