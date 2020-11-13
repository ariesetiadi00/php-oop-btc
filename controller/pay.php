<?php
var_dump($_POST);
// Require init
require_once $_SERVER['DOCUMENT_ROOT'] . '/btc-pay/init.php';

$member_id = $_POST['id'];
$image = $_POST['image'];
$name = $_POST['name'];
$month = $_POST['bulan'];
$created_at = $_POST['tanggal'];

if ($payment_model->insert_payment($member_id, $image, $name, $month, $price, $created_at)) {
    // Jik sudah terbayar, hapus tunggakan dari member tersebut
    $payment_model->del_debt($member_id, $month);

    $_SESSION['message'] = "Pembayaran Berhasil Dilakukan";
    header('Location: ' . URL . '/view/member/detail.php?id=' . $member_id);
} else {
    $_SESSION['message'] = "Pembayaran Gagal Dilakukan";
    header('Location: ' . URL . '/view/member/detail.php?id=' . $member_id);
}
