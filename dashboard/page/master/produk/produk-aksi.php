<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "category"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['addCategory'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $kategori = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['kategori']));

        $insertCategory = mysqli_query($myConnection, "insert into tb_kategori_produk (id_kategori, kategori) values ('$code', '$kategori')");
        if ($insertCategory) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil ditambahkan'})";
            echo "<script> window.location='category'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal ditambahkan'})";
            echo "<script> window.location='category'; </script>";
        }
    } elseif (isset($_POST['editCategory'])) {
        $created_by = $_SESSION['id'];
        $id_kategori = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $kategori = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['kategori']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_kategori_produk where id_kategori = '$id_kategori'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $update = mysqli_query($myConnection, "update tb_kategori_produk set kategori = '$kategori' where soft_delete = 0 and id_kategori = '$id_kategori'");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil diubah'})";
                echo "<script> window.location='category'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal diubah'})";
                echo "<script> window.location='category'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='category'; </script>";
        }
    } elseif (isset($_POST['delCategory'])) {
        $created_by = $_SESSION['id'];
        $id_kategori = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $kategori = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['kategori']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_kategori_produk where id_kategori = '$id_kategori'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $update = mysqli_query($myConnection, "update tb_kategori_produk set soft_delete = 1 where soft_delete = 0 and id_kategori = '$id_kategori'");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data Kategori berhasil dihapus'})";
                echo "<script> window.location='category'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data Kategori gagal dihapus'})";
                echo "<script> window.location='category'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='category'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "category"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
