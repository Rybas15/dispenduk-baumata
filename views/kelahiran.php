<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kelahiran";
$_SESSION["page-url"] = "kelahiran";
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
                      <h3>Kelahiran</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="tambah-kelahiran" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-plus"></i> Tambah</a>
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
                            <th scope="col" class="text-center">NIK</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">TTL</th>
                            <th scope="col" class="text-center">Nama Ayah</th>
                            <th scope="col" class="text-center">Nama Ibu</th>
                            <th scope="col" class="text-center">Pelapor</th>
                            <th scope="col" class="text-center">Hubungan Pelapor</th>
                            <th scope="col" class="text-center">Tgl Buat</th>
                            <th scope="col" class="text-center">Tgl Ubah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_kelahiran) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_kelahiran)) {
                              $tgl_lahir = date_create($row["tgl_lahir"]);
                              $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td><?= $row["nik"] ?></td>
                                <td><?= $row["nama_kelahiran"] ?></td>
                                <td><?= $row["jenis_kelamin"] ?></td>
                                <td><?= $row["tempat_lahir"] . ', ' . $tgl_lahir ?></td>
                                <td><?= $row["nama_ayah"] ?></td>
                                <td><?= $row["nama_ibu"] ?></td>
                                <td><?= $row["pelapor"] ?></td>
                                <td><?= $row["hubungan_pelapor"] ?></td>
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
                                <td class="d-flex justify-content-center text-center">
                                  <div class="col">
                                    <a href="detail-penduduk?id=<?= $row['id_penduduk'] ?>" class="btn btn-success btn-sm text-white rounded-0 border-0 p-2"><i class="bi bi-eye"></i> Detail</a>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_kelahiran"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_kelahiran"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_kelahiran"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nama_kelahiran" class="form-label">Nama Kelahiran <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_kelahiran" value="<?php if (isset($_POST['nama_kelahiran'])) {
                                                                                                  echo $_POST['nama_kelahiran'];
                                                                                                } else {
                                                                                                  echo $row['nama_kelahiran'];
                                                                                                } ?>" class="form-control text-center" id="nama_kelahiran" minlength="3" placeholder="Nama Kelahiran" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_jenis_kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                                                <select name="id_jenis_kelamin" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_jenis_kelamin'] ?>"><?= $row['jenis_kelamin'] ?></option>
                                                  <?php $id_jenis_kelamin = $row['id_jenis_kelamin'];
                                                  $select_jenis_kelamin = "SELECT * FROM jenis_kelamin WHERE id_jenis_kelamin!='$id_jenis_kelamin'";
                                                  $selectJenisKelamin = mysqli_query($conn, $select_jenis_kelamin);
                                                  foreach ($selectJenisKelamin as $row_sjk) { ?>
                                                    <option value="<?= $row_sjk['id_jenis_kelamin'] ?>"><?= $row_sjk['jenis_kelamin'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                                                <input type="text" name="tempat_lahir" value="<?php if (isset($_POST['tempat_lahir'])) {
                                                                                                echo $_POST['tempat_lahir'];
                                                                                              } else {
                                                                                                echo $row['tempat_lahir'];
                                                                                              } ?>" class="form-control text-center" id="tempat_lahir" placeholder="Tempat Lahir" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                                                <input type="date" name="tgl_lahir" value="<?php if (isset($_POST['tgl_lahir'])) {
                                                                                              echo $_POST['tgl_lahir'];
                                                                                            } else {
                                                                                              echo $row['tgl_lahir'];
                                                                                            } ?>" class="form-control text-center" id="tgl_lahir" placeholder="Tanggal Lahir" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_ayah" class="form-label">Nama Ayah <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_ayah" value="<?php if (isset($_POST['nama_ayah'])) {
                                                                                              echo $_POST['nama_ayah'];
                                                                                            } else {
                                                                                              echo $row['nama_ayah'];
                                                                                            } ?>" class="form-control text-center" id="nama_ayah" placeholder="Nama Ayah" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_ibu" class="form-label">Nama Ibu <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_ibu" value="<?php if (isset($_POST['nama_ibu'])) {
                                                                                            echo $_POST['nama_ibu'];
                                                                                          } else {
                                                                                            echo $row['nama_ibu'];
                                                                                          } ?>" class="form-control text-center" id="nama_ibu" placeholder="Nama Ibu" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="pelapor" class="form-label">Pelapor</label>
                                                <input type="text" name="pelapor" value="<?php if (isset($_POST['pelapor'])) {
                                                                                            echo $_POST['pelapor'];
                                                                                          } else {
                                                                                            echo $row['pelapor'];
                                                                                          } ?>" class="form-control text-center" id="pelapor" placeholder="Pelapor">
                                              </div>
                                              <div class="mb-3">
                                                <label for="hubungan_pelapor" class="form-label">Hubungan Pelapor</label>
                                                <input type="text" name="hubungan_pelapor" value="<?php if (isset($_POST['hubungan_pelapor'])) {
                                                                                                    echo $_POST['hubungan_pelapor'];
                                                                                                  } else {
                                                                                                    echo $row['hubungan_pelapor'];
                                                                                                  } ?>" class="form-control text-center" id="hubungan_pelapor" placeholder="Hubungan Pelapor">
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_kelahiran" value="<?= $row["id_kelahiran"] ?>">
                                              <input type="hidden" name="nama_kelahiranOld" value="<?= $row["nama_kelahiran"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-kelahiran" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_kelahiran"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_kelahiran"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_kelahiran"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_kelahiran" value="<?= $row["id_kelahiran"] ?>">
                                              <button type="submit" name="hapus-kelahiran" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>