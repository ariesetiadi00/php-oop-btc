<?php
// Require init file
require_once '../init.php';

if ($member_model->create($_POST)) {
    $_SESSION['message'] = "Member Baru Berhasil Ditambahkan";
    header('Location: ' . URL . '/view/member/index.php');
} else {
    $_SESSION['message'] = "Member Baru Gagal Ditambahkan";
    header('Location: ' . URL . '/view/member/index.php');
}
