<?php

include_once 'inc.library.php';

$text = 'Dr. Nursamsu, M.Pd';

$textEncrypt = encrypt($text);
$textDecrypt = decrypt($textEncrypt);

echo 'Normal : ' . $text . '<br> Enkripsi : ' . $textEncrypt . '<br> Dekripsi : ' . $textDecrypt;
