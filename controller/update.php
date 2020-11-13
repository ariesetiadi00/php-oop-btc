<?php
// Require init file
require_once '../init.php';

if ($member_model->update($_POST)) {
    $_SESSION['message'] = "Data Member Berhasil Dirubah";
    header('Location: ' . URL . '/view/member/index.php');
} else {
    $_SESSION['message'] = "Data Member Gagal Dirubah";
    header('Location: ' . URL . '/view/member/index.php');
}
