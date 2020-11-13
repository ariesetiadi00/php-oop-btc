<?php
$harga =  $_POST['harga'];

// Require init file
require_once '../init.php';

if ($payment_model->changePrice($harga)) {
    $_SESSION['message'] = "Harga Berhasil Diubah";
    header('Location: ' . URL . '/view/admin/index.php');
} else {
    $_SESSION['message'] = "Harga Gagal Diubah";
    header('Location: ' . URL . '/view/admin/index.php');
}
