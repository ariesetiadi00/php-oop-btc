<?php
// Require init
require_once $_SERVER['DOCUMENT_ROOT'] . '/btc-pay/init.php';

$member_id = $_POST['id'];
$month = $_POST['bulan'];
$created_at = $_POST['tanggal'];

if ($payment_model->insert_payment($member_id, $month, $price, $created_at)) {
    $_SESSION['message'] = "Pembayaran Berhasil Dilakukan";
    header('Location: ' . URL . '/view/member/detail.php?id=' . $member_id);
} else {
    $_SESSION['message'] = "Pembayaran Gagal Dilakukan";
    header('Location: ' . URL . '/view/member/detail.php?id=' . $member_id);
}
