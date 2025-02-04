<?php
include "service/database.php"; // Pastikan jalur file sesuai

// Cek apakah ID diberikan melalui GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data santri berdasarkan ID
    $query = "SELECT * FROM santri WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Pastikan id sudah ada (misal dari URL atau form)
  $id = mysqli_real_escape_string($db, $_GET['id']);  // misalnya ID berasal dari URL

  // Mengambil data dari form
  $nama = mysqli_real_escape_string($db, $_POST['nama']);
  $kelas = mysqli_real_escape_string($db, $_POST['kelas']);
  $status = mysqli_real_escape_string($db, $_POST['status']);
  $nama_wali = mysqli_real_escape_string($db, $_POST['nama_wali']);
  $alamat = mysqli_real_escape_string($db, $_POST['alamat']);

  // Gunakan prepared statement untuk menghindari SQL injection
  $query = "UPDATE santri SET nama = ?, kelas = ?, status = ?, nama_wali = ?, alamat = ? WHERE id = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("sssssi", $nama, $kelas, $status, $nama_wali, $alamat, $id);

  // Eksekusi query
  if ($stmt->execute()) {
      echo "Data berhasil diperbarui.";
      header("Location: tables.php");
      exit;
  } else {
      echo "Error: " . $stmt->error;
  }

  // Menutup prepared statement
  $stmt->close();
}

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
      <a class="navbar-brand m-0" target="_blank">
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
          <a class="nav-link text-white " href="absensi.php">
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
          <a class="nav-link text-white active" style="background-color: #379E35;" href="create.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Data Santri</h6>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="shadow-dark border-radius-lg pt-4 pb-3" style="background-color: #379E35;">
                <h6 class="text-white text-capitalize ps-3">Edit Data Santri</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
              <div class="card-body">
              <!-- general form elements -->
            <div class="card card-primary">
              <form method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="nama" name="nama" value="<?= $data['nama']; ?>" required class="form-control input-group-outline mb-3" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="kelas" name="kelas" value="<?= $data['kelas']; ?>" required class="form-control input-group-outline mb-3" placeholder="Kelas Santri">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="status" name="status" value="<?= $data['status']; ?>" required class="form-control input-group-outline mb-3" placeholder="Status Santri">
                    </div>
                    <div class="form-group">
                        <label for="nama_wali">Nama Wali</label>
                        <input type="nama_wali" name="nama_wali" value="<?= $data['nama_wali']; ?>" required class="form-control input-group-outline mb-3" placeholder="Nama Wali Santri">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="alamat" name="alamat" value="<?= $data['alamat']; ?>" required class="form-control input-group-outline mb-3" placeholder="Alamat Santri">
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="background-color: #379E35;">Update Data</button>
                    </div>
                </div>
              </form>
              <!-- /.card -->
            </div>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      </div>
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


<!-- malah jadi kocak anjrot KOWKOawk, wait gua cpas dlu dri add da-->