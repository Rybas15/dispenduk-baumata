<?php require_once("../controller/script.php");
require_once("redirect.php");
if (!isset($_GET['id'])) {
  header("Location: penduduk");
  exit;
} else {
  $id = valid($_GET['id']);
  $checkID = "SELECT penduduk.*, kartu_keluarga.no_kk, rt.rt, rt.nama_ketua_rt, rw.rw, rw.nama_ketua_rw, dusun.nama_dusun, dusun.kepala_dusun, jenis_kelamin.jenis_kelamin, pekerjaan.pekerjaan, pendidikan.status_pendidikan, status_perkawinan.status_perkawinan 
                FROM penduduk
                JOIN kartu_keluarga ON penduduk.id_kk=kartu_keluarga.id_kk
                JOIN rt ON penduduk.id_rt=rt.id_rt
                JOIN rw ON rt.id_rw=rw.id_rw
                JOIN dusun ON rw.id_dusun=dusun.id_dusun
                JOIN jenis_kelamin ON penduduk.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin
                JOIN pekerjaan ON penduduk.id_pekerjaan=pekerjaan.id_pekerjaan
                JOIN pendidikan ON penduduk.id_pendidikan=pendidikan.id_pendidikan
                JOIN status_perkawinan ON penduduk.id_status_kawin=status_perkawinan.id_status_perkawinan 
                WHERE penduduk.id_penduduk='$id'
              ";
  $dataPenduduk = mysqli_query($conn, $checkID);
  if (mysqli_num_rows($dataPenduduk) == 0) {
    header("Location: penduduk");
    exit;
  } else {
    $row = mysqli_fetch_assoc($dataPenduduk);
  }
}
$_SESSION["page-name"] = "Detail Penduduk " . $row['nama_kk'];
$_SESSION["page-url"] = "detail-penduduk";
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
                      <h3>Detail Penduduk</h3>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="penduduk" class="btn btn-primary text-white me-0 border-0 rounded-0 shadow"><i class="mdi mdi-subdirectory-arrow-right"></i> Kembali</a>
                    </div>
                  </div>
                </div>
                <div class="data-main mt-3">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Data Penduduk
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <table class="table table-striped table-hover table-borderless table-sm display">
                            <tbody>
                              <tr>
                                <th scope="col" style="width: 150px;">No. Kartu Keluarga</th>
                                <th class="text-center" style="width: 20px;">:</th>
                                <td><?= $row["no_kk"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">NIK</th>
                                <th>:</th>
                                <td><?= $row["nik"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Nama</th>
                                <th>:</th>
                                <td><?= $row["nama_kk"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Jenis Kelamin</th>
                                <th>:</th>
                                <td><?= $row["jenis_kelamin"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">TTL</th>
                                <th>:</th>
                                <td><?= $row["tempat_lahir"] . ', ' . $tgl_lahir ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Alamat</th>
                                <th>:</th>
                                <td><?= $row["alamat"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Dusun</th>
                                <th>:</th>
                                <td><?= $row["nama_dusun"] . " - Kepala Dusun: " . $row['kepala_dusun'] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">RT/RW</th>
                                <th>:</th>
                                <td style="line-height: 20px;"><?= "RT: " . $row["rt"] . " ( Ketua RT " . $row['nama_ketua_rt'] . " )" ?><br><?= "RW: " . $row["rw"] . " ( Ketua RW " . $row['nama_ketua_rw'] . " )" ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Pekerjaan</th>
                                <th>:</th>
                                <td><?= $row["pekerjaan"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Pendidikan</th>
                                <th>:</th>
                                <td><?= $row["status_pendidikan"] ?></td>
                              </tr>
                              <tr>
                                <th scope="col">Status Perkawinan</th>
                                <th>:</th>
                                <td><?= $row["status_perkawinan"] ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Data Kelahiran
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapsae collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <?php $id_penduduk = $row['id_penduduk'];
                          $checkKelahiran = "SELECT kelahiran.*, jenis_kelamin.jenis_kelamin FROM kelahiran JOIN jenis_kelamin ON kelahiran.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin WHERE kelahiran.id_penduduk='$id_penduduk'";
                          $dataKelahiran = mysqli_query($conn, $checkKelahiran);
                          if (mysqli_num_rows($dataKelahiran) == 0) { ?>
                            <p>Belum ada data Kelahiran. Klik <a href="tambah-kelahiran?id=<?= $row['id_penduduk'] ?>" class="text-decoration-none">disini</a> untuk menambahkan data kelahiran <?= $row['nama_kk'] ?></p>
                          <?php } else if (mysqli_num_rows($dataKelahiran) > 0) {
                            $row_kelahiran = mysqli_fetch_assoc($dataKelahiran);
                            $tgl_lahir = date_create($row_kelahiran["tgl_lahir"]);
                            $tgl_lahir = date_format($tgl_lahir, "d M Y"); ?>
                            <table class="table table-striped table-hover table-borderless table-sm display">
                              <tbody>
                                <tr>
                                  <th scope="col" style="width: 150px;">Nama Kelahiran</th>
                                  <th class="text-center" style="width: 20px;">:</th>
                                  <td><?= $row_kelahiran["nama_kelahiran"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Jenis Kelamin</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["jenis_kelamin"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">TTL</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["tempat_lahir"] . ', ' . $tgl_lahir ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Nama Ayah</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["nama_ayah"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Nama Ibu</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["nama_ibu"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Pelapor</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["pelapor"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Hubungan Pelapor</th>
                                  <th>:</th>
                                  <td><?= $row_kelahiran["hubungan_pelapor"] ?></td>
                                </tr>
                              </tbody>
                            </table>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Data Kematian
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <?php $id_penduduk = $row['id_penduduk'];
                          $checkKematian = "SELECT * FROM kematian WHERE id_penduduk='$id_penduduk'";
                          $dataKematian = mysqli_query($conn, $checkKematian);
                          if (mysqli_num_rows($dataKematian) == 0) { ?>
                            <p>Belum ada data Kematian. Klik <a href="tambah-kematian?id=<?= $row['id_penduduk'] ?>" class="text-decoration-none">disini</a> untuk menambahkan data kematian <?= $row['nama_kk'] ?></p>
                          <?php } else if (mysqli_num_rows($dataKematian) > 0) {
                            $row_kematian = mysqli_fetch_assoc($dataKematian);
                            $tgl_kematian = date_create($row_kematian["tgl_kematian"]);
                            $tgl_kematian = date_format($tgl_kematian, "d M Y"); ?>
                            <table class="table table-striped table-hover table-borderless table-sm display">
                              <tbody>
                                <tr>
                                  <th scope="col" style="width: 150px;">Nama Kematian</th>
                                  <th class="text-center" style="width: 20px;">:</th>
                                  <td><?= $row_kematian["nama_kematian"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">TTK</th>
                                  <th>:</th>
                                  <td><?= $row_kematian["tempat_kematian"] . ', ' . $tgl_kematian ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Umur</th>
                                  <th>:</th>
                                  <td><?= $row_kematian["umur"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Pelapor</th>
                                  <th>:</th>
                                  <td><?= $row_kematian["nama_pelapor"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Hubungan Pelapor</th>
                                  <th>:</th>
                                  <td><?= $row_kematian["hubungan_pelapor"] ?></td>
                                </tr>
                                <tr>
                                  <th scope="col">Sebab Kematian</th>
                                  <th>:</th>
                                  <td><?= $row_kematian["sebab"] ?></td>
                                </tr>
                              </tbody>
                            </table>
                          <?php } ?>
                        </div>
                      </div>
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