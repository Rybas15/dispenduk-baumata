<?php require_once "../controller/script.php";
require_once __DIR__ . '/vendor/autoload.php';

$data = mysqli_query($conn, "SELECT kelahiran.*, penduduk.nik, jenis_kelamin.jenis_kelamin FROM kelahiran JOIN penduduk ON kelahiran.id_penduduk=penduduk.id_penduduk JOIN jenis_kelamin ON kelahiran.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin ORDER BY kelahiran.nama_kelahiran ASC
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
$mpdf->WriteHTML('<h4 style="margin-top: 20px;text-align: center;margin-bottom: 20px;">Data Laporan Kelahiran</h4>
');
$mpdf->WriteHTML('<table border="0" style="width: 100%;margin-top: 20px;vertical-align: top;border-collapse: collapse;">
  <thead>
    <tr>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">#</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">NIK</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Nama</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Jenis Kelamin</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">TTL</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Nama Ayah</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Nama Ibu</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Pelapor</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Hubungan Pelapor</th>
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
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nik"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nama_kelahiran"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["jenis_kelamin"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["tempat_lahir"] . ', ' . $tgl_lahir . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nama_ayah"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nama_ibu"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["pelapor"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["hubungan_pelapor"] . '</td>
    </tr>');
  }
}
$mpdf->WriteHTML('</tbody>
</table>');
$mpdf->Output();
