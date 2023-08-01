<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "RW";
$_SESSION["page-url"] = "rw";
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
                      <h3>RW</h3>
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
                            <th scope="col" class="text-center">RW</th>
                            <th scope="col" class="text-center">Ketua RW</th>
                            <th scope="col" class="text-center">Dusun</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_rw) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_rw)) { ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td class="text-center"><?= $row["rw"] ?></td>
                                <td><?= $row["nama_ketua_rw"] ?></td>
                                <td style="line-height: 20px;"><?= $row["nama_dusun"] . "<br>Kepala Dusun: " . $row['kepala_dusun'] ?></td>
                                <td class="d-flex justify-content-center text-center">
                                  <div class="col">
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_rw"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_rw"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["rw"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="rw" class="form-label">RW <small class="text-danger">*</small></label>
                                                <input type="number" name="rw" value="<?php if (isset($_POST['rw'])) {
                                                                                        echo $_POST['rw'];
                                                                                      } else {
                                                                                        echo $row['rw'];
                                                                                      } ?>" class="form-control text-center" id="rw" placeholder="RW" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_ketua_rw" class="form-label">Ketua RW <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_ketua_rw" value="<?php if (isset($_POST['nama_ketua_rw'])) {
                                                                                                  echo $_POST['nama_ketua_rw'];
                                                                                                } else {
                                                                                                  echo $row['nama_ketua_rw'];
                                                                                                } ?>" class="form-control text-center" id="nama_ketua_rw" minlength="3" placeholder="Ketua RW" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_dusun" class="form-label">Dusun <small class="text-danger">*</small></label>
                                                <select name="id_dusun" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_dusun'] ?>"><?= $row['nama_dusun'] . ' - Kepala Dusun: ' . $row['kepala_dusun'] ?></option>
                                                  <?php $id_dusun = $row['id_dusun'];
                                                  $select_dusun = "SELECT * FROM dusun WHERE id_dusun!='$id_dusun'";
                                                  $selectDusun = mysqli_query($conn, $select_dusun);
                                                  foreach ($selectDusun as $row_dusun) { ?>
                                                    <option value="<?= $row_dusun['id_dusun'] ?>"><?= $row_dusun['nama_dusun'] . ' - Kepala Dusun: ' . $row_dusun['kepala_dusun'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_rw" value="<?= $row["id_rw"] ?>">
                                              <input type="hidden" name="rwOld" value="<?= $row["rw"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-rw" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_rw"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_rw"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["rw"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_rw" value="<?= $row["id_rw"] ?>">
                                              <button type="submit" name="hapus-rw" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah RW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="rw" class="form-label">RW <small class="text-danger">*</small></label>
                    <input type="number" name="rw" value="<?php if (isset($_POST['rw'])) {
                                                            echo $_POST['rw'];
                                                          } ?>" class="form-control text-center" id="rw" placeholder="RW" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_ketua_rw" class="form-label">Ketua RW <small class="text-danger">*</small></label>
                    <input type="text" name="nama_ketua_rw" value="<?php if (isset($_POST['nama_ketua_rw'])) {
                                                                      echo $_POST['nama_ketua_rw'];
                                                                    } ?>" class="form-control text-center" id="nama_ketua_rw" minlength="3" placeholder="Ketua RW" required>
                  </div>
                  <div class="mb-3">
                    <label for="id_dusun" class="form-label">Dusun <small class="text-danger">*</small></label>
                    <select name="id_dusun" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Dusun</option>
                      <?php foreach ($view_dusun as $row_dusun) { ?>
                        <option value="<?= $row_dusun['id_dusun'] ?>"><?= $row_dusun['nama_dusun'] . ' - Kepala Dusun: ' . $row_dusun['kepala_dusun'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-rw" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>