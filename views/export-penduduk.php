<?php require_once "../controller/script.php";
require_once __DIR__ . '/vendor/autoload.php';

$data = mysqli_query($conn, "SELECT penduduk.*, kartu_keluarga.no_kk, rt.rt, rt.nama_ketua_rt, jenis_kelamin.jenis_kelamin, pekerjaan.pekerjaan, pendidikan.status_pendidikan, status_perkawinan.status_perkawinan 
  FROM penduduk
  JOIN kartu_keluarga ON penduduk.id_kk=kartu_keluarga.id_kk
  JOIN rt ON penduduk.id_rt=rt.id_rt
  JOIN jenis_kelamin ON penduduk.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin
  JOIN pekerjaan ON penduduk.id_pekerjaan=pekerjaan.id_pekerjaan
  JOIN pendidikan ON penduduk.id_pendidikan=pendidikan.id_pendidikan
  JOIN status_perkawinan ON penduduk.id_status_kawin=status_perkawinan.id_status_perkawinan
  ORDER BY penduduk.nama_kk ASC
");

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("KARTU KELUARGA DISPENDUK DESA BAUMATA UTARA");
$mpdf->WriteHTML('<div style="border-bottom: 3px solid black;width: 100%;">
  <table border="0" style="width: 100%;">
    <tbody>
      <tr>
        <th style="text-align: center;">
          <img src="../assets/images/logo-city.png" alt="" style="width: 100px;height: 100px;">
        </th>
        <td style="text-align: center;">
          <h3>PEMERINTAH KOTA KUPANG<br>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL<br>DESA BAUMATA UTARA</h3>
          <p style="font-size: 14px;">Jl. ..., Kode Pos ...</p>
        </td>
        <th style="text-align: center;">
        </th>
      </tr>
    </tbody>
  </table>
</div>');
$mpdf->WriteHTML('<h4 style="margin-top: 20px;text-align: center;margin-bottom: 20px;">Data Laporan Penduduk</h4>
');
$mpdf->WriteHTML('<table border="0" style="width: 100%;margin-top: 20px;vertical-align: top;border-collapse: collapse;">
  <thead>
    <tr>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">#</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">No. Kartu Keluarga</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">NIK</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Nama</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Jenis Kelamin</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">TTL</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Alamat</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Pekerjaan</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Pendidikan</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Status Perkawinan</th>
    </tr>
  </thead>  
  <tbody>');
if (mysqli_num_rows($data) > 0) {
  $no = 1;
  while ($row = mysqli_fetch_assoc($data)) {
    $tgl_lahir = date_create($row["tgl_lahir"]);
    $tgl_lahir = date_format($tgl_lahir, "d M Y");
    $mpdf->WriteHTML('<tr>
      <th style="border: 1px solid #ccc;border-color: #000;">' . $no++ . '</th>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["no_kk"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nik"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nama_kk"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["jenis_kelamin"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["tempat_lahir"] . ', ' . $tgl_lahir . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["alamat"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["pekerjaan"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["status_pendidikan"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["status_perkawinan"] . '</td>
    </tr>');
  }
}
$mpdf->WriteHTML('</tbody>
</table>');
$mpdf->Output();
