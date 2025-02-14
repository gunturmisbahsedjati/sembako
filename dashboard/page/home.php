<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
require_once './inc/inc.library.php';
$hariIni = date('Y-m-d');
if (isset($_SESSION['alert'])) : ?>
    <script>
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        })
        <?php
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
        ?>
    </script>
<?php endif ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-4">
        <!-- Congratulations card -->

        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title pb-0 fw-bold text-primary pt-1"><i class="mdi mdi-home-circle mdi-36px"></i>Toko Sembako</h3>
                    <h5 class="card-title mb-4">Welcome Back, <?= $_SESSION['nama_akun'] ?> !</h5>
                    <h4 class="text-primary mb-1 d-inline-flex fw-bold">
                        <span class="mdi mdi-clock-outline"></span>&nbsp;
                        <span id="clock-dashboard"></span>
                    </h4>
                    <h5 class="mb-2 pb-1">Let's Work & Enjoy The Coffee !</h5>
                    <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
                </div>
                <img src="assets/img/icons/misc/triangle-light.png" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background" data-app-light-img="icons/misc/triangle-light.png" data-app-dark-img="icons/misc/triangle-dark.png" />
                <img src="assets/img/illustrations/coffe.png" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 " width="125" alt="view sales" />
            </div>
        </div>
        <!--/ Congratulations card -->


    </div>
</div>