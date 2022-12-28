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
    <div class="col">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Tambah Barang
      </button>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Stok</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($data as $barang) :
          ?>
            <tr>
              <th scope="row"><?= $no ?></th>
              <td><?= $barang['nama'] ?></td>
              <td><?= $barang['stok'] ?></td>
              <td><img src="uploads/<?= $barang['gambar'] ?>" alt="<?= $barang['nama'] ?>" width="100"></td>
              <td>
                <a href="detail.php?id=<?= $barang['id'] ?>" class="badge bg-info"><i class="bi bi-eye"></i></a>
                <a href="edit.php?id=<?= $barang['id'] ?>" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                <a href="crud/destroy.php?id=<?= $barang['id'] ?>" class="badge bg-danger"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
          <?php
            $no++;
          endforeach;
          ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
}

function modal()
{
?>
  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="crud/store.php" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok">
            </div>
            <div class="mb-3">
              <label for="gambar" class="form-label">Gambar</label>
              <input type="file" accept="image/*" class="form-control" id="gambar" name="gambar" placeholder="Stok">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php
}

include 'layout.php';
