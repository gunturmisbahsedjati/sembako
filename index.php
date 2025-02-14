<?php
session_start();
require_once 'inc/inc.koneksi.php';
if (!isset($_SESSION['username'])) {
  header('location:/');
} else {
  $username = $_SESSION['username'];
  $nama_akun = $_SESSION['nama_akun'];
  $id = $_SESSION['id'];
  $level = $_SESSION['level'];
  $arrayAkses = explode(",", $_SESSION['level']);
  // if (time() - $_SESSION["login_time_stamp"] > 86400) {
  //   session_unset();
  //   session_destroy();
  //   header("location:login");
  // }
}

if (!isset($_SESSION['status_login'])) {
  header('location:login');
  exit;
}

$cek_status_akun = mysqli_num_rows(mysqli_query($myConnection, "SELECT * FROM tb_akun_manajemen WHERE user_manajemen='$username' and id_manajemen = '$id' and level_manajemen = '$level' and status_manajemen = 'aktif' and soft_delete = 0 "));
if ($cek_status_akun == 0) {
  session_destroy();
  header("location:./");
}

?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="UTF-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="ROMANSA CAFE JEMBER">
  <meta name="robots" content="index" />
  <meta name="name" content="ROMANSA">
  <meta name="shot-name" content="ROMANSA">
  <meta name="keywords" content="romansa cafe jember, sistem kasir romansa cafe, cafe jember, romansa jember" />
  <meta name="author" content="Arghavan Barra Al Misbah" />
  <meta name="language" content="Indonesia" />
  <!-- <meta name="theme-color" content="#0d0072" /> -->
  <meta http-equiv="expires" content="0">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache, must-revalidate">

  <title>Sembako | Shop Bookkeeping Management System</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/logo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

  <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css?ver=<?php echo md5(time()); ?>" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/datatables/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/libs/sweetalert/sweetalert2.css">
  <script src="assets/vendor/libs/sweetalert/sweetalert2.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.bootstrap5.min.css">

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<!-- <body> -->

<body style="margin:0;" onload="loadingPage()">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <?php include_once 'dashboard/sidebar.php'; ?>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <?php include_once 'dashboard/header.php'; ?>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- <div class="lds-spinner" id="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div> -->
          <div class="loader" id="loader"></div>
          <!-- Content -->
          <div style="display:none;" id="content">
            <!-- <div> -->
            <?php include_once 'dashboard/routes.php'; ?>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <!-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                &copy; BAN S/M Provinsi Jawa Timur <?php echo date('Y') ?>
              </div>
              <div>
                Developed by Team IT BAN S/M Provinsi Jawa Timur
              </div>
            </div>
          </footer> -->
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery-3.5.1.js"></script>
  <!-- <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="assets/vendor/libs/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/libs/datatables/dataTables.fixedColumns.min.js"></script>
  <script src="assets/vendor/libs/datatables/dataTables.bootstrap5.js"></script>
  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/wizard.js?ver=<?php echo md5(time()); ?>"></script>

  <!-- Page JS -->
  <script src=" assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
  <script type="text/javascript">
    // function startTime() {
    //   const today = new Date();
    //   let h = today.getHours();
    //   let m = today.getMinutes();
    //   let s = today.getSeconds();
    //   m = checkTime(m);
    //   s = checkTime(s);
    //   document.getElementById('clock-dashboard').innerHTML = h + ":" + m + ":" + s;
    //   setTimeout(startTime, 1000);
    // }

    // function checkTime(i) {
    //   if (i < 10) {
    //     i = "0" + i
    //   }; // add zero in front of numbers < 10
    //   return i;
    // }

    $(document).ready(function() {
      $('#member_table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
      });
      $('#report_table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
      });
      $('#visitasi_table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
      });
      $('#validasi_table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
      });
      $('#tahap_table').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true,
        fixedColumns: {
          left: 3
        }
      });
      $('#dashboard_sementara').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        fixedColumns: {
          left: 1
        }
      });
      $('#tabel_absen').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
      });
      $('#tabel_hari_ini').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': true
      });

    });
  </script>
</body>

</html>