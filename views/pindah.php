<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Pindah Penduduk";
$_SESSION["page-url"] = "pindah";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body style="font-family: 'Montserrat', sans-serif;">
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <h3><?= $_SESSION["page-name"] ?></h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card rounded-0 mt-3">
                  <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-center">NIK</th>
                          <th scope="col" class="text-center">Nama</th>
                          <th scope="col" class="text-center">Tgl Pindah</th>
                          <th scope="col" class="text-center">Alamat Pindah</th>
                          <th scope="col" class="text-center">Keterangan</th>
                          <th scope="col" class="text-center">Tgl Buat</th>
                          <th scope="col" class="text-center">Tgl Ubah</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($view_pindah) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($view_pindah)) {
                            $tgl_pindah = date_create($row["tgl_pindah"]);
                            $tgl_pindah = date_format($tgl_pindah, "d M Y"); ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $row["nik"] ?></td>
                              <td><?= $row["nama_kk"] ?></td>
                              <td><?= $tgl_pindah ?></td>
                              <td><?= $row["alamat_pindah"] ?></td>
                              <td><?= $row["ket"] ?></td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row["created_at"]);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-warning">
                                  <?php $dateUpdate = date_create($row["updated_at"]);
                                  echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td class="d-flex justify-content-center">
                                <div class="col">
                                  <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_pindah"] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row["id_pindah"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_kk"] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                          <div class="modal-body text-center">
                                            <div class="mb-3">
                                              <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                              <input type="text" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                                                      echo $_POST['nik'];
                                                                                    } else {
                                                                                      echo $row['nik'];
                                                                                    } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="nama_kk" class="form-label">Nama <small class="text-danger">*</small></label>
                                              <input type="text" name="nama_kk" value="<?php if (isset($_POST['nama_kk'])) {
                                                                                          echo $_POST['nama_kk'];
                                                                                        } else {
                                                                                          echo $row['nama_kk'];
                                                                                        } ?>" class="form-control text-center" id="nama_kk" minlength="3" placeholder="Nama" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="tgl_pindah" class="form-label">Tgl Pindah <small class="text-danger">*</small></label>
                                              <input type="date" name="tgl_pindah" value="<?php if (isset($_POST['tgl_pindah'])) {
                                                                                            echo $_POST['tgl_pindah'];
                                                                                          } else {
                                                                                            echo $row['tgl_pindah'];
                                                                                          } ?>" class="form-control text-center" id="tgl_pindah" placeholder="Tgl Pindah" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="alamat_pindah" class="form-label">Alamat Pindah</label>
                                              <input type="text" name="alamat_pindah" value="<?php if (isset($_POST['alamat_pindah'])) {
                                                                                                echo $_POST['alamat_pindah'];
                                                                                              } else {
                                                                                                echo $row['alamat_pindah'];
                                                                                              } ?>" class="form-control text-center" id="alamat_pindah" placeholder="Alamat Pindah">
                                            </div>
                                            <div class="mb-3">
                                              <label for="ket" class="form-label">Keterangan</label>
                                              <input type="text" name="ket" value="<?php if (isset($_POST['ket'])) {
                                                                                      echo $_POST['ket'];
                                                                                    } else {
                                                                                      echo $row['ket'];
                                                                                    } ?>" class="form-control text-center" id="ket" placeholder="Keterangan">
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id_pindah" value="<?= $row["id_pindah"] ?>">
                                            <input type="hidden" name="nikOld" value="<?= $row["nik"] ?>">
                                            <input type="hidden" name="tgl_pindahOld" value="<?= $row["tgl_pindah"] ?>">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="ubah-pindah" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_pindah"] ?>">
                                    <i class="bi bi-trash3"></i>
                                  </button>
                                  <div class="modal fade" id="hapus<?= $row["id_pindah"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0 shadow">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_kk"] ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          Anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                          <form action="" method="POST">
                                            <input type="hidden" name="id_pindah" value="<?= $row["id_pindah"] ?>">
                                            <button type="submit" name="hapus-pindah" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                        <?php $no++;
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pindah Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                    <input type="text" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                            echo $_POST['nik'];
                                                          } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_kk" class="form-label">Nama <small class="text-danger">*</small></label>
                    <input type="text" name="nama_kk" value="<?php if (isset($_POST['nama_kk'])) {
                                                                echo $_POST['nama_kk'];
                                                              } ?>" class="form-control text-center" id="nama_kk" minlength="3" placeholder="Nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="tgl_pindah" class="form-label">Tgl Pindah <small class="text-danger">*</small></label>
                    <input type="date" name="tgl_pindah" value="<?php if (isset($_POST['tgl_pindah'])) {
                                                                  echo $_POST['tgl_pindah'];
                                                                } ?>" class="form-control text-center" id="tgl_pindah" placeholder="Tgl Pindah" required>
                  </div>
                  <div class="mb-3">
                    <label for="alamat_pindah" class="form-label">Alamat Pindah</label>
                    <input type="text" name="alamat_pindah" value="<?php if (isset($_POST['alamat_pindah'])) {
                                                                      echo $_POST['alamat_pindah'];
                                                                    } ?>" class="form-control text-center" id="alamat_pindah" placeholder="Alamat Pindah">
                  </div>
                  <div class="mb-3">
                    <label for="ket" class="form-label">Keterangan</label>
                    <input type="text" name="ket" value="<?php if (isset($_POST['ket'])) {
                                                            echo $_POST['ket'];
                                                          } ?>" class="form-control text-center" id="ket" placeholder="Keterangan">
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-pindah" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>