<?php
include "../utils.php";

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  unset($_POST['id']);
  unset($_POST['submit']);

  update('barang', $_POST, $id, "ssnn")
    ? setSuccess("Data berhasil diubah")
    : setError("Data gagal diubah");
}

redirect('../barang.php');
