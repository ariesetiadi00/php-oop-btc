<?php

// Require init file
require_once '../init.php';

if (isset($_POST['delete_payment'])) {
    $member_model->delete_payment($_POST['id']);
}
$member_model->delete($_POST['id']);

// redirect ke index member
$_SESSION['message'] = "Data Member Berhasil Dihapus";
header('Location: ' . URL . '/view/member/index.php');
