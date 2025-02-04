<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
// Koneksi ke database
include "service/database.php";

$notif = ""; // Variabel untuk menyimpan notifikasi

// Jika form disubmit, proses data absensi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hadir_ids = isset($_POST['hadir']) ? $_POST['hadir'] : []; // ID santri yang hadir
    $tanggal = date('Y-m-d'); // Tanggal absensi (default: hari ini)

    $stmt_insert = $db->prepare("INSERT INTO absensi (santri_id, nama, kelas, tanggal, status) SELECT id, nama, kelas, ?, 'Hadir' FROM santri WHERE id = ?");

    foreach ($hadir_ids as $santri_id) {
        $stmt_insert->bind_param("si", $tanggal, $santri_id);
        $stmt_insert->execute();
    }

    $notif = "Absensi berhasil disimpan!";

    $stmt_insert->close();
}

// Ambil data santri untuk ditampilkan di tabel
$result = $db->query("SELECT * FROM santri");

// Tampilkan data dengan nomor urut
$num_row = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo-ct.png">
  <title>
    Absensi Santri Al-Ma'tuq
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/dashboard " target="_blank">
        <img src="assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Absensi Santri Al-Ma'tuq</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-white " href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">home</i>
            </div>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-white active" style="background-color: #379E35;" href="absensi.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Absensi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="tables.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Data Santri</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="create.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">face</i>
            </div>
            <span class="nav-link-text ms-1">Add Data Santri</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-white " href="poin.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Poin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="konseling.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">app_registration</i>
            </div>
            <span class="nav-link-text ms-1">Konseling</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="view_konseling.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">apps</i>
            </div>
            <span class="nav-link-text ms-1">Lihat Konseling</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="kesehatan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">vaccines</i>
            </div>
            <span class="nav-link-text ms-1">Kesehatan</span>
          </a>
        </li>
       
        <!-- s -->

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Absensi</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Absensi</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="shadow-dark border-radius-lg pt-4 pb-3" style="background-color: #379E35;">
              <h6 class="text-white text-capitalize ps-3">Table Absensi Santri</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <form action="" method="post">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10 text text-center">id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10 text text-center">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-10 text text-center">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-20">Absen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      if ($result->num_rows > 0) {
                        // Looping data
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          // Kolom ID
                          echo "<td class='text-center'>";
                          echo "<p class='text-xs font-weight-bold mb-0'>" . $no++ . "</p>";
                          echo "</td>";

                          // Kolom Nama
                          echo "<td>";
                          echo "<p class='text-xs font-weight-bold mb-0'>" . htmlspecialchars($row['nama']) . "</p>";
                          echo "</td>";

                          // Kolom Kwelas
                          echo "<td class='text-center'>";
                          echo "<p class='text-xs font-weight-bold mb-0'>" . htmlspecialchars($row['kelas']) . "</p>";
                          echo "</td>";

                          // Status dengan badge warna
                          echo "<td class='align-middle text-center text-sm'>";
                          $badgeClass = $row['status'] === 'aktif' ? 'bg-gradient-success' : 'bg-gradient-danger';
                          echo "<span class='badge badge-sm $badgeClass'>" . $row['status'] . "</span>";
                          echo "</td>";

                          // Kolom Checkbox
                          echo "<td class='text-center'>";
                          echo "<input type='checkbox' name='hadir[]' value='" . htmlspecialchars($row['id']) . "' class='checkbox-item'>";
                          echo "</td>";
                          echo "</tr>";
                        }
                      } else {
                          echo "<tr><td colspan='3' class='text-center text-secondary'>Tidak ada data</td></tr>";
                      }
                    ?>
                    <tr>
                      <td>
                        <input type="checkbox" id="select-all" onclick="toggleCheckboxes(this)">
                        <label for="select-all" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 w-10 ms-2">Pilih Semua</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer colspan-3">
                <button type="submit" class="btn btn-dark" style="background-color: #379E35;">Tambah Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="container-fluid py-4">
    <footer class="footer py-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                Customized by <a href="https://github.com/saldeww" class="font-weight-bold" target="_blank">Syahrama Saldi</a>.
                Based on a template by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <!-- HTML lainnya -->

  <script>
    function toggleCheckboxes(source) {
      const checkboxes = document.querySelectorAll('.checkbox-item');
      checkboxes.forEach((checkbox) => {
        checkbox.checked = source.checked;
      });
    }
  </script>

  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>