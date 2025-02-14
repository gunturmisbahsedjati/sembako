<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "table"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['addTable'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $meja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['meja']));

        $inserttable = mysqli_query($myConnection, "insert into tb_meja (id_meja, meja) values ('$code', '$meja')");
        if ($inserttable) {
            $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data meja berhasil ditambahkan'})";
            echo "<script> window.location='table'; </script>";
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data meja gagal ditambahkan'})";
            echo "<script> window.location='table'; </script>";
        }
    } elseif (isset($_POST['editTable'])) {
        $created_by = $_SESSION['id'];
        $id_meja = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $meja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['meja']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_meja where id_meja = '$id_meja'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $update = mysqli_query($myConnection, "update tb_meja set meja = '$meja' where soft_delete = 0 and id_meja = '$id_meja'");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data meja berhasil diubah'})";
                echo "<script> window.location='table'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data meja gagal diubah'})";
                echo "<script> window.location='table'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='table'; </script>";
        }
    } elseif (isset($_POST['delTable'])) {
        $created_by = $_SESSION['id'];
        $id_meja = mysqli_escape_string($myConnection, decrypt($_POST['_token']));
        $meja = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['meja']));
        $sqlCekID = mysqli_query($myConnection, "select * from tb_meja where id_meja = '$id_meja'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $update = mysqli_query($myConnection, "update tb_meja set soft_delete = 1 where soft_delete = 0 and id_meja = '$id_meja'");
            if ($update) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data meja berhasil dihapus'})";
                echo "<script> window.location='table'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data meja gagal dihapus'})";
                echo "<script> window.location='table'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='table'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "table"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
