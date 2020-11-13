<?php
// Base URL
const URL = "http://localhost/btc-pay";

// Start Session
session_start();

// Require Function
require_once 'function/Database.php';
require_once 'function/Auth.php';

// Require Model
require_once 'model/MemberModel.php';
require_once 'model/PaymentModel.php';

// Instance Function Class
$auth = new Auth();

// Instance Model Class
$member_model = new MemberModel();
$payment_model = new PaymentModel();

// Global Property
$date = new DateTime('now', new DateTimeZone('Asia/Shanghai'));
$price = $payment_model->get_price()['price'];
$member = $member_model->get_member_count();
$payment = $payment_model->get_all();
$id_pay = "BT00";
