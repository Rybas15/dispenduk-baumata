<?php require_once("../controller/script.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .card-custom {
    cursor: pointer;
    transform: none;
    transition: 0.25s ease-in-out;
  }

  .card-custom:hover {
    transform: scale(1.1);
  }
</style>

<div class="row">

  <div class="col-lg-12 mt-3">
    <h2 class="text-center">SISTEM INFORMASI PENDUDUK DESA BAUMATA UTARA</h2>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-lg-3">
        <div class="card card-custom rounded-0 border-0 shadow mt-3" onclick="window.location.href='kartu-keluarga'">
          <div class="card-body">
            <h3>Kartu Keluarga</h3>
            <h1 class="mt-3 mb-3"><i class="mdi mdi-file-multiple" style="font-size: 35px;"></i> <?= $countKK ?></h1>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-custom rounded-0 border-0 shadow mt-3" onclick="window.location.href='penduduk'">
          <div class="card-body">
            <h3>Penduduk</h3>
            <h1 class="mt-3 mb-3"><i class="mdi mdi-account-card-details" style="font-size: 35px;"></i> <?= $countPenduduk ?></h1>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-custom rounded-0 border-0 shadow mt-3" onclick="window.location.href='kelahiran'">
          <div class="card-body">
            <h3>Kelahiran</h3>
            <h1 class="mt-3 mb-3"><i class="mdi mdi-baby" style="font-size: 35px;"></i> <?= $countKelahiran ?></h1>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-custom rounded-0 border-0 shadow mt-3" onclick="window.location.href='kematian'">
          <div class="card-body">
            <h3>Kematian</h3>
            <h1 class="mt-3 mb-3"><i class="mdi mdi-account-minus" style="font-size: 35px;"></i> <?= $countKematian ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row flex-row-reverse">
      <div class="col-lg-8">
        <div class="card rounded-0 border-0 shadow mt-3">
          <div class="card-header">
            <div class="card-title">
              <h4 style="margin-top: 15px;">Grafik Pertumbuhan Penduduk</h4>
            </div>
          </div>
          <div class="card-body">
            <div style="width: 100%; margin: auto;">
              <canvas id="birthChart"></canvas>
            </div>

            <script>
              // Fungsi untuk mengambil data dari PHP menggunakan Fetch API
              function getData() {
                return fetch('grafik-penduduk.php')
                  .then(response => response.json())
                  .then(data => {
                    return data;
                  });
              }

              // Fungsi untuk mengubah data menjadi format yang sesuai untuk Chart.js
              function prepareChartData(data) {
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const genders = [...new Set(data.map(item => item.gender))];

                const datasets = genders.map(gender => {
                  const values = months.map((month, index) => {
                    const found = data.find(item => item.gender === gender && item.bulan === index + 1);
                    return found ? found.total : 0;
                  });

                  return {
                    label: gender,
                    data: values,
                    backgroundColor: gender === 'Laki-Laki' ? 'rgba(54, 162, 235, 0.2)' : 'rgba(255, 99, 132, 0.2)',
                    borderColor: gender === 'Perempuan' ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                  };
                });

                return {
                  labels: months,
                  datasets: datasets,
                };
              }

              // Fungsi untuk membuat chart dengan data yang diberikan
              function createChart(data) {
                const ctx = document.getElementById('birthChart').getContext('2d');
                const birthChart = new Chart(ctx, {
                  type: 'line',
                  data: prepareChartData(data),
                  options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true,
                          callback: function(value, index, values) {
                            if (Math.floor(value) === value) {
                              return value;
                            }
                          }
                        }
                      }]
                    }
                  }
                });
              }

              // Panggil fungsi getData untuk mengambil data dari PHP
              getData().then(data => {
                createChart(data);
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card rounded-0 border-0 shadow mt-3">
          <div class="card-body">
            <canvas id="pieChartKelahiran" width="400" height="400"></canvas>
            <script>
              // Fungsi untuk mengambil data JSON dari server
              function fetchDataKelahiran() {
                fetch('pie-kelahiran.php')
                  .then(response => response.json())
                  .then(data => createPieChartKelahiran(data))
                  .catch(error => console.error('Error:', error));
              }

              // Fungsi untuk membuat chart pie
              function createPieChartKelahiran(data) {
                const ctx = document.getElementById('pieChartKelahiran').getContext('2d');

                const labels = data.map(item => item.gender);
                const values = data.map(item => item.total);
                const colors = getRandomColorsKelahiran(data.length);

                new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: labels,
                    datasets: [{
                      data: values,
                      backgroundColor: colors,
                    }]
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                      display: true,
                      text: 'Jumlah Kelahiran Berdasarkan Jenis Kelamin',
                    },
                  }
                });
              }

              // Fungsi untuk mendapatkan warna acak
              function getRandomColorsKelahiran(length) {
                const colors = [];
                for (let i = 0; i < length; i++) {
                  const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                  colors.push(randomColor);
                }
                return colors;
              }

              // Panggil fungsi fetchDataKelahiran untuk memuat data dan membuat chart
              fetchDataKelahiran();
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-lg-4">
        <div class="card rounded-0 border-0 shadow mt-3">
          <div class="card-body">
            <canvas id="pieChartKematian" width="400" height="400"></canvas>
            <script>
              // Fungsi untuk mengambil data JSON dari server
              function fetchDataKematian() {
                fetch('pie-kematian.php')
                  .then(response => response.json())
                  .then(data => createPieChartKematian(data))
                  .catch(error => console.error('Error:', error));
              }

              // Fungsi untuk membuat chart pie
              function createPieChartKematian(data) {
                const ctx = document.getElementById('pieChartKematian').getContext('2d');

                const labels = data.map(item => item.gender);
                const values = data.map(item => item.total);
                const colors = getRandomColorsKematian(data.length);

                new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: labels,
                    datasets: [{
                      data: values,
                      backgroundColor: colors,
                    }]
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                      display: true,
                      text: 'Jumlah Kematian Berdasarkan Jenis Kelamin',
                    },
                  }
                });
              }

              // Fungsi untuk mendapatkan warna acak
              function getRandomColorsKematian(length) {
                const colors = [];
                for (let i = 0; i < length; i++) {
                  const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                  colors.push(randomColor);
                }
                return colors;
              }

              // Panggil fungsi fetchDataKematian untuk memuat data dan membuat chart
              fetchDataKematian();
            </script>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card rounded-0 border-0 shadow mt-3">
          <div class="card-header">
            <div class="card-title">
              <h4 style="margin-top: 15px;">Grafik Perubahan Penduduk</h4>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChart" style="width: 100%;"></canvas>

            <script>
              // Mengambil data dari file grafik-perubahan.php dengan AJAX
              fetch('grafik-perubahan.php')
                .then(response => response.json())
                .then(data => {
                  // Data dari file PHP berhasil diambil
                  var allMonths = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                  ];

                  // Menggambar chart line dengan Chart.jsvar ctx = document.getElementById('myChart').getContext('2d');
                  var ctx = document.getElementById('myChart').getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: allMonths,
                      datasets: [{
                          label: 'Pendatang',
                          data: data.pendatang,
                          borderColor: 'green',
                          borderWidth: 1,
                          fill: false
                        },
                        {
                          label: 'Pindah',
                          data: data.pindah,
                          borderColor: 'red',
                          borderWidth: 1,
                          fill: false
                        }
                      ]
                    },
                    options: {
                      responsive: true,
                      maintainAspectRatio: false,
                      scales: {
                        x: {
                          display: true,
                          title: {
                            display: true,
                            text: 'Bulan',
                            font: {
                              size: 16,
                              weight: 'bold'
                            }
                          },
                          ticks: {
                            font: {
                              size: 14
                            }
                          }
                        },
                        y: {
                          display: true,
                          title: {
                            display: true,
                            text: 'Jumlah',
                            font: {
                              size: 16,
                              weight: 'bold'
                            }
                          },
                          ticks: {
                            font: {
                              size: 14
                            },
                            beginAtZero: true
                          }
                        }
                      },
                      plugins: {
                        legend: {
                          display: true,
                          labels: {
                            font: {
                              size: 14
                            }
                          }
                        }
                      }
                    }
                  });
                })
                .catch(error => {
                  // Terjadi kesalahan saat mengambil data dari file PHP
                  console.error('Error fetching data:', error);
                });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
    }
    if (document.querySelector(".table-responsive").addEventListener) {
      document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
      document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
    }
  })();
</script>