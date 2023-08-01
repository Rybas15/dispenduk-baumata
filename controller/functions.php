<?php require_once("support_code.php");
if (!isset($_SESSION["data-user"])) {
  function masuk($data, $conn)
  {
    $email = valid($data["email"]);
    $password = valid($data["password"]);

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row["password"])) {
        $_SESSION["data-user"] = [
          "id" => $row["id_user"],
          "role" => $row["id_role"],
          "email" => $row["email"],
          "username" => $row["username"],
        ];
      } else {
        $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
  }
}
if (isset($_SESSION["data-user"])) {
  function edit_profile($conn, $data, $idUser)
  {
    $username = valid($data["username"]);
    $password = valid($data["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function user($conn, $data, $action)
  {
    $username = valid($data["username"]);
    $email = valid($data["email"]);
    $password = valid($data["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $id_role = valid($data["id_role"]);

    if ($action == "insert") {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO users(id_role,username,email,password) VALUES('$id_role','$username','$email','$password')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_user = valid($data["id_user"]);
      $emailOld = valid($data["emailOld"]);
      if ($email != $emailOld) {
        $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
          $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE users SET id_role='$id_role', username='$username', email='$email', updated_at=current_timestamp WHERE id_user='$id_user'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_user = valid($data["id_user"]);
      $sql = "DELETE FROM users WHERE id_user='$id_user'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function dusun($conn, $data, $action)
  {
    $nama_dusun = valid($data['nama_dusun']);
    $kepala_dusun = valid($data['kepala_dusun']);

    if ($action == "insert") {
      $checkDusun = "SELECT * FROM dusun WHERE nama_dusun='$nama_dusun'";
      $resultDusun = mysqli_query($conn, $checkDusun);
      if (mysqli_num_rows($resultDusun) > 0) {
        $_SESSION["message-danger"] = "Maaf, dusun yang anda masukan sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO dusun(nama_dusun,kepala_dusun) VALUES('$nama_dusun','$kepala_dusun')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_dusun = valid($data['id_dusun']);
      $nama_dusunOld = valid($data['nama_dusunOld']);
      if ($nama_dusun != $nama_dusunOld) {
        $checkDusun = "SELECT * FROM dusun WHERE nama_dusun='$nama_dusun'";
        $resultDusun = mysqli_query($conn, $checkDusun);
        if (mysqli_num_rows($resultDusun) > 0) {
          $_SESSION["message-danger"] = "Maaf, dusun yang anda masukan sudah ada.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE dusun SET nama_dusun='$nama_dusun', kepala_dusun='$kepala_dusun' WHERE id_dusun='$id_dusun'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_dusun = valid($data['id_dusun']);
      $sql = "DELETE FROM dusun WHERE id_dusun='$id_dusun'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function rw($conn, $data, $action)
  {
    $id_dusun = valid($data['id_dusun']);
    $rw = valid($data['rw']);
    $nama_ketua_rw = valid($data['nama_ketua_rw']);

    if ($action == "insert") {
      $checkRW = "SELECT * FROM rw WHERE rw='$rw'";
      $resultRW = mysqli_query($conn, $checkRW);
      if (mysqli_num_rows($resultRW) > 0) {
        $_SESSION["message-danger"] = "Maaf, RW yang anda masukan sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO rw(id_dusun,rw,nama_ketua_rw) VALUES('$id_dusun','$rw','$nama_ketua_rw')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_rw = valid($data['id_rw']);
      $rwOld = valid($data['rwOld']);
      if ($rw != $rwOld) {
        $checkRW = "SELECT * FROM rw WHERE rw='$rw'";
        $resultRW = mysqli_query($conn, $checkRW);
        if (mysqli_num_rows($resultRW) > 0) {
          $_SESSION["message-danger"] = "Maaf, RW yang anda masukan sudah ada.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE rw SET id_dusun='$id_dusun', rw='$rw', nama_ketua_rw='$nama_ketua_rw', updated_at=current_timestamp WHERE id_rw='$id_rw'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_rw = valid($data['id_rw']);
      $sql = "DELETE FROM rw WHERE id_rw='$id_rw'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function rt($conn, $data, $action)
  {
    $id_rw = valid($data['id_rw']);
    $rt = valid($data['rt']);
    $nama_ketua_rt = valid($data['nama_ketua_rt']);

    if ($action == "insert") {
      $checkRT = "SELECT * FROM rt WHERE rt='$rt'";
      $resultRT = mysqli_query($conn, $checkRT);
      if (mysqli_num_rows($resultRT) > 0) {
        $_SESSION["message-danger"] = "Maaf, RT yang anda masukan sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO rt(id_rw,rt,nama_ketua_rt) VALUES('$id_rw','$rt','$nama_ketua_rt')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_rt = valid($data['id_rt']);
      $rtOld = valid($data['rtOld']);
      if ($rt != $rtOld) {
        $checkRT = "SELECT * FROM rt WHERE rt='$rt'";
        $resultRT = mysqli_query($conn, $checkRT);
        if (mysqli_num_rows($resultRT) > 0) {
          $_SESSION["message-danger"] = "Maaf, RT yang anda masukan sudah ada.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE rt SET id_rw='$id_rw', rt='$rt', nama_ketua_rt='$nama_ketua_rt', updated_at=current_timestamp WHERE id_rt='$id_rt'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_rt = valid($data['id_rt']);
      $sql = "DELETE FROM rt WHERE id_rt='$id_rt'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function kartu_keluarga($conn, $data, $action)
  {
    $no_kk = valid($data['no_kk']);
    $nama_lengkap = valid($data['nama_lengkap']);
    $nik = valid($data['nik']);
    $id_jenis_kelamin = valid($data['id_jenis_kelamin']);
    $tanggal_lahir = valid($data['tanggal_lahir']);
    $tempat_lahir = valid($data['tempat_lahir']);
    $no_paspor = valid($data['no_paspor']);
    $id_agama = valid($data['id_agama']);
    $id_pendidikan = valid($data['id_pendidikan']);
    $id_pekerjaan = valid($data['id_pekerjaan']);
    $id_status_perkawinan = valid($data['id_status_perkawinan']);
    $id_status_keluarga = valid($data['id_status_keluarga']);
    $nama_ayah = valid($data['nama_ayah']);
    $nama_ibu = valid($data['nama_ibu']);

    if ($action == "insert") {
      $checkKK = "SELECT * FROM kartu_keluarga WHERE no_kk='$no_kk'";
      $resultKK = mysqli_query($conn, $checkKK);
      if (mysqli_num_rows($resultKK) > 0) {
        $_SESSION["message-danger"] = "Maaf, No. Kartu Keluarga yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO kartu_keluarga(no_kk,nama_lengkap,nik,id_jenis_kelamin,tanggal_lahir,tempat_lahir,no_paspor,id_agama,id_pendidikan,id_pekerjaan,id_status_perkawinan,id_status_keluarga,nama_ayah,nama_ibu) VALUES('$no_kk','$nama_lengkap','$nik','$id_jenis_kelamin','$tanggal_lahir','$tempat_lahir','$no_paspor','$id_agama','$id_pendidikan','$id_pekerjaan','$id_status_perkawinan','$id_status_keluarga','$nama_ayah','$nama_ibu')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_kk = valid($data['id_kk']);
      $no_kkOld = valid($data['no_kkOld']);
      if ($no_kk != $no_kkOld) {
        $checkKK = "SELECT * FROM kartu_keluarga WHERE no_kk='$no_kk'";
        $resultKK = mysqli_query($conn, $checkKK);
        if (mysqli_num_rows($resultKK) > 0) {
          $_SESSION["message-danger"] = "Maaf, No. Kartu Keluarga yang anda masukan sudah terdaftar.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE kartu_keluarga SET no_kk='$no_kk', nama_lengkap='$nama_lengkap', nik='$nik', id_jenis_kelamin='$id_jenis_kelamin', tanggal_lahir='$tanggal_lahir', tempat_lahir='$tempat_lahir', no_paspor='$no_paspor', id_agama='$id_agama', id_pendidikan='$id_pendidikan', id_pekerjaan='$id_pekerjaan', id_status_perkawinan='$id_status_perkawinan', id_status_keluarga='$id_status_keluarga', nama_ayah='$nama_ayah', nama_ibu='$nama_ibu', updated_at=current_timestamp WHERE id_kk='$id_kk'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_kk = valid($data['id_kk']);
      $sql = "DELETE FROM kartu_keluarga WHERE id_kk='$id_kk'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function penduduk($conn, $data, $action)
  {
    $id_kk = valid($data['id_kk']);
    $nik = valid($data['nik']);
    $nama_kk = valid($data['nama_kk']);
    $id_jenis_kelamin = valid($data['id_jenis_kelamin']);
    $tempat_lahir = valid($data['tempat_lahir']);
    $tgl_lahir = valid($data['tgl_lahir']);
    $alamat = valid($data['alamat']);
    $id_rt = valid($data['id_rt']);
    $id_pekerjaan = valid($data['id_pekerjaan']);
    $id_pendidikan = valid($data['id_pendidikan']);
    $id_status_kawin = valid($data['id_status_kawin']);

    if ($action == "insert") {
      $checkPenduduk = "SELECT * FROM penduduk WHERE nik='$nik'";
      $resultPenduduk = mysqli_query($conn, $checkPenduduk);
      if (mysqli_num_rows($resultPenduduk) > 0) {
        $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO penduduk(nik,id_kk,id_rt,nama_kk,id_jenis_kelamin,tgl_lahir,tempat_lahir,alamat,id_pekerjaan,id_pendidikan,id_status_kawin) VALUES('$nik','$id_kk','$id_rt','$nama_kk','$id_jenis_kelamin','$tgl_lahir','$tempat_lahir','$alamat','$id_pekerjaan','$id_pendidikan','$id_status_kawin')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_penduduk = valid($data['id_penduduk']);
      $nikOld = valid($data['nikOld']);
      if ($nik != $nikOld) {
        $checkPenduduk = "SELECT * FROM penduduk WHERE nik='$nik'";
        $resultPenduduk = mysqli_query($conn, $checkPenduduk);
        if (mysqli_num_rows($resultPenduduk) > 0) {
          $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE penduduk SET nik='$nik', id_rt='$id_rt', nama_kk='$nama_kk', id_jenis_kelamin='$id_jenis_kelamin', tgl_lahir='$tgl_lahir', tempat_lahir='$tempat_lahir', alamat='$alamat', id_pekerjaan='$id_pekerjaan', id_pendidikan='$id_pendidikan', id_status_kawin='$id_status_kawin', updated_at=current_timestamp WHERE id_penduduk='$id_penduduk'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_penduduk = valid($data['id_penduduk']);
      $sql = "DELETE FROM penduduk WHERE id_penduduk='$id_penduduk'";
      mysqli_query($conn, $sql);
    }
    return mysqli_affected_rows($conn);
  }
  function kelahiran($conn, $data, $action)
  {
    $id_penduduk = valid($data['id_penduduk']);
    $nama_kelahiran = valid($data['nama_kelahiran']);
    $id_jenis_kelamin = valid($data['id_jenis_kelamin']);
    $tempat_lahir = valid($data['tempat_lahir']);
    $tgl_lahir = valid($data['tgl_lahir']);
    $nama_ayah = valid($data['nama_ayah']);
    $nama_ibu = valid($data['nama_ibu']);
    $pelapor = valid($data['pelapor']);
    $hubungan_pelapor = valid($data['hubungan_pelapor']);

    if ($action == "insert") {
      $checkKelahiran = "SELECT * FROM kelahiran WHERE nama_kelahiran=$nama_kelahiran";
      $resultKelahiran = mysqli_query($conn, $checkKelahiran);
      if (mysqli_num_rows($resultKelahiran) > 0) {
        $_SESSION["message-danger"] = "Maaf, nama yang anda masukan sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO kelahiran(id_penduduk,nama_kelahiran,id_jenis_kelamin,tempat_lahir,tgl_lahir,nama_ayah,nama_ibu,pelapor,hubungan_pelapor) VALUES('$id_penduduk','$nama_kelahiran','$id_jenis_kelamin','$tempat_lahir','$tgl_lahir','$nama_ayah','$nama_ibu','$pelapor','$hubungan_pelapor')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_kelahiran = valid($data['id_kelahiran']);
      $nama_kelahiranOld = valid($data['nama_kelahiranOld']);
      if ($nama_kelahiran != $nama_kelahiranOld) {
        $checkKelahiran = "SELECT * FROM kelahiran WHERE nama_kelahiran=$nama_kelahiran";
        $resultKelahiran = mysqli_query($conn, $checkKelahiran);
        if (mysqli_num_rows($resultKelahiran) > 0) {
          $_SESSION["message-danger"] = "Maaf, nama yang anda masukan sudah ada.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE kelahiran SET nama_kelahiran='$nama_kelahiran', id_jenis_kelamin='$id_jenis_kelamin', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', nama_ayah='$nama_ayah', nama_ibu='$nama_ibu', pelapor='$pelapor', hubungan_pelapor='$hubungan_pelapor', updated_at=current_timestamp WHERE id_kelahiran='$id_kelahiran'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_kelahiran = valid($data['id_kelahiran']);
      $sql = "DELETE FROM kelahiran WHERE id_kelahiran='$id_kelahiran'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function kematian($conn, $data, $action)
  {
    $id_penduduk = valid($data['id_penduduk']);
    $nama_kematian = valid($data['nama_kematian']);
    $tempat_kematian = valid($data['tempat_kematian']);
    $tgl_kematian = valid($data['tgl_kematian']);
    $umur = valid($data['umur']);
    $nama_pelapor = valid($data['nama_pelapor']);
    $hubungan_pelapor = valid($data['hubungan_pelapor']);
    $sebab = valid($data['sebab']);

    if ($action == "insert") {
      $checkKematian = "SELECT * FROM kematian WHERE nama_kematian=$nama_kematian";
      $resultKematian = mysqli_query($conn, $checkKematian);
      if (mysqli_num_rows($resultKematian) > 0) {
        $_SESSION["message-danger"] = "Maaf, nama yang anda masukan sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO kematian(id_penduduk,nama_kematian,tempat_kematian,tgl_kematian,umur,nama_pelapor,hubungan_pelapor,sebab) VALUES('$id_penduduk','$nama_kematian','$tempat_kematian','$tgl_kematian','$umur','$nama_pelapor','$hubungan_pelapor','$sebab')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_kematian = valid($data['id_kematian']);
      $nama_kematianOld = valid($data['nama_kematianOld']);
      if ($nama_kematian != $nama_kematianOld) {
        $checkKematian = "SELECT * FROM kematian WHERE nama_kematian=$nama_kematian";
        $resultKematian = mysqli_query($conn, $checkKematian);
        if (mysqli_num_rows($resultKematian) > 0) {
          $_SESSION["message-danger"] = "Maaf, nama yang anda masukan sudah ada.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE kematian SET nama_kematian='$nama_kematian', tempat_kematian='$tempat_kematian', tgl_kematian='$tgl_kematian', umur='$umur', nama_pelapor='$nama_pelapor', hubungan_pelapor='$hubungan_pelapor', sebab='$sebab', updated_at=current_timestamp WHERE id_kematian='$id_kematian'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_kematian = valid($data['id_kematian']);
      $sql = "DELETE FROM kematian WHERE id_kematian='$id_kematian'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function pendatang($conn, $data, $action)
  {
    $id_rt = valid($data['id_rt']);
    $nik = valid($data['nik']);
    $nama_kk = valid($data['nama_kk']);
    $tgl_menetap = valid($data['tgl_menetap']);
    $alamat_asal = valid($data['alamat_asal']);
    $alasan = valid($data['alasan']);

    if ($action == "insert") {
      $checkPendatang = "SELECT * FROM pendatang WHERE nik='$nik' AND tgl_menetap='$tgl_menetap'";
      $resultPendatang = mysqli_query($conn, $checkPendatang);
      if (mysqli_num_rows($resultPendatang) > 0) {
        $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar sebagai pendatang.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO pendatang(id_rt,nik,nama_kk,tgl_menetap,alamat_asal,alasan) VALUES('$id_rt','$nik','$nama_kk','$tgl_menetap','$alamat_asal','$alasan')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_pendatang = valid($data['id_pendatang']);
      $nikOld = valid($data['nikOld']);
      $tgl_menetapOld = valid($data['tgl_menetapOld']);
      if ($nik != $nikOld || $tgl_menetap != $tgl_menetapOld) {
        $checkPendatang = "SELECT * FROM pendatang WHERE nik='$nik' AND tgl_menetap='$tgl_menetap'";
        $resultPendatang = mysqli_query($conn, $checkPendatang);
        if (mysqli_num_rows($resultPendatang) > 0) {
          $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar sebagai pendatang.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE pendatang SET id_rt='$id_rt', nik='$nik', nama_kk='$nama_kk', tgl_menetap='$tgl_menetap', alamat_asal='$alamat_asal', alasan='$alasan', updated_at=current_timestamp WHERE id_pendatang='$id_pendatang'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_pendatang = valid($data['id_pendatang']);
      $sql = "DELETE FROM pendatang WHERE id_pendatang='$id_pendatang'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
  function pindah($conn, $data, $action)
  {
    $nik = valid($data['nik']);
    $nama_kk = valid($data['nama_kk']);
    $tgl_pindah = valid($data['tgl_pindah']);
    $alamat_pindah = valid($data['alamat_pindah']);
    $ket = valid($data['ket']);

    if ($action == "insert") {
      $checkPindah = "SELECT * FROM pindah WHERE nik='$nik' AND tgl_pindah='$tgl_pindah'";
      $resultPindah = mysqli_query($conn, $checkPindah);
      if (mysqli_num_rows($resultPindah) > 0) {
        $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar sebagai warga pindahan.";
        $_SESSION["time-message"] = time();
        return false;
      }
      $sql = "INSERT INTO pindah(nik,nama_kk,tgl_pindah,alamat_pindah,ket) VALUES('$nik','$nama_kk','$tgl_pindah','$alamat_pindah','$ket')";
      mysqli_query($conn, $sql);
    }

    if ($action == "update") {
      $id_pindah = valid($data['id_pindah']);
      $nikOld = valid($data['nikOld']);
      $tgl_pindahOld = valid($data['tgl_pindahOld']);
      if ($nik != $nikOld || $tgl_pindah != $tgl_pindahOld) {
        $checkPindah = "SELECT * FROM pindah WHERE nik='$nik' AND tgl_pindah='$tgl_pindah'";
        $resultPindah = mysqli_query($conn, $checkPindah);
        if (mysqli_num_rows($resultPindah) > 0) {
          $_SESSION["message-danger"] = "Maaf, NIK yang anda masukan sudah terdaftar sebagai warga pindahan.";
          $_SESSION["time-message"] = time();
          return false;
        }
      }
      $sql = "UPDATE pindah SET nik='$nik', nama_kk='$nama_kk', tgl_pindah='$tgl_pindah', alamat_pindah='$alamat_pindah', ket='$ket', updated_at=current_timestamp WHERE id_pindah='$id_pindah'";
      mysqli_query($conn, $sql);
    }

    if ($action == "delete") {
      $id_pindah = valid($data['id_pindah']);
      $sql = "DELETE FROM pindah WHERE id_pindah='$id_pindah'";
      mysqli_query($conn, $sql);
    }

    return mysqli_affected_rows($conn);
  }
}
