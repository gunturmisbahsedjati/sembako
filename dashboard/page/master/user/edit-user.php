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
    $sql = mysqli_query($myConnection, "select * from tb_akun_manajemen where soft_delete = 0 and id_manajemen = '$id'");
    if (mysqli_num_rows($sql) > 0) {
        $peg = mysqli_fetch_array($sql); ?>
        <form action="setUser" method="post" role="form" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <h4><i class="bx bx-folder-plus"></i> Edit Akses User</h4>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text" class="form-control" placeholder="nama akun" value="<?= $peg['nama_manajemen'] ?>" aria-describedby="defaultFormControlHelp" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="nama akun" value="<?= $peg['user_manajemen'] ?>" aria-describedby="defaultFormControlHelp" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" placeholder="kata sandi" value="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="defaultFormControlHelp" readonly disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hak Akses</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" name="akses[]" id="defaultCheck1" <?= in_array(2, explode(",", $peg['level_manajemen'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="defaultCheck1"> Admin Cafe </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="3" name="akses[]" id="defaultCheck2" <?= in_array(3, explode(",", $peg['level_manajemen'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="defaultCheck2"> Kasir Cafe </label>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-check">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="edit_akun" name="cek">
                            <label class="form-check-label" for="edit_akun">Saya yakin akan melakukan perubahan <strong>Akses User</strong>.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $peg['id_manajemen'] ?>" name="_token">
                <button type="submit" name="editUser" class="btn btn-info" id="updateAkun" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batal</button>
            </div>
        </form>
        <script type="text/javascript">
            $('#edit_akun').click(function() {
                if ($(this).is(':checked')) {

                    $('#updateAkun').removeAttr('disabled');

                } else {
                    $('#updateAkun').attr('disabled', true);
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