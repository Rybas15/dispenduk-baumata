<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Tambah Penduduk";
$_SESSION["page-url"] = "tambah-penduduk";
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
                      <h3>Tambah Penduduk</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="penduduk" class="btn btn-primary text-white rounded-0 shadow me-0"> Kembali</a>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="card rounded-0 mt-3">
                        <div class="card-header">
                          <div class="card-title my-auto">
                            <h4>Pilih Kartu Keluarga</h4>
                          </div>
                        </div>
                        <div class="card-body table-responsive">
                          <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">No. Kartu Keluarga</th>
                                <th scope="col" class="text-center">Nama Lengkap</th>
                                <th scope="col" class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (mysqli_num_rows($view_kartu_keluarga) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($view_kartu_keluarga)) { ?>
                                  <tr>
                                    <th scope="row" class="text-center"><?= $no; ?></th>
                                    <td class="text-center"><?= $row["no_kk"] ?></td>
                                    <td><?= $row["nama_lengkap"] ?></td>
                                    <td class="d-flex justify-content-center text-center">
                                      <div class="col">
                                        <form action="" method="POST">
                                          <input type="hidden" name="id_kk" value="<?= $row["id_kk"] ?>">
                                          <button type="submit" name="insert-penduduk" class="btn btn-success btn-sm rounded-0 text-white border-0" style="height: 30px;">Submit</button>
                                        </form>
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
                    <div class="col-lg-4">
                      <?php if (isset($_POST['insert-penduduk'])) {
                        $id_kk = valid($_POST['id_kk']);
                        $take_kk = "SELECT * FROM kartu_keluarga WHERE id_kk='$id_kk'";
                        $takeKK = mysqli_query($conn, $take_kk);
                        if (mysqli_num_rows($takeKK) > 0) {
                          $row_kk = mysqli_fetch_assoc($takeKK); ?>
                          <div class="card rounded-0 mt-3">
                            <div class="card-header text-center">
                              <div class="card-title">
                                <h4>Masukan Data Penduduk</h4>
                              </div>
                            </div>
                            <form action="" method="post">
                              <div class="card-body">
                                <div class="mb-3">
                                  <label for="no_kk" class="form-label">No. Kartu Keluarga <small class="text-danger">*</small></label>
                                  <input type="text" name="no_kk" value="<?= $row_kk['no_kk'] ?>" class="form-control text-center" id="no_kk" minlength="16" placeholder="No. Kartu Keluarga" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                  <input type="number" name="nik" value="<?php if (isset($_POST['nik'])) {
                                                                          echo $_POST['nik'];
                                                                        } ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_kk" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                                  <input type="text" name="nama_kk" value="<?php if (isset($_POST['nama_kk'])) {
                                                                              echo $_POST['nama_kk'];
                                                                            } ?>" class="form-control text-center" id="nama_kk" minlength="3" placeholder="Nama Lengkap" required>
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
                                <div class="mb-3">
                                  <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">*</small></label>
                                  <input type="text" name="tempat_lahir" value="<?php if (isset($_POST['tempat_lahir'])) {
                                                                                  echo $_POST['tempat_lahir'];
                                                                                } ?>" class="form-control text-center" id="tempat_lahir" placeholder="Tempat Lahir" required>
                                </div>
                                <div class="mb-3">
                                  <label for="tgl_lahir" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                                  <input type="date" name="tgl_lahir" value="<?php if (isset($_POST['tgl_lahir'])) {
                                                                                echo $_POST['tgl_lahir'];
                                                                              } ?>" class="form-control text-center" id="tgl_lahir" placeholder="Tanggal Lahir" required>
                                </div>
                                <div class="mb-3">
                                  <label for="alamat" class="form-label">Alamat</label>
                                  <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                                            echo $_POST['alamat'];
                                                                          } ?>" class="form-control text-center" id="alamat" placeholder="Alamat">
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
                                  <label for="id_pendidikan" class="form-label">Pendidikan <small class="text-danger">*</small></label>
                                  <select name="id_pendidikan" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Pendidikan</option>
                                    <?php foreach ($pendidikans as $row_pendidikan) { ?>
                                      <option value="<?= $row_pendidikan['id_pendidikan'] ?>"><?= $row_pendidikan['status_pendidikan'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="id_status_kawin" class="form-label">Status Perkawinan <small class="text-danger">*</small></label>
                                  <select name="id_status_kawin" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Status Perkawinan</option>
                                    <?php foreach ($statusPerkawinan as $row_sp) { ?>
                                      <option value="<?= $row_sp['id_status_perkawinan'] ?>"><?= $row_sp['status_perkawinan'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="card-footer border-top-0 text-center">
                                <input type="hidden" name="id_kk" value="<?= $row_kk['id_kk'] ?>">
                                <a href="tambah-penduduk" class="btn btn-secondary btn-sm text-dark rounded-0 border-0" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" name="tambah-penduduk" class="btn btn-primary btn-sm text-white rounded-0 border-0">Simpan</button>
                              </div>
                            </form>
                          </div>
                      <?php }
                      } ?>
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