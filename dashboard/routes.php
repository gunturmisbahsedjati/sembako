<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'page/home.php');
        break;

        //page master
    case 'user':
        require_once(PUB_DIR . 'page/master/data_user.php');
        break;
    case 'setUser':
        require_once(PUB_DIR . 'page/master/user/user-aksi.php');
        break;
    case 'category':
        require_once(PUB_DIR . 'page/master/data_kategori.php');
        break;
    case 'setCategory':
        require_once(PUB_DIR . 'page/master/kategori/kategori-aksi.php');
        break;
    case 'table':
        require_once(PUB_DIR . 'page/master/data_meja.php');
        break;
    case 'setTable':
        require_once(PUB_DIR . 'page/master/meja/meja-aksi.php');
        break;
    case 'product':
        require_once(PUB_DIR . 'page/master/data_produk.php');
        break;
    case 'setProduct':
        require_once(PUB_DIR . 'page/master/produk/produk-aksi.php');
        break;

        //signout
    case 'logout':
        require_once(PUB_DIR . '../signout.php');
        break;

    default:
        require_once(PUB_DIR . 'page/home.php');
}
