<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kartu Keluarga";
$_SESSION["page-url"] = "kartu-keluarga";
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
                      <h3>Kartu Keluarga</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow" data-bs-toggle="modal" data-bs-target="#tambah"><i class="mdi mdi-plus"></i> Tambah</a>
                      <a href="export-kk" target="_blank" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-export"></i> Cetak</a>
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
                            <th scope="col" class="text-center">Nama Lengkap</th>
                            <th scope="col" class="text-center">NIK</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">TTL</th>
                            <th scope="col" class="text-center">No. Paspor</th>
                            <th scope="col" class="text-center">Agama</th>
                            <th scope="col" class="text-center">Pendidikan</th>
                            <th scope="col" class="text-center">Pekerjaan</th>
                            <th scope="col" class="text-center">Status Perkawinan</th>
                            <th scope="col" class="text-center">Status Keluarga</th>
                            <th scope="col" class="text-center">Nama Ayah</th>
                            <th scope="col" class="text-center">Nama Ibu</th>
                            <th scope="col" class="text-center">Tgl Buat</th>
                            <th scope="col" class="text-center">Tgl Ubah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_kartu_keluarga) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_kartu_keluarga)) {
                              $tgl_lahir = date_create($row["tanggal_lahir"]);
                              $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td class="text-center"><?= $row["no_kk"] ?></td>
                                <td><?= $row["nama_lengkap"] ?></td>
                                <td><?= $row["nik"] ?></td>
                                <td><?= $row["jenis_kelamin"] ?></td>
                                <td><?= $row["tempat_lahir"] . ', ' . $tgl_lahir ?></td>
                                <td><?= $row["no_paspor"] ?></td>
                                <td><?= $row["agama"] ?></td>
                                <td><?= $row["status_pendidikan"] ?></td>
                                <td><?= $row["pekerjaan"] ?></td>
                                <td><?= $row["status_perkawinan"] ?></td>
                                <td><?= $row["status_keluarga"] ?></td>
                                <td><?= $row["nama_ayah"] ?></td>
                                <td><?= $row["nama_ibu"] ?></td>
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
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_kk"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_kk"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["no_kk"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="no_kk" class="form-label">No. KK <small class="text-danger">*</small></label>
                                                <input type="number" name="no_kk" value="<?php if (isset($_POST['no_kk'])) {
                                                                                            echo $_POST['no_kk'];
                                                                                          } else {
                                                                                            echo $row['no_kk'];
                                                                                          } ?>" class="form-control text-center" id="no_kk" minlength="16" placeholder="No. KK" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_lengkap" value="<?php if (isset($_POST['nama_lengkap'])) {
                                                                                                echo $_POST['nama_lengkap'];
                                                                                              } else {
                                                                                                echo $row['nama_lengkap'];
                                                                                              } ?>" class="form-control text-center" id="nama_lengkap" minlength="3" placeholder="Nama Lengkap" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                                <input type="text" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                                                        echo $_POST['nik'];
                                                                                      } else {
                                                                                        echo $row['nik'];
                                                                                      } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
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
                                              <div class="row">
                                                <div class="col-lg-6">
                                                  <div class="mb-3">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                                                    <input type="text" name="tempat_lahir" value="<?php if (isset($_POST['tempat_lahir'])) {
                                                                                                    echo $_POST['tempat_lahir'];
                                                                                                  } else {
                                                                                                    echo $row['tempat_lahir'];
                                                                                                  } ?>" class="form-control text-center" id="tempat_lahir" placeholder="Tempat Lahir" required>
                                                  </div>
                                                </div>
                                                <div class="col-lg-6">
                                                  <div class="mb-3">
                                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                                                    <input type="date" name="tanggal_lahir" value="<?php if (isset($_POST['tanggal_lahir'])) {
                                                                                                      echo $_POST['tanggal_lahir'];
                                                                                                    } else {
                                                                                                      echo $row['tanggal_lahir'];
                                                                                                    } ?>" class="form-control text-center" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="mb-3">
                                                <label for="no_paspor" class="form-label">No. Paspor</label>
                                                <input type="text" name="no_paspor" value="<?php if (isset($_POST['no_paspor'])) {
                                                                                              echo $_POST['no_paspor'];
                                                                                            } else {
                                                                                              echo $row['no_paspor'];
                                                                                            } ?>" class="form-control text-center" id="no_paspor" placeholder="No. Paspor">
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_agama" class="form-label">Agama <small class="text-danger">*</small></label>
                                                <select name="id_agama" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_agama'] ?>"><?= $row['agama'] ?></option>
                                                  <?php $id_agama = $row['id_agama'];
                                                  $select_agama = "SELECT * FROM agama WHERE id_agama!='$id_agama'";
                                                  $selectAgama = mysqli_query($conn, $select_agama);
                                                  foreach ($selectAgama as $row_sagama) { ?>
                                                    <option value="<?= $row_sagama['id_agama'] ?>"><?= $row_sagama['agama'] ?></option>
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
                                                <label for="id_status_perkawinan" class="form-label">Status Perkawinan <small class="text-danger">*</small></label>
                                                <select name="id_status_perkawinan" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_status_perkawinan'] ?>"><?= $row['status_perkawinan'] ?></option>
                                                  <?php $id_status_perkawinan = $row['id_status_perkawinan'];
                                                  $select_status_perkawinan = "SELECT * FROM status_perkawinan WHERE id_status_perkawinan!='$id_status_perkawinan'";
                                                  $selectStatusPerkawinan = mysqli_query($conn, $select_status_perkawinan);
                                                  foreach ($selectStatusPerkawinan as $row_ssp) { ?>
                                                    <option value="<?= $row_ssp['id_status_perkawinan'] ?>"><?= $row_ssp['status_perkawinan'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="id_status_keluarga" class="form-label">Status Keluarga <small class="text-danger">*</small></label>
                                                <select name="id_status_keluarga" class="form-select" aria-label="Default select example" required>
                                                  <option selected value="<?= $row['id_status_keluarga'] ?>"><?= $row['status_keluarga'] ?></option>
                                                  <?php $id_status_keluarga = $row['id_status_keluarga'];
                                                  $select_status_keluarga = "SELECT * FROM status_keluarga WHERE id_status_keluarga!='$id_status_keluarga'";
                                                  $selectStatusKeluarga = mysqli_query($conn, $select_status_keluarga);
                                                  foreach ($selectStatusKeluarga as $row_ssk) { ?>
                                                    <option value="<?= $row_ssk['id_status_keluarga'] ?>"><?= $row_ssk['status_keluarga'] ?></option>
                                                  <?php } ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_ayah" class="form-label">Nama Ayah <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_ayah" value="<?php if (isset($_POST['nama_ayah'])) {
                                                                                              echo $_POST['nama_ayah'];
                                                                                            } else {
                                                                                              echo $row['nama_ayah'];
                                                                                            } ?>" class="form-control text-center" id="nama_ayah" minlength="3" placeholder="Nama Ayah" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_ibu" class="form-label">Nama Ibu <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_ibu" value="<?php if (isset($_POST['nama_ibu'])) {
                                                                                            echo $_POST['nama_ibu'];
                                                                                          } else {
                                                                                            echo $row['nama_ibu'];
                                                                                          } ?>" class="form-control text-center" id="nama_ibu" minlength="3" placeholder="Nama Ibu" required>
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_kk" value="<?= $row["id_kk"] ?>">
                                              <input type="hidden" name="no_kkOld" value="<?= $row["no_kk"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-kk" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_kk"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_kk"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["no_kk"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_kk" value="<?= $row["id_kk"] ?>">
                                              <button type="submit" name="hapus-kk" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kartu Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="post">
                <div class="modal-body text-center">
                  <div class="mb-3">
                    <label for="no_kk" class="form-label">No. KK <small class="text-danger">*</small></label>
                    <input type="number" name="no_kk" value="<?php if (isset($_POST['no_kk'])) {
                                                                echo $_POST['no_kk'];
                                                              } ?>" class="form-control text-center" id="no_kk" minlength="16" placeholder="No. KK" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                    <input type="text" name="nama_lengkap" value="<?php if (isset($_POST['nama_lengkap'])) {
                                                                    echo $_POST['nama_lengkap'];
                                                                  } ?>" class="form-control text-center" id="nama_lengkap" minlength="3" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="mb-3">
                    <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                    <input type="text" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                            echo $_POST['nik'];
                                                          } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
                  </div>
                  <div class="mb-3">
                    <label for="id_jenis_kelamin" class="form-label">Jenis Kelamin <small class="text-danger">*</small></label>
                    <select name="id_jenis_kelamin" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Jenis Kelamin</option>
                      <?php foreach ($jenisKelamin as $row_jk) { ?>
                        <option value="<?= $row_jk['id_jenis_kelamin'] ?>"><?= $row_jk['jenis_kelamin'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                        <input type="text" name="tempat_lahir" value="<?php if (isset($_POST['tempat_lahir'])) {
                                                                        echo $_POST['tempat_lahir'];
                                                                      } ?>" class="form-control text-center" id="tempat_lahir" placeholder="Tempat Lahir" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                        <input type="date" name="tanggal_lahir" value="<?php if (isset($_POST['tanggal_lahir'])) {
                                                                          echo $_POST['tanggal_lahir'];
                                                                        } ?>" class="form-control text-center" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="no_paspor" class="form-label">No. Paspor</label>
                    <input type="text" name="no_paspor" value="<?php if (isset($_POST['no_paspor'])) {
                                                                  echo $_POST['no_paspor'];
                                                                } ?>" class="form-control text-center" id="no_paspor" placeholder="No. Paspor">
                  </div>
                  <div class="mb-3">
                    <label for="id_agama" class="form-label">Agama <small class="text-danger">*</small></label>
                    <select name="id_agama" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Agama</option>
                      <?php foreach ($agamas as $row_agama) { ?>
                        <option value="<?= $row_agama['id_agama'] ?>"><?= $row_agama['agama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id_pendidikan" class="form-label">Pendidikan <small class="text-danger">*</small></label>
                    <select name="id_pendidikan" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Pendidikan</option>
                      <?php foreach ($pendidikans as $row_pendidikan) { ?>
                        <option value="<?= $row_pendidikan['id_pendidikan'] ?>"><?= $row_pendidikan['status_pendidikan'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id_pekerjaan" class="form-label">Pekerjaan <small class="text-danger">*</small></label>
                    <select name="id_pekerjaan" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Pekerjaan</option>
                      <?php foreach ($pekerjaans as $row_pekerjaan) { ?>
                        <option value="<?= $row_pekerjaan['id_pekerjaan'] ?>"><?= $row_pekerjaan['pekerjaan'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id_status_perkawinan" class="form-label">Status Perkawinan <small class="text-danger">*</small></label>
                    <select name="id_status_perkawinan" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Status Perkawinan</option>
                      <?php foreach ($statusPerkawinan as $row_sp) { ?>
                        <option value="<?= $row_sp['id_status_perkawinan'] ?>"><?= $row_sp['status_perkawinan'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id_status_keluarga" class="form-label">Status Keluarga <small class="text-danger">*</small></label>
                    <select name="id_status_keluarga" class="form-select" aria-label="Default select example" required>
                      <option selected value="">Pilih Status Keluarga</option>
                      <?php foreach ($statusKeluarga as $row_sk) { ?>
                        <option value="<?= $row_sk['id_status_keluarga'] ?>"><?= $row_sk['status_keluarga'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="nama_ayah" class="form-label">Nama Ayah <small class="text-danger">*</small></label>
                    <input type="text" name="nama_ayah" value="<?php if (isset($_POST['nama_ayah'])) {
                                                                  echo $_POST['nama_ayah'];
                                                                } ?>" class="form-control text-center" id="nama_ayah" minlength="3" placeholder="Nama Ayah" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_ibu" class="form-label">Nama Ibu <small class="text-danger">*</small></label>
                    <input type="text" name="nama_ibu" value="<?php if (isset($_POST['nama_ibu'])) {
                                                                echo $_POST['nama_ibu'];
                                                              } ?>" class="form-control text-center" id="nama_ibu" minlength="3" placeholder="Nama Ibu" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                  <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-kk" class="btn btn-primary btn-sm rounded-0 border-0">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>