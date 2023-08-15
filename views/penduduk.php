<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Penduduk";
$_SESSION["page-url"] = "penduduk";
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
                      <h3>Penduduk</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="tambah-penduduk" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-plus"></i> Tambah</a>
                      <a href="export-penduduk" target="_blank" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-export"></i> Cetak</a>
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
                            <th scope="col" class="text-center">No. Kartu Keluarga</th>
                            <th scope="col" class="text-center">NIK</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">TTL</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">Pekerjaan</th>
                            <th scope="col" class="text-center">Pendidikan</th>
                            <th scope="col" class="text-center">Status Perkawinan</th>
                            <th scope="col" class="text-center">Tgl Buat</th>
                            <th scope="col" class="text-center">Tgl Ubah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_penduduk) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_penduduk)) {
                              $tgl_lahir = date_create($row["tgl_lahir"]);
                              $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td class="text-center"><?= $row["no_kk"] ?></td>
                                <td><?= $row["nik"] ?></td>
                                <td><?= $row["nama_kk"] ?></td>
                                <td><?= $row["jenis_kelamin"] ?></td>
                                <td><?= $row["tempat_lahir"] . ', ' . $tgl_lahir ?></td>
                                <td><?= $row["alamat"] ?></td>
                                <td><?= $row["pekerjaan"] ?></td>
                                <td><?= $row["status_pendidikan"] ?></td>
                                <td><?= $row["status_perkawinan"] ?></td>
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
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_penduduk"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_penduduk"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nik"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                                <input type="number" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                                                          echo $_POST['nik'];
                                                                                        } else {
                                                                                          echo $row['nik'];
                                                                                        } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_kk" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_kk" value="<?php if (isset($_POST['nama_kk'])) {
                                                                                            echo $_POST['nama_kk'];
                                                                                          } else {
                                                                                            echo $row['nama_kk'];
                                                                                          } ?>" class="form-control text-center" id="nama_kk" minlength="3" placeholder="Nama Lengkap" required>
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
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                                          echo $_POST['alamat'];
                                                                                        } else {
                                                                                          echo $row['alamat'];
                                                                                        } ?>" class="form-control text-center" id="alamat" placeholder="Alamat">
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
                                              <div class="mb-3">
                                                <label for="id_pekerjaan" class="form-label">Pekerjaan <small class="text-danger">*</small></label>
                                                <select name="id_pekerjaan" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_pekerjaan'] ?>"><?= $row['pekerjaan'] ?></option>
                                                  <?php $id_pekerjaan = $row['id_pekerjaan'];
                                                  $select_pekerjaan = "SELECT * FROM pekerjaan WHERE id_pekerjaan!='$id_pekerjaan'";
                                                  $selectPekerjaan = mysqli_query($conn, $select_pekerjaan);
                                                  foreach ($selectPekerjaan as $row_spekerjaan) { ?>
                                                    <option value="<?= $row_spekerjaan['id_pekerjaan'] ?>"><?= $row_spekerjaan['pekerjaan'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_pendidikan" class="form-label">Pendidikan <small class="text-danger">*</small></label>
                                                <select name="id_pendidikan" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_pendidikan'] ?>"><?= $row['status_pendidikan'] ?></option>
                                                  <?php $id_pendidikan = $row['id_pendidikan'];
                                                  $select_pendidikan = "SELECT * FROM pendidikan WHERE id_pendidikan!='$id_pendidikan'";
                                                  $selectPendidikan = mysqli_query($conn, $select_pendidikan);
                                                  foreach ($selectPendidikan as $row_spendidikan) { ?>
                                                    <option value="<?= $row_spendidikan['id_pendidikan'] ?>"><?= $row_spendidikan['status_pendidikan'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_status_kawin" class="form-label">Status Perkawinan <small class="text-danger">*</small></label>
                                                <select name="id_status_kawin" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_status_kawin'] ?>"><?= $row['status_perkawinan'] ?></option>
                                                  <?php $id_status_perkawinan = $row['id_status_kawin'];
                                                  $select_status_perkawinan = "SELECT * FROM status_perkawinan WHERE id_status_perkawinan!='$id_status_perkawinan'";
                                                  $selectStatusPerkawinan = mysqli_query($conn, $select_status_perkawinan);
                                                  foreach ($selectStatusPerkawinan as $row_ssp) { ?>
                                                    <option value="<?= $row_ssp['id_status_perkawinan'] ?>"><?= $row_ssp['status_perkawinan'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_penduduk" value="<?= $row["id_penduduk"] ?>">
                                              <input type="hidden" name="nikOld" value="<?= $row["nik"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-penduduk" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_penduduk"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_penduduk"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nik"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_penduduk" value="<?= $row["id_penduduk"] ?>">
                                              <button type="submit" name="hapus-penduduk" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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