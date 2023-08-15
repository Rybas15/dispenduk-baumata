<?php require_once "../controller/script.php";
require_once __DIR__ . '/vendor/autoload.php';

$data = mysqli_query($conn, "SELECT pendatang.*, dusun.nama_dusun, dusun.kepala_dusun, rw.rw, rw.nama_ketua_rw, rt.rt, rt.nama_ketua_rt 
FROM pendatang 
JOIN rt ON rt.id_rt=pendatang.id_rt
JOIN rw ON rw.id_rw=rt.id_rw
JOIN dusun ON dusun.id_dusun=rw.id_dusun
ORDER BY pendatang.nama_kk ASC");

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
$mpdf->WriteHTML('<h4 style="margin-top: 20px;text-align: center;margin-bottom: 20px;">Data Laporan Pendatang</h4>
');
$mpdf->WriteHTML('<table border="0" style="width: 100%;margin-top: 20px;vertical-align: top;border-collapse: collapse;">
  <thead>
    <tr>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">#</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">NIK</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Nama</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Tgl Menetap</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Alamat Asal</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Alasan</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">Dusun</th>
      <th style="text-align: center;border: 1px solid #ccc;border-color: #000;padding: 5px;">RT/RW</th>
    </tr>
  </thead>  
  <tbody>');
if (mysqli_num_rows($data) > 0) {
  $no = 1;
  while ($row = mysqli_fetch_assoc($data)) {
    $tgl_menetap = date_create($row["tgl_menetap"]);
    $tgl_menetap = date_format($tgl_menetap, "d M Y");
    $mpdf->WriteHTML('<tr>
      <th style="border: 1px solid #ccc;border-color: #000;">' . $no++ . '</th>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nik"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["nama_kk"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $tgl_menetap . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["alamat_asal"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;">' . $row["alasan"] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;line-height: 20px;">' . "Dusun : " . $row["nama_dusun"] . "<br>Kepala Dusun : " . $row['kepala_dusun'] . '</td>
      <td style="border: 1px solid #ccc;border-color: #000;line-height: 20px;">' . "RT : " . $row["rt"] . " (Ketua RT " . $row['nama_ketua_rt'] . ")" . "<br>RW : " . $row['rw'] . " (Ketua RW " . $row['nama_ketua_rw'] . ")" . '</td>
    </tr>');
  }
}
$mpdf->WriteHTML('</tbody>
</table>');
$mpdf->Output();
