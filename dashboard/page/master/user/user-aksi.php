<?php
include_once 'inc/inc.koneksi.php';
include_once 'inc/inc.library.php';
if (!isset($_SESSION['status_login'])) {
    echo '<script type="text/javascript">
    window.location = "user"
    </script>';
    exit;
}
$arrayAkses = explode(",", $_SESSION['level']);

if (in_array(1, $arrayAkses)) {
    if (isset($_POST['addUser'])) {
        $code2 = time() . '-' . uniqid();
        $code = strtoupper($code2);
        $created_by = $_SESSION['id'];
        $nama = htmlspecialchars(mysqli_escape_string($myConnection, $_POST['nama']));
        $username = htmlspecialchars(mysqli_escape_string($myConnection, trim($_POST['user'])));
        $sqlCekUsernama = mysqli_query($myConnection, "select user_manajemen from tb_akun_manajemen where user_manajemen = '$username'");
        if (mysqli_num_rows($sqlCekUsernama) > 0) {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Username telah terpakai'})";
            echo "<script> window.location='user'; </script>";
        } else {
            $password = encrypt($_POST['pass']);
            // $level = decrypt($_POST['level']);
            $akses = [];
            foreach ($_POST['akses'] as $arr) {
                $akses[] = $arr;
            }
            $listAkses = implode(',', $akses);
            $insertAccount = mysqli_query($myConnection, "insert into tb_akun_manajemen (id_manajemen, user_manajemen, pass_manajemen, nama_manajemen, level_manajemen, status_manajemen, created_by, created_date) values ('$code', '$username', '$password', '$nama', '$listAkses', 'aktif', '$created_by', NOW())");
            if ($insertAccount) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data User berhasil ditambahkan'})";
                echo "<script> window.location='user'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data User gagal ditambahkan'})";
                echo "<script> window.location='user'; </script>";
            }
        }
    } elseif (isset($_POST['editUser'])) {
        $created_by = $_SESSION['id'];
        $id_manajemen = mysqli_escape_string($myConnection, $_POST['_token']);
        $sqlCekID = mysqli_query($myConnection, "select user_manajemen from tb_akun_manajemen where id_manajemen = '$id_manajemen'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $akses = [];
            foreach ($_POST['akses'] as $arr) {
                $akses[] = $arr;
            }
            if (in_array(1, $akses)) {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
                echo "<script> window.location='user'; </script>";
            } else {
                $listAkses = implode(',', $akses);
                $updateAccount = mysqli_query($myConnection, "update tb_akun_manajemen set level_manajemen = '$listAkses' where soft_delete = 0 and id_manajemen = '$id_manajemen'");
                if ($updateAccount) {
                    $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Akses User berhasil diubah'})";
                    echo "<script> window.location='user'; </script>";
                } else {
                    $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Akses User gagal diubah'})";
                    echo "<script> window.location='user'; </script>";
                }
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='user'; </script>";
        }
    } elseif (isset($_POST['delUser'])) {
        $created_by = $_SESSION['id'];
        $id_manajemen = mysqli_escape_string($myConnection, $_POST['_token']);
        $sqlCekID = mysqli_query($myConnection, "select user_manajemen from tb_akun_manajemen where id_manajemen = '$id_manajemen'");
        if (mysqli_num_rows($sqlCekID) > 0) {
            $deleteAccount = mysqli_query($myConnection, "update tb_akun_manajemen set soft_delete = '1' where soft_delete = 0 and id_manajemen = '$id_manajemen'");
            if ($deleteAccount) {
                $_SESSION['alert'] = "Toast.fire({icon: 'success',title: 'Data User berhasil dihapus'})";
                echo "<script> window.location='user'; </script>";
            } else {
                $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'Data User gagal dihapus'})";
                echo "<script> window.location='user'; </script>";
            }
        } else {
            $_SESSION['alert'] = "Toast.fire({icon: 'error',title: 'SQL Injection terdeteksi'})";
            echo "<script> window.location='user'; </script>";
        }
    } else {
        echo '<script type="text/javascript">
	window.location = "user"
	</script>';
    }
} else {
    echo '<script type="text/javascript">
    window.location = "./"
    </script>';
}
