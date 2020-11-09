<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/btc-pay/init.php';

class MemberModel extends Database
{
    public function __construct()
    {
        // Database Connection
        parent::__construct();
    }

    // Get All Member
    public function get_all()
    {
        // Prepare SQL for all member data
        $sql = "SELECT * FROM member ORDER BY id DESC";

        // Execute query
        $res = mysqli_query($this->db, $sql);

        // Looping fetching data
        while ($r = mysqli_fetch_assoc($res)) {
            $member[] = $r;
        }

        // Return all member data
        return $member;
    }

    // Get One Member
    public function get($id)
    {
        // Prepare SQL for one member data
        $sql = "SELECT * FROM member WHERE id = '$id'";

        // Return query result of one member
        return mysqli_fetch_assoc(mysqli_query($this->db, $sql));
    }

    // Cek payment status
    public function status($member_id)
    {
        global $date;
        // Get Month
        $month = $date->format('m');

        // Cek apakah ada pembayaran di bulan ini
        $sql = "SELECT * FROM member_payment WHERE 
                member_payment.member_id = '$member_id' AND
                member_payment.month = '$month'";

        // get Result
        return mysqli_fetch_assoc(mysqli_query($this->db, $sql));
    }

    // Cek payment status
    public function status_pay($member_id, $month)
    {

        // Cek apakah ada pembayaran di bulan ini
        $sql = "SELECT * FROM member_payment WHERE 
                member_payment.member_id = '$member_id' AND
                member_payment.month = '$month' ";

        // get Result
        return mysqli_fetch_assoc(mysqli_query($this->db, $sql));
    }


    // Count Age
    public static function age($then)
    {
        $then = new DateTime($then);
        $now = new DateTime('today');

        // Cari perbedaan antara tanggal lahir dan waktu sekarang
        return $then->diff($now)->y;
    }

    // Parse Date
    public function parse_date($date)
    {
        return date('j F Y', strtotime($date));
    }


    // Gender
    public function gender($g)
    {
        if ($g == 'm') {
            return "Laki - laki";
        } else {
            return "Perempuan";
        }
    }

    // Month
    public function month($month)
    {
        return date('F', mktime(0, 0, 0, $month));
    }
}
