<?php
require_once("../controller/script.php");

// Ambil data pendatang dalam satu tahun terakhir
$sql = "SELECT COUNT(*) AS jumlah, DATE_FORMAT(created_at, '%b') AS bulan FROM pendatang WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW() GROUP BY DATE_FORMAT(created_at, '%b')";
$resultPendatang = mysqli_query($conn, $sql);

// Ambil data pindah dalam satu tahun terakhir
$sql = "SELECT COUNT(*) AS jumlah, DATE_FORMAT(created_at, '%b') AS bulan FROM pindah WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW() GROUP BY DATE_FORMAT(created_at, '%b')";
$resultPindah = mysqli_query($conn, $sql);

// Inisialisasi array data untuk jumlah pendatang dan pindah
$dataPendatang = array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0);
$dataPindah = array_fill_keys(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], 0);

// Memproses data pendatang
while ($row = mysqli_fetch_assoc($resultPendatang)) {
  $month = $row['bulan']; // Mengambil bulan dari hasil query
  $dataPendatang[$month] = (int)$row['jumlah']; // Konversi jumlah menjadi integer
}

// Memproses data pindah
while ($row = mysqli_fetch_assoc($resultPindah)) {
  $month = $row['bulan']; // Mengambil bulan dari hasil query
  $dataPindah[$month] = (int)$row['jumlah']; // Konversi jumlah menjadi integer
}

// Menggabungkan data pendatang dan pindah menjadi satu array data
$data = array('pendatang' => array_values($dataPendatang), 'pindah' => array_values($dataPindah));

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
