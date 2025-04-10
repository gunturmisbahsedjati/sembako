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
        <div class="card ">
            <div class="card-header ">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Daftar Barang</h5>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-sm btn-primary" title="Tambah User" accesskey="w" data-bs-toggle="modal" data-bs-target="#addProduct">
                            <span class="tf-icons mdi mdi-plus-circle-outline"></span> Tambah Barang
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap mt-4">
                    <table id="member_table" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap align-middle">No.</th>
                                <th class="text-center text-nowrap align-middle">Nama Barang</th>
                                <th class="text-center text-nowrap align-middle">Satuan</th>
                                <th class="text-center text-nowrap align-middle">Jumlah</th>
                                <th class="text-center text-nowrap align-middle">Harga Beli</th>
                                <th class="text-center text-nowrap align-middle">Harga Jual</th>
                                <th class="text-center text-nowrap align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sqlKategori = mysqli_query($myConnection, "select * from tb_kategori_produk where soft_delete =0");
                            while ($viewKategori = mysqli_fetch_array($sqlKategori)) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-icon btn-info me-2" data-bs-toggle="modal" title="Edit Kategori" data-bs-target="#editCategory" data-id="<?= $viewKategori['id_kategori'] ?>">
                                            <span class="tf-icons mdi mdi-square-edit-outline"></span>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" title="Hapus Kategori" data-bs-target="#delCategory" data-id="<?= $viewKategori['id_kategori'] ?>">
                                            <span class="tf-icons mdi mdi-delete-circle-outline"></span>
                                        </button>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?= "Process took " . number_format(microtime(true) - $time_start, 2) . " seconds."; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProduct" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-add-product" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="add-product" id="add-product"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCategory" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleEditModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-edit-category" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="edit-category" id="edit-category"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delCategory" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="exampledelModal" aria-hidden="true" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="load-del-category" style="display: none;">
                    <div class="modal-body">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        loading......
                    </div>
                </div>
                <div class="del-category" id="del-category"></div>
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