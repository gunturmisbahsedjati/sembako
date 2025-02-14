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
?>
<form action="setTable" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4><i class="mdi mdi-plus-box-outline"></i> Tambah Meja</h4>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Nama Meja</label>
            <input type="text" class="form-control" placeholder="Meja 1" name="meja" aria-describedby="defaultFormControlHelp" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="addTable" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
    </div>
</form>