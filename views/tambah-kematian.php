<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Tambah Kematian";
$_SESSION["page-url"] = "tambah-kematian";
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
                      <h3>Tambah Kematian</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="kematian" class="btn btn-primary text-white rounded-0 shadow me-0"> Kembali</a>
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
                              <?php if (mysqli_num_rows($view_penduduk_to_kematian) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($view_penduduk_to_kematian)) { ?>
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
                                <h4>Masukan Data Kematian</h4>
                              </div>
                            </div>
                            <form action="" method="post">
                              <div class="card-body">
                                <div class="mb-3">
                                  <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                                  <input type="number" name="nik" value="<?= $row_penduduk['nik'] ?>" class="form-control text-center" id="nik" minlength="16" placeholder="NIK" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_kematian" class="form-label">Nama Kematian <small class="text-danger">*</small></label>
                                  <input type="text" name="nama_kematian" value="<?php if (isset($_POST['nama_kematian'])) {
                                                                                    echo $_POST['nama_kematian'];
                                                                                  } else {
                                                                                    echo $row_penduduk['nama_kk'];
                                                                                  } ?>" class="form-control text-center" id="nama_kematian" minlength="3" placeholder="Nama Kematian" required>
                                </div>
                                <div class="mb-3">
                                  <label for="tempat_kematian" class="form-label">Tempat <small class="text-danger">*</small></label>
                                  <input type="text" name="tempat_kematian" value="<?php if (isset($_POST['tempat_kematian'])) {
                                                                                      echo $_POST['tempat_kematian'];
                                                                                    } ?>" class="form-control text-center" id="tempat_kematian" placeholder="Tempat" required>
                                </div>
                                <div class="mb-3">
                                  <label for="tgl_kematian" class="form-label">Tanggal <small class="text-danger">*</small></label>
                                  <input type="date" name="tgl_kematian" value="<?php if (isset($_POST['tgl_kematian'])) {
                                                                                  echo $_POST['tgl_kematian'];
                                                                                } ?>" class="form-control text-center" id="tgl_kematian" placeholder="Tanggal" required>
                                </div>
                                <div class="mb-3">
                                  <label for="umur" class="form-label">Umur  <small class="text-danger">*</small></label>
                                  <input type="text" name="umur" value="<?php if (isset($_POST['umur'])) {
                                                                          echo $_POST['umur'];
                                                                        } ?>" class="form-control text-center" id="umur" placeholder="Umur" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_pelapor" class="form-label">Pelapor</label>
                                  <input type="text" name="nama_pelapor" value="<?php if (isset($_POST['nama_pelapor'])) {
                                                                                  echo $_POST['nama_pelapor'];
                                                                                } ?>" class="form-control text-center" id="nama_pelapor" placeholder="Pelapor">
                                </div>
                                <div class="mb-3">
                                  <label for="hubungan_pelapor" class="form-label">Hubungan Pelapor</label>
                                  <input type="text" name="hubungan_pelapor" value="<?php if (isset($_POST['hubungan_pelapor'])) {
                                                                                      echo $_POST['hubungan_pelapor'];
                                                                                    } ?>" class="form-control text-center" id="hubungan_pelapor" placeholder="Hubungan Pelapor">
                                </div>
                                <div class="mb-3">
                                  <label for="sebab" class="form-label">Sebab</label>
                                  <input type="text" name="sebab" value="<?php if (isset($_POST['sebab'])) {
                                                                            echo $_POST['sebab'];
                                                                          } ?>" class="form-control text-center" id="sebab" placeholder="Sebab">
                                </div>
                              </div>
                              <div class="card-footer border-top-0 text-center">
                                <input type="hidden" name="id_penduduk" value="<?= $row_penduduk['id_penduduk'] ?>">
                                <a href="tambah-kematian" class="btn btn-secondary btn-sm text-dark rounded-0 border-0" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" name="tambah-kematian" class="btn btn-primary btn-sm text-white rounded-0 border-0">Simpan</button>
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