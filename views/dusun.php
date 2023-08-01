<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Dusun";
$_SESSION["page-url"] = "dusun";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
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
                      <h3>Dusun</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow" data-bs-toggle="modal" data-bs-target="#tambah"><i class="mdi mdi-plus"></i> Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="card rounded-0 mt-3">
                    <div class="card-body table-responsive">
                      <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Nama Dusun</th>
                            <th scope="col" class="text-center">Kepala Dusun</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_dusun) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_dusun)) { ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td><?= $row["nama_dusun"] ?></td>
                                <td><?= $row["kepala_dusun"] ?></td>
                                <td class="d-flex justify-content-center text-center">
                                  <div class="col">
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_dusun"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_dusun"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_dusun"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nama_dusun" class="form-label">Nama Dusun <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_dusun" value="<?php if (isset($_POST['nama_dusun'])) {
                                                                                              echo $_POST['nama_dusun'];
                                                                                            } else {
                                                                                              echo $row['nama_dusun'];
                                                                                            } ?>" class="form-control text-center" id="nama_dusun" minlength="3" placeholder="Nama Dusun" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="kepala_dusun" class="form-label">Kepala Dusun <small class="text-danger">*</small></label>
                                                <input type="text" name="kepala_dusun" value="<?php if (isset($_POST['kepala_dusun'])) {
                                                                                                echo $_POST['kepala_dusun'];
                                                                                              } else {
                                                                                                echo $row['kepala_dusun'];
                                                                                              } ?>" class="form-control text-center" id="kepala_dusun" minlength="3" placeholder="Kepala Dusun" required>
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_dusun" value="<?= $row["id_dusun"] ?>">
                                              <input type="hidden" name="nama_dusunOld" value="<?= $row["nama_dusun"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-dusun" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_dusun"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_dusun"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_dusun"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_dusun" value="<?= $row["id_dusun"] ?>">
                                              <button type="submit" name="hapus-dusun" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
        </div>

        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header border-bottom-0 shadow">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dusun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="nama_dusun" class="form-label">Nama Dusun <small class="text-danger">*</small></label>
                    <input type="text" name="nama_dusun" value="<?php if (isset($_POST['nama_dusun'])) {
                                                                  echo $_POST['nama_dusun'];
                                                                } ?>" class="form-control text-center" id="nama_dusun" minlength="3" placeholder="Nama Dusun" required>
                  </div>
                  <div class="mb-3">
                    <label for="kepala_dusun" class="form-label">Kepala Dusun <small class="text-danger">*</small></label>
                    <input type="text" name="kepala_dusun" value="<?php if (isset($_POST['kepala_dusun'])) {
                                                                    echo $_POST['kepala_dusun'];
                                                                  } ?>" class="form-control text-center" id="kepala_dusun" minlength="3" placeholder="Kepala Dusun" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-dusun" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>