<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kematian";
$_SESSION["page-url"] = "kematian";
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
                      <h3>Kematian</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="tambah-kematian" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-plus"></i> Tambah</a>
                      <a href="export-kematian" target="_blank" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-export"></i> Cetak</a>
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
                            <th scope="col" class="text-center">TTK</th>
                            <th scope="col" class="text-center">Umur</th>
                            <th scope="col" class="text-center">Pelapor</th>
                            <th scope="col" class="text-center">Hubungan Pelapor</th>
                            <th scope="col" class="text-center">Sebab</th>
                            <th scope="col" class="text-center">Tgl Buat</th>
                            <th scope="col" class="text-center">Tgl Ubah</th>
                            <th scope="col" class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (mysqli_num_rows($view_kematian) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($view_kematian)) {
                              $tgl_kematian = date_create($row["tgl_kematian"]);
                              $tgl_kematian = date_format($tgl_kematian, "d M Y"); ?>
                              <tr>
                                <th scope="row" class="text-center"><?= $no; ?></th>
                                <td><?= $row["nik"] ?></td>
                                <td><?= $row["nama_kematian"] ?></td>
                                <td><?= $row["tempat_kematian"] . ', ' . $tgl_kematian ?></td>
                                <td><?= $row["umur"] ?></td>
                                <td><?= $row["nama_pelapor"] ?></td>
                                <td><?= $row["hubungan_pelapor"] ?></td>
                                <td><?= $row["sebab"] ?></td>
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
                                    <button type="button" class="btn btn-warning btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#ubah<?= $row["id_kematian"] ?>">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="ubah<?= $row["id_kematian"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_kematian"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="" method="POST">
                                            <div class="modal-body text-center">
                                              <div class="mb-3">
                                                <label for="nama_kematian" class="form-label">Nama Kematian <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_kematian" value="<?php if (isset($_POST['nama_kematian'])) {
                                                                                                  echo $_POST['nama_kematian'];
                                                                                                } else {
                                                                                                  echo $row['nama_kematian'];
                                                                                                } ?>" class="form-control text-center" id="nama_kematian" minlength="3" placeholder="Nama Kematian" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="tempat_kematian" class="form-label">Tempat <small class="text-danger">*</small></label>
                                                <input type="text" name="tempat_kematian" value="<?php if (isset($_POST['tempat_kematian'])) {
                                                                                                    echo $_POST['tempat_kematian'];
                                                                                                  } else {
                                                                                                    echo $row['tempat_kematian'];
                                                                                                  } ?>" class="form-control text-center" id="tempat_kematian" placeholder="Tempat" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="tgl_kematian" class="form-label">Tanggal <small class="text-danger">*</small></label>
                                                <input type="date" name="tgl_kematian" value="<?php if (isset($_POST['tgl_kematian'])) {
                                                                                                echo $_POST['tgl_kematian'];
                                                                                              } else {
                                                                                                echo $row['tgl_kematian'];
                                                                                              } ?>" class="form-control text-center" id="tgl_kematian" placeholder="Tanggal" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="umur" class="form-label">Umur <small class="text-danger">*</small></label>
                                                <input type="text" name="umur" value="<?php if (isset($_POST['umur'])) {
                                                                                        echo $_POST['umur'];
                                                                                      } else {
                                                                                        echo $row['umur'];
                                                                                      } ?>" class="form-control text-center" id="umur" placeholder="Umur" required>
                                              </div>
                                              <div class="mb-3">
                                                <label for="nama_pelapor" class="form-label">Pelapor</label>
                                                <input type="text" name="nama_pelapor" value="<?php if (isset($_POST['nama_pelapor'])) {
                                                                                                echo $_POST['nama_pelapor'];
                                                                                              } else {
                                                                                                echo $row['nama_pelapor'];
                                                                                              } ?>" class="form-control text-center" id="nama_pelapor" placeholder="Pelapor">
                                              </div>
                                              <div class="mb-3">
                                                <label for="hubungan_pelapor" class="form-label">Hubungan Pelapor</label>
                                                <input type="text" name="hubungan_pelapor" value="<?php if (isset($_POST['hubungan_pelapor'])) {
                                                                                                    echo $_POST['hubungan_pelapor'];
                                                                                                  } else {
                                                                                                    echo $row['hubungan_pelapor'];
                                                                                                  } ?>" class="form-control text-center" id="hubungan_pelapor" placeholder="Hubungan Pelapor">
                                              </div>
                                              <div class="mb-3">
                                                <label for="sebab" class="form-label">Sebab</label>
                                                <input type="text" name="sebab" value="<?php if (isset($_POST['sebab'])) {
                                                                                          echo $_POST['sebab'];
                                                                                        } else {
                                                                                          echo $row['sebab'];
                                                                                        } ?>" class="form-control text-center" id="sebab" placeholder="Sebab">
                                              </div>
                                            </div>
                                            <div class="modal-footer justify-content-center border-top-0">
                                              <input type="hidden" name="id_kematian" value="<?= $row["id_kematian"] ?>">
                                              <input type="hidden" name="nama_kematianOld" value="<?= $row["nama_kematian"] ?>">
                                              <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" name="ubah-kematian" class="btn btn-warning btn-sm rounded-0 border-0" style="height: 30px;">Ubah</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <button type="button" class="btn btn-danger btn-sm text-white rounded-0 border-0" style="height: 30px;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row["id_kematian"] ?>">
                                      <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="hapus<?= $row["id_kematian"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0 shadow">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_kematian"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                            Anda yakin ingin menghapus data ini?
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <button type="button" class="btn btn-secondary btn-sm rounded-0 border-0" style="height: 30px;" data-bs-dismiss="modal">Batal</button>
                                            <form action="" method="POST">
                                              <input type="hidden" name="id_kematian" value="<?= $row["id_kematian"] ?>">
                                              <button type="submit" name="hapus-kematian" class="btn btn-danger btn-sm rounded-0 text-white border-0" style="height: 30px;">Hapus</button>
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