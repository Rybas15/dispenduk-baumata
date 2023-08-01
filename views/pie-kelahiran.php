<?php require_once("../controller/script.php");

// Query untuk mengambil data kelahiran berdasarkan jenis kelamin
$sql = "SELECT jenis_kelamin.jenis_kelamin, MONTH(kelahiran.tgl_lahir) AS bulan, COUNT(*) AS total FROM kelahiran JOIN jenis_kelamin ON kelahiran.id_jenis_kelamin=jenis_kelamin.id_jenis_kelamin GROUP BY jenis_kelamin.jenis_kelamin, MONTH(kelahiran.tgl_lahir) ORDER BY jenis_kelamin.jenis_kelamin";
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
