<?php
require_once '../init.php';

$auth->logout();

header("Location: " . URL);
