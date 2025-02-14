<?php
session_start();
include_once '../../../../inc/inc.koneksi.php';
include_once '../../../../inc/inc.library.php';
if (empty($_SESSION['username'])) {
    header('location:../../../');
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $level = $_SESSION['level'];
    $arrayAkses = explode(",", $_SESSION['level']);
}
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
    exit;
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = mysqli_query($myConnection, "select * from tb_kategori_produk where id_kategori = '$id' and soft_delete = 0");
    if (mysqli_num_rows($sql) > 0) {
        $kat = mysqli_fetch_array($sql); ?>
        <form action="setCategory" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="mdi mdi-delete-alert-outline"></i> Hapus Kategori</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" disabled value="<?= $kat['kategori'] ?>" aria-describedby="defaultFormControlHelp" required>
                </div>
                <small class="text-danger fw-bold">Note : Penghapusan data kategori akan mempengaruhi data transaksi yang sudah tercatat.</small>

                <div class="mt-3">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="hapus_kat" name="cek">
                            <label class="form-check-label" for="hapus_kat">Saya yakin akan menghapus <strong>Data Kategori</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($kat['id_kategori']) ?>" name="_token">
                <button type="submit" name="delCategory" class="btn btn-info" id="delKat" disabled>Hapus</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#hapus_kat').click(function() {
                if ($(this).is(':checked')) {

                    $('#delKat').removeAttr('disabled');

                } else {
                    $('#delKat').attr('disabled', true);
                }
            });
        </script>
    <?php } else { ?>
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Error</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">Data Tidak Ditemukan</h2>
        </div>
<?php }
} else {
    echo '<script type="text/javascript">
    window.location = "../"
    </script>';
} ?>