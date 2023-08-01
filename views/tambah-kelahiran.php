<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Tambah Kelahiran";
$_SESSION["page-url"] = "tambah-kelahiran";
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
                      <h3>Tambah Kelahiran</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="kelahiran" class="btn btn-primary text-white rounded-0 shadow me-0"> Kembali</a>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="card rounded-0 mt-3">
                        <div class="card-header">
                          <div class="card-title my-auto">
                            <h4>Pilih Penduduk</h4>
                          </div>
                        </div>
                        <div class="card-body table-responsive">
                          <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">NIK</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (mysqli_num_rows($view_penduduk_to_kelahiran) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($view_penduduk_to_kelahiran)) { ?>
                                  <tr>
                                    <th scope="row" class="text-center"><?= $no; ?></th>
                                    <td class="text-center"><?= $row["nik"] ?></td>
                                    <td><?= $row["nama_kk"] ?></td>
                                    <td class="d-flex justify-content-center text-center">
                                      <div class="col">
                                        <form action="" method="GET">
                                          <input type="hidden" name="id" value="<?= $row["id_penduduk"] ?>">
                                          <button type="submit" class="btn btn-success btn-sm rounded-0 text-white border-0" style="height: 30px;">Submit</button>
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
                      <?php if (isset($_GET['id'])) {
                        $id_penduduk = valid($_GET['id']);
                        $take_penduduk = "SELECT * FROM penduduk WHERE id_penduduk='$id_penduduk'";
                        $takePenduduk = mysqli_query($conn, $take_penduduk);
                        if (mysqli_num_rows($takePenduduk) > 0) {
                          $row_penduduk = mysqli_fetch_assoc($takePenduduk); ?>
                          <div class="card rounded-0 mt-3">
                            <div class="card-header text-center">
                              <div class="card-title">
                                <h4>Masukan Data Kelahiran</h4>
                              </div>
                            </div>
                            <form action="" method="post">
                              <div class="card-body">
                                <div class="mb-3">
                                  <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                  <input type="number" name="nik" value="<?= $row_penduduk['nik'] ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_kelahiran" class="form-label">Nama Kelahiran <small class="text-danger">*</small></label>
                                  <input type="text" name="nama_kelahiran" value="<?php if (isset($_POST['nama_kelahiran'])) {
                                                                              echo $_POST['nama_kelahiran'];
                                                                            }else{
                                                                              echo $row_penduduk['nama_kk'];
                                                                            } ?>" class="form-control text-center" id="nama_kelahiran" minlength="3" placeholder="Nama Kelahiran" required>
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
                                  <label for="nama_ayah" class="form-label">Nama Ayah <small class="text-danger">*</small></label>
                                  <input type="text" name="nama_ayah" value="<?php if (isset($_POST['nama_ayah'])) {
                                                                            echo $_POST['nama_ayah'];
                                                                          } ?>" class="form-control text-center" id="nama_ayah" placeholder="Nama Ayah" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_ibu" class="form-label">Nama Ibu <small class="text-danger">*</small></label>
                                  <input type="text" name="nama_ibu" value="<?php if (isset($_POST['nama_ibu'])) {
                                                                            echo $_POST['nama_ibu'];
                                                                          } ?>" class="form-control text-center" id="nama_ibu" placeholder="Nama Ibu" required>
                                </div>
                                <div class="mb-3">
                                  <label for="pelapor" class="form-label">Pelapor</label>
                                  <input type="text" name="pelapor" value="<?php if (isset($_POST['pelapor'])) {
                                                                            echo $_POST['pelapor'];
                                                                          } ?>" class="form-control text-center" id="pelapor" placeholder="Pelapor">
                                </div>
                                <div class="mb-3">
                                  <label for="hubungan_pelapor" class="form-label">Hubungan Pelapor</label>
                                  <input type="text" name="hubungan_pelapor" value="<?php if (isset($_POST['hubungan_pelapor'])) {
                                                                            echo $_POST['hubungan_pelapor'];
                                                                          } ?>" class="form-control text-center" id="hubungan_pelapor" placeholder="Hubungan Pelapor">
                                </div>
                              </div>
                              <div class="card-footer border-top-0 text-center">
                                <input type="hidden" name="id_penduduk" value="<?= $row_penduduk['id_penduduk'] ?>">
                                <a href="tambah-kelahiran" class="btn btn-secondary btn-sm text-dark rounded-0 border-0" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" name="tambah-kelahiran" class="btn btn-primary btn-sm text-white rounded-0 border-0">Simpan</button>
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