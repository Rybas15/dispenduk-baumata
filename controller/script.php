<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("functions.php");
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/dispenduk-baumata/";

if (!isset($_SESSION["data-user"])) {
  if (isset($_POST["masuk"])) {
    if (masuk($_POST, $conn) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["data-user"])) {
  $idUser = valid($_SESSION["data-user"]["id"]);
  $jenis_kelamin = "SELECT * FROM jenis_kelamin";
  $jenisKelamin = mysqli_query($conn, $jenis_kelamin);
  $agama = "SELECT * FROM agama";
  $agamas = mysqli_query($conn, $agama);
  $status_keluarga = "SELECT * FROM status_keluarga";
  $statusKeluarga = mysqli_query($conn, $status_keluarga);
  $pendidikan = "SELECT * FROM pendidikan";
  $pendidikans = mysqli_query($conn, $pendidikan);
  $pekerjaan = "SELECT * FROM pekerjaan";
  $pekerjaans = mysqli_query($conn, $pekerjaan);
  $status_perkawinan = "SELECT * FROM status_perkawinan";
  $statusPerkawinan = mysqli_query($conn, $status_perkawinan);

  $count_kk = "SELECT * FROM kartu_keluarga";
  $count_kk = mysqli_query($conn, $count_kk);
  $countKK = mysqli_num_rows($count_kk);
  $count_penduduk = "SELECT * FROM penduduk";
  $count_penduduk = mysqli_query($conn, $count_penduduk);
  $countPenduduk = mysqli_num_rows($count_penduduk);
  $count_kelahiran = "SELECT * FROM kelahiran";
  $count_kelahiran = mysqli_query($conn, $count_kelahiran);
  $countKelahiran = mysqli_num_rows($count_kelahiran);
  $count_kematian = "SELECT * FROM kematian";
  $count_kematian = mysqli_query($conn, $count_kematian);
  $countKematian = mysqli_num_rows($count_kematian);

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST["ubah-profile"])) {
    if (edit_profile($conn, $_POST, $idUser) > 0) {
      $_SESSION["message-success"] = "Profil akun anda berhasil di ubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $users = "SELECT users.*, users_role.role FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser'";
  $view_users = mysqli_query($conn, $users);
  $users_role = "SELECT * FROM users_role";
  $select_ur = mysqli_query($conn, $users_role);
  if (isset($_POST["tambah-user"])) {
    if (user($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-user"])) {
    if (user($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["usernameOld"] . " berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-user"])) {
    if (user($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $dusun = "SELECT * FROM dusun";
  $view_dusun = mysqli_query($conn, $dusun);
  if (isset($_POST["tambah-dusun"])) {
    if (dusun($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data dusun berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-dusun"])) {
    if (dusun($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data dusun berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-dusun"])) {
    if (dusun($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data dusun berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $rw = "SELECT rw.*, dusun.nama_dusun, dusun.kepala_dusun FROM rw JOIN dusun ON rw.id_dusun=dusun.id_dusun";
  $view_rw = mysqli_query($conn, $rw);
  if (isset($_POST["tambah-rw"])) {
    if (rw($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data RW berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-rw"])) {
    if (rw($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data RW berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-rw"])) {
    if (rw($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data RW berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $rt = "SELECT rt.*, rw.rw, rw.nama_ketua_rw, dusun.nama_dusun, dusun.kepala_dusun FROM rt JOIN rw ON rt.id_rw=rw.id_rw JOIN dusun ON rw.id_dusun=dusun.id_dusun";
  $view_rt = mysqli_query($conn, $rt);
  if (isset($_POST["tambah-rt"])) {
    if (rt($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data RT berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-rt"])) {
    if (rt($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data RT berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-rt"])) {
    if (rt($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data RT berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    } else {
      $_SESSION["message-warning"] = "Data tidak berhasil dihapus disebabkan masih ada data lainnya yang terhubung.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $kartu_keluarga = "SELECT kartu_keluarga.*, jenis_kelamin.jenis_kelamin, agama.agama, pendidikan.status_pendidikan, pekerjaan.pekerjaan, status_perkawinan.status_perkawinan, status_keluarga.status_keluarga
                      FROM kartu_keluarga 
                      JOIN jenis_kelamin ON kartu_keluarga.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin
                      JOIN agama ON kartu_keluarga.id_agama=agama.id_agama
                      JOIN pendidikan ON kartu_keluarga.id_pendidikan=pendidikan.id_pendidikan
                      JOIN pekerjaan ON kartu_keluarga.id_pekerjaan=pekerjaan.id_pekerjaan
                      JOIN status_perkawinan ON kartu_keluarga.id_status_perkawinan=status_perkawinan.id_status_perkawinan
                      JOIN status_keluarga ON kartu_keluarga.id_status_keluarga=status_keluarga.id_status_keluarga
                    ";
  $view_kartu_keluarga = mysqli_query($conn, $kartu_keluarga);
  if (isset($_POST["tambah-kk"])) {
    if (kartu_keluarga($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data kartu Keluarga berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kk"])) {
    if (kartu_keluarga($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data kartu Keluarga berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kk"])) {
    if (kartu_keluarga($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data kartu Keluarga berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $penduduk = "SELECT penduduk.*, kartu_keluarga.no_kk, rt.rt, rt.nama_ketua_rt, jenis_kelamin.jenis_kelamin, pekerjaan.pekerjaan, pendidikan.status_pendidikan, status_perkawinan.status_perkawinan 
                FROM penduduk
                JOIN kartu_keluarga ON penduduk.id_kk=kartu_keluarga.id_kk
                JOIN rt ON penduduk.id_rt=rt.id_rt
                JOIN jenis_kelamin ON penduduk.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin
                JOIN pekerjaan ON penduduk.id_pekerjaan=pekerjaan.id_pekerjaan
                JOIN pendidikan ON penduduk.id_pendidikan=pendidikan.id_pendidikan
                JOIN status_perkawinan ON penduduk.id_status_kawin=status_perkawinan.id_status_perkawinan
              ";
  $view_penduduk = mysqli_query($conn, $penduduk);
  if (isset($_POST["tambah-penduduk"])) {
    if (penduduk($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data Penduduk berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-penduduk"])) {
    if (penduduk($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data Penduduk berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-penduduk"])) {
    if (penduduk($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data Penduduk berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $penduduk_to_kelahiran = "SELECT * FROM penduduk WHERE NOT EXISTS (SELECT 1 FROM kelahiran WHERE penduduk.id_penduduk=kelahiran.id_penduduk)";
  $view_penduduk_to_kelahiran = mysqli_query($conn, $penduduk_to_kelahiran);
  $kelahiran = "SELECT kelahiran.*, penduduk.nik, jenis_kelamin.jenis_kelamin FROM kelahiran JOIN penduduk ON kelahiran.id_penduduk=penduduk.id_penduduk JOIN jenis_kelamin ON kelahiran.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin";
  $view_kelahiran = mysqli_query($conn, $kelahiran);
  if (isset($_POST["tambah-kelahiran"])) {
    if (kelahiran($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data Kelahiran berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kelahiran"])) {
    if (kelahiran($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data Kelahiran berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kelahiran"])) {
    if (kelahiran($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data Kelahiran berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $penduduk_to_kematian = "SELECT * FROM penduduk WHERE NOT EXISTS (SELECT 1 FROM kematian WHERE penduduk.id_penduduk=kematian.id_penduduk)";
  $view_penduduk_to_kematian = mysqli_query($conn, $penduduk_to_kematian);
  $kematian = "SELECT kematian.*, penduduk.nik FROM kematian JOIN penduduk ON kematian.id_penduduk=penduduk.id_penduduk";
  $view_kematian = mysqli_query($conn, $kematian);
  if (isset($_POST["tambah-kematian"])) {
    if (kematian($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data Kematian berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kematian"])) {
    if (kematian($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data Kematian berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kematian"])) {
    if (kematian($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data Kematian berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $pendatang = "SELECT pendatang.*, dusun.nama_dusun, dusun.kepala_dusun, rw.rw, rw.nama_ketua_rw, rt.rt, rt.nama_ketua_rt 
                  FROM pendatang 
                  JOIN rt ON rt.id_rt=pendatang.id_rt
                  JOIN rw ON rw.id_rw=rt.id_rw
                  JOIN dusun ON dusun.id_dusun=rw.id_dusun
                ";
  $view_pendatang = mysqli_query($conn, $pendatang);
  if (isset($_POST["tambah-pendatang"])) {
    if (pendatang($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data pendatang berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-pendatang"])) {
    if (pendatang($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data pendatang berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-pendatang"])) {
    if (pendatang($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data pendatang berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $pindah = "SELECT * FROM pindah";
  $view_pindah = mysqli_query($conn, $pindah);
  if (isset($_POST["tambah-pindah"])) {
    if (pindah($conn, $_POST, $action = 'insert') > 0) {
      $_SESSION["message-success"] = "Data warga pindahan berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-pindah"])) {
    if (pindah($conn, $_POST, $action = 'update') > 0) {
      $_SESSION["message-success"] = "Data warga pindahan berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-pindah"])) {
    if (pindah($conn, $_POST, $action = 'delete') > 0) {
      $_SESSION["message-success"] = "Data warga pindahan berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
}
