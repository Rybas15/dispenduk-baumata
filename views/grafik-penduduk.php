<?php require_once("../controller/script.php");

// Query untuk mengambil data penduduk berdasarkan jenis kelamin dalam satu tahun (misalnya tahun 2023)
$year = date('Y');
$sql = "SELECT jenis_kelamin.jenis_kelamin, MONTH(penduduk.tgl_lahir) AS bulan, COUNT(*) AS total FROM penduduk JOIN jenis_kelamin ON penduduk.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin WHERE YEAR(penduduk.tgl_lahir) = '$year' GROUP BY jenis_kelamin.jenis_kelamin, MONTH(penduduk.tgl_lahir) ORDER BY jenis_kelamin.jenis_kelamin";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = array(
    'gender' => $row['jenis_kelamin'],
    'bulan' => (int)$row['bulan'],
    'total' => (int)$row['total'],
  );
}

// Mengembalikan data dalam format JSON
echo json_encode($data);
