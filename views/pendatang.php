<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Pendatang";
$_SESSION["page-url"] = "pendatang";
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
                      <a href="export-pendatang" target="_blank" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-export"></i> Cetak</a>
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
                          <th scope="col" class="text-center">Tgl Menetap</th>
                          <th scope="col" class="text-center">Alamat Asal</th>
                          <th scope="col" class="text-center">Alasan</th>
                          <th scope="col" class="text-center">Dusun</th>
                          <th scope="col" class="text-center">RT/RW</th>
                          <th scope="col" class="text-center">Tgl Buat</th>
                          <th scope="col" class="text-center">Tgl Ubah</th>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($view_pendatang) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($view_pendatang)) {
                            $tgl_menetap = date_create($row["tgl_menetap"]);
                            $tgl_menetap = date_format($tgl_menetap, "d M Y"); ?>
                            <tr>
                              <th scope="row"><?= $no; ?></th>
                              <td><?= $row["nik"] ?></td>
                              <td><?= $row["nama_kk"] ?></td>
                              <td><?= $tgl_menetap ?></td>
                              <td><?= $row["alamat_asal"] ?></td>
                              <td><?= $row["alasan"] ?></td>
                              <td style="line-height: 20px;"><?= "Dusun : " . $row["nama_dusun"] . "<br>Kepala Dusun : " . $row['kepala_dusun'] ?></td>
                              <td style="line-height: 20px;"><?= "RT : " . $row["rt"] . " (Ketua RT " . $row['nama_ketua_rt'] . ")" . "<br>RW : " . $row['rw'] . " (Ketua RW " . $row['nama_ketua_rw'] . ")" ?></td>
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
                                  <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_pendatang"] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row["id_pendatang"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <label for="tgl_menetap" class="form-label">Tgl Menetap <small class="text-danger">*</small></label>
                                              <input type="date" name="tgl_menetap" value="<?php if (isset($_POST['tgl_menetap'])) {
                                                                                              echo $_POST['tgl_menetap'];
                                                                                            } else {
                                                                                              echo $row['tgl_menetap'];
                                                                                            } ?>" class="form-control text-center" id="tgl_menetap" placeholder="Tgl Menetap" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="alamat_asal" class="form-label">Alamat Asal</label>
                                              <input type="text" name="alamat_asal" value="<?php if (isset($_POST['alamat_asal'])) {
                                                                                              echo $_POST['alamat_asal'];
                                                                                            } else {
                                                                                              echo $row['alamat_asal'];
                                                                                            } ?>" class="form-control text-center" id="alamat_asal" placeholder="Alamat Asal">
                                            </div>
                                            <div class="mb-3">
                                              <label for="alasan" class="form-label">Alasan</label>
                                              <input type="text" name="alasan" value="<?php if (isset($_POST['alasan'])) {
                                                                                        echo $_POST['alasan'];
                                                                                      } else {
                                                                                        echo $row['alasan'];
                                                                                      } ?>" class="form-control text-center" id="alasan" placeholder="Alasan">
                                            </div>
                                            <div class="mb-3">
                                              <label for="id_rt" class="form-label">RT <small class="text-danger">*</small></label>
                                              <select name="id_rt" class="form-select" aria-label="Default select example" required>
                                                <option selected value="<?= $row['id_rt'] ?>"><?= $row['rt'] . ' - Ketua RT: ' . $row['nama_ketua_rt'] ?></option>
                                                <?php $id_rt = $row['id_rt'];
                                                $select_rt = "SELECT * FROM rt WHERE id_rt!='$id_rt'";
                                                $selectRT = mysqli_query($conn, $select_rt);
                                                foreach ($selectRT as $row_srt) { ?>
                                                  <option value="<?= $row_srt['id_rt'] ?>"><?= $row_srt['rt'] . ' - Ketua RT: ' . $row_srt['nama_ketua_rt'] ?></option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id_pendatang" value="<?= $row["id_pendatang"] ?>">
                                            <input type="hidden" name="nikOld" value="<?= $row["nik"] ?>">
                                            <input type="hidden" name="tgl_menetapOld" value="<?= $row["tgl_menetap"] ?>">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="ubah-pendatang" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col">
                                  <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_pendatang"] ?>">
                                    <i class="bi bi-trash3"></i>
                                  </button>
                                  <div class="modal fade" id="hapus<?= $row["id_pendatang"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <input type="hidden" name="id_pendatang" value="<?= $row["id_pendatang"] ?>">
                                            <button type="submit" name="hapus-pendatang" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pendatang</h5>
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
                    <label for="tgl_menetap" class="form-label">Tgl Menetap <small class="text-danger">*</small></label>
                    <input type="date" name="tgl_menetap" value="<?php if (isset($_POST['tgl_menetap'])) {
                                                                    echo $_POST['tgl_menetap'];
                                                                  } ?>" class="form-control text-center" id="tgl_menetap" placeholder="Tgl Menetap" required>
                  </div>
                  <div class="mb-3">
                    <label for="alamat_asal" class="form-label">Alamat Asal</label>
                    <input type="text" name="alamat_asal" value="<?php if (isset($_POST['alamat_asal'])) {
                                                                    echo $_POST['alamat_asal'];
                                                                  } ?>" class="form-control text-center" id="alamat_asal" placeholder="Alamat Asal">
                  </div>
                  <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan</label>
                    <input type="text" name="alasan" value="<?php if (isset($_POST['alasan'])) {
                                                              echo $_POST['alasan'];
                                                            } ?>" class="form-control text-center" id="alasan" placeholder="Alasan">
                  </div>
                  <div class="mb-3">
                    <label for="id_rt" class="form-label">RT <small class="text-danger">*</small></label>
                    <select name="id_rt" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih RT</option>
                      <?php foreach ($view_rt as $row_rt) { ?>
                        <option value="<?= $row_rt['id_rt'] ?>"><?= $row_rt['rt'] . ' - Ketua RT: ' . $row_rt['nama_ketua_rt'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-pendatang" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>