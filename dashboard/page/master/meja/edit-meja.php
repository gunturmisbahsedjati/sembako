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
    $sql = mysqli_query($myConnection, "select * from tb_meja where id_meja = '$id' and soft_delete = 0");
    if (mysqli_num_rows($sql) > 0) {
        $kat = mysqli_fetch_array($sql); ?>
        <form action="setTable" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="mdi mdi-tag-edit-outline"></i> Edit Meja</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Meja</label>
                    <input type="text" class="form-control" placeholder="Meja 1" name="meja" value="<?= $kat['meja'] ?>" aria-describedby="defaultFormControlHelp" required>
                </div>
                <small class="text-danger fw-bold">Note : Mengubah data meja akan mempengaruhi data transaksi yang sudah tercatat.</small>

                <div class="mt-3">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_meja" name="cek">
                            <label class="form-check-label" for="edit_meja">Saya yakin akan melakukan perubahan <strong>Data Meja</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= encrypt($kat['id_meja']) ?>" name="_token">
                <button type="submit" name="editTable" class="btn btn-info" id="updateMeja" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#edit_meja').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateMeja').removeAttr('disabled');

                } else {
                    $('#updateMeja').attr('disabled', true);
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