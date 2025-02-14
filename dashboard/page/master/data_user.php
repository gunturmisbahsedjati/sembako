<?php
$time_start = microtime(true);
require_once './inc/inc.koneksi.php';
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
<?php
$arrayAkses = explode(",", $_SESSION['level']);
if (in_array(1, $arrayAkses)) { ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header ">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Data User</h5>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-sm btn-primary" title="Tambah User" accesskey="w" data-bs-toggle="modal" data-bs-target="#addUser">
                            <span class="tf-icons mdi mdi-plus-circle-outline"></span> Tambah User
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap mt-4">
                    <table id="member_table" class="table table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap align-middle">No.</th>
                                <th class="text-center text-nowrap align-middle">Username</th>
                                <th class="text-center text-nowrap align-middle">Nama</th>
                                <th class="text-center text-nowrap align-middle">Akses</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlAkun = mysqli_query($myConnection, "select * from tb_akun_manajemen where soft_delete = 0 and level_manajemen in (2,3) and id_manajemen !='36daf4c0c9652712fd970ebacbe082fc'");
                            while ($viewAkun = mysqli_fetch_array($sqlAkun)) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $viewAkun['user_manajemen'] ?></td>
                                    <td><?= ucwords(mb_strtolower($viewAkun['nama_manajemen'])) ?></td>
                                    <td>
                                        <?php
                                        $listAkses = $viewAkun['level_manajemen'];
                                        $sqlAkses = mysqli_query($myConnection, "select ket, level from tb_level_akun where id_level_akun in ($listAkses)");
                                        while ($viewAkses = mysqli_fetch_array($sqlAkses)) {
                                            echo $viewAkses['ket'] . '<br>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-icon btn-info me-2" data-bs-toggle="modal" title="Edit Akses User" data-bs-target="#editUser" data-id="<?= $viewAkun['id_manajemen'] ?>">
                                            <span class="tf-icons mdi mdi-square-edit-outline"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" title="Hapus Data User" data-bs-target="#delUser" data-id="<?= $viewAkun['id_manajemen'] ?>">
                                            <span class="tf-icons mdi mdi-delete-circle-outline"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addUser" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-add-user" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="add-user" id="add-user"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUser" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-edit-user" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="edit-user" id="edit-user"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delUser" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampledelModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-del-user" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="del-user" id="del-user"></div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card border border-primary col-6">
            <div class="card-body">
                <h2>Nyari apa.... 🤣</h2>
                <p>Error 404<br>Object not found!<br>The requested URL was not found on this server.</p>
            </div>
        </div>
    </div>
<?php } ?>