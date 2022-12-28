<?php
include '_env.php';
session_start();

// Connect To Database
$conn = mysqli_connect(
  env("db_host", "localhost"),
  env("db_user", "root"),
  env("db_pass", ""),
  env("db_name", "wisnu")
);

function env($key, $default = "")
{
  if (!isset(ENV[$key])) return $default;

  return ENV[$key];
}

function uploadFile($file, $target_dir, $redirect)
{
  // upload file
  // $target_dir = "uploads/";
  $target_file = $target_dir . basename($file["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $target_file = $target_dir . uniqid(rand()) . '.' . $imageFileType;
  // Check if image file is a actual image or fake image
  $check = getimagesize($file["tmp_name"]);
  if (!$check) {
    setError("File yang diupload bukan gambar.");
    redirect($redirect);
  }

  // Allow certain file formats
  if (
    $imageFileType !== "jpg" &&
    $imageFileType !== "png" &&
    $imageFileType !== "jpeg" &&
    $imageFileType !== "gif"
  ) {
    setError("Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.");
    redirect($redirect);
  }

  if (!move_uploaded_file($file["tmp_name"], $target_file)) {
    setError("Maaf, terdapat error saat mengupload file.");
    redirect($redirect);
  }

  return basename($target_file);
}

function create($tableName, $data, $dataTypes)
{
  global $conn;

  // string building
  $fields = '(';
  $values = '(';
  $dataTypeIndex = 0;
  foreach ($data as $key => $value) {
    $dataType = $dataTypes[$dataTypeIndex];
    $fields .= $key . ', ';
    $values .= ($dataType === 's' ? "'" : "") . $value . ($dataType === 's' ? "'" : "") . ', ';

    $dataTypeIndex++;
  }
  $fields = substr_replace($fields, ")", -2);
  $values = substr_replace($values, ")", -2);

  return mysqli_query($conn, "INSERT INTO $tableName $fields VALUES $values");
}

function read($tableName, $descending = false, $limit = 0, $offset = 0)
{
  global $conn;
  $query = "SELECT * FROM $tableName";

  if ($descending) $query .= ' ORDER BY id DESC';

  if ($limit > 0) {
    $query .= " LIMIT $limit";

    if ($offset > 0)
      $query .= " OFFSET $offset";
  }

  $result = mysqli_query($conn, $query);
  // converting $result to associative array
  for ($set = []; $row = mysqli_fetch_assoc($result); $set[] = $row);

  return $set;
}

function readOne($tableName, $id)
{
  global $conn;
  $query = "SELECT * FROM $tableName WHERE id = $id";

  $result = mysqli_query($conn, $query);

  return mysqli_fetch_assoc($result);
}

function update($tableName, $data, $id, $dataTypes)
{
  global $conn;

  // string building
  $str = '';
  $dataTypeIndex = 0;
  foreach ($data as $field => $value) {
    $dataType = $dataTypes[$dataTypeIndex];
    if (($dataType === 's' ? "'" : "")) $value = "'$value'";

    $str .= "$field=$value, ";

    $dataTypeIndex++;
  }
  $str = rtrim($str, ", ");

  return mysqli_query($conn, "UPDATE $tableName SET $str WHERE id=$id");
}

function delete($tableName, $id)
{
  global $conn;

  $data = readOne($tableName, $id);
  $file = $data['gambar'];

  if (file_exists('../uploads/' . $file)) unlink('../uploads/' . $file);

  return mysqli_query($conn, "DELETE FROM $tableName WHERE id = $id");
}

function countRow($tableName)
{
  global $conn;
  return mysqli_fetch_assoc(
    mysqli_query(
      $conn,
      "SELECT COUNT(*) AS row_count FROM $tableName"
    )
  )['row_count'];
}

function redirect($page)
{
  header("Location: $page");
}

function setError($errorMessage)
{
  $_SESSION['error'] = $errorMessage;
}

function getError()
{
  if (!isset($_SESSION['error'])) return "";

  $error = $_SESSION['error'];
  unset($_SESSION['error']);
  return $error;
}

function setSuccess($successMessage)
{
  $_SESSION['success'] = $successMessage;
}

function getSuccess()
{
  if (!isset($_SESSION['success'])) return "";

  $success = $_SESSION['success'];
  unset($_SESSION['success']);
  return $success;
}
