<?php
// Require init file
require_once '../init.php';

// Filter User Input
$username = htmlspecialchars(strtolower($_POST['username']));
$password = htmlspecialchars(strtolower($_POST['password']));

// Login proses
$auth->login($username, $password);
