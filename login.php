<?php
session_start();
if (isset($_SESSION['status_login'])) {
  header('location:./');
  exit;
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="UTF-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="Sembako">
  <meta name="robots" content="index" />
  <meta name="name" content="Sembako">
  <meta name="shot-name" content="Sembako">
  <meta name="keywords" content="Sembako cafe jember, sistem kasir Sembako cafe, cafe jember, Sembako jember" />
  <meta name="author" content="Arghavan Barra Al Misbah" />
  <meta name="language" content="Indonesia" />
  <meta name="theme-color" content="#0d0072" />
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
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/libs/sweetalert/sweetalert2.css" />
  <script src="assets/vendor/libs/sweetalert/sweetalert2.js"></script>

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css?ver=<?php echo time(); ?>" />

  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<!-- <body style="background-image: url('assets/img/backgrounds/bg.jpg'); background-attachment:fixed; background-size:cover;"> -->

<body>
  <!-- Content -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="card p-2">

          <!-- <div class="app-brand justify-content-center mt-5">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="assets/img/favicon/ico.png" alt="">
              </span>
              <span class="app-brand-text demo text-heading fw-semibold">Materio</span>
            </a>
          </div> -->

          <div class="card-body text-center">
            <h2 class="mb-1 fw-bold text-primary"><i class="mdi mdi-home-circle mdi-36px"></i>SEMBAKO </h2>
            <h5 class="mb-4">Shop Bookkeeping<br>Management System</h5>

            <form id="formAuthentication" class="mb-3" action="" method="post">
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
                <label for="email">Email or Username</label>
              </div>
              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100 btn-login" type="submit">Sign in</button>
                <button class="btn btn-primary btn-loading d-none disabled d-grid w-100" type="button">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>
            <p class="text-center">
              <small>Developed with ❤ by ANIMASIKU Studio 2025</small>
            </p>
          </div>
        </div>
        <!-- /Login -->
        <!-- <img src="assets/img/illustrations/tree-3.png" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block" /> -->
        <!-- <img src="assets/img/illustrations/auth-basic-mask-light.png" class="authentication-image d-none d-lg-block" alt="triangle-bg" data-app-light-img="illustrations/auth-basic-mask-light.png" data-app-dark-img="illustrations/auth-basic-mask-dark.png" /> -->
        <!-- <img src="assets/img/illustrations/tree.png" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block" /> -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/wizard.js?ver=<?php echo time(); ?>"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <!-- <script async defer src=" https://buttons.github.io/buttons.js"></script> -->
</body>

</html>