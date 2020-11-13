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
        $member = [];

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

    // Insert new member
    public function create($data)
    {
        // Set image base on gender
        if ($data['gender'] == 'm') {
            $image = 'd-male.png';
        } else {
            $image = 'd-female.png';
        }

        // Set created and updated at
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        // Catch POST data
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tmp_lahir = $_POST['tmp_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $agama = $_POST['agama'];
        $gender = $_POST['gender'];
        $telepon = $_POST['telepon'];

        $sql = "INSERT INTO member VALUES (
                0,
                '$nama',
                '$alamat',
                '$tmp_lahir',
                '$tgl_lahir',
                '$agama',
                '$telepon',
                '$gender',
                '$image',
                '$created_at',
                '$updated_at'
        )";

        return mysqli_query($this->db, $sql);
    }

    // UPdate
    public function update($data)
    {
        // Set image base on gender
        if ($data['gender'] == 'm') {
            $image = 'd-male.png';
        } else {
            $image = 'd-female.png';
        }

        // Set created and updated at
        $updated_at = date('Y-m-d H:i:s');

        // Catch POST data
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tmp_lahir = $_POST['tmp_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $agama = $_POST['agama'];
        $gender = $_POST['gender'];
        $telepon = $_POST['telepon'];

        $sql = "UPDATE member SET
                member.name = '$nama',
                member.address = '$alamat',
                birth_place = '$tmp_lahir',
                birth_date = '$tgl_lahir',
                religion = '$agama',
                phone = '$telepon',
                gender = '$gender',
                member.image = '$image',
                updated_at = '$updated_at'
            WHERE id = '$id'
        ";
        return mysqli_query($this->db, $sql);
    }

    // Delete member
    public function delete($id)
    {
        return mysqli_query($this->db, "DELETE FROM member WHERE id = '$id'");
    }

    // delete member payment
    public function delete_payment($id)
    {
        return mysqli_query($this->db, "DELETE FROM member_payment WHERE member_id = '$id'");
    }

    // Get member Count
    public function get_member_count()
    {
        $member = [];
        $total = [];
        $pria = [];
        $wanita = [];

        // Total member
        $res_total = mysqli_query($this->db, "SELECT * FROM member");
        $res_pria = mysqli_query($this->db, "SELECT * FROM member WHERE gender = 'm'");
        $res_wanita = mysqli_query($this->db, "SELECT * FROM member WHERE gender = 'f'");

        if (!$res_total) {
            $total[] = 0;
            $pria[] = 0;
            $wanita[] = 0;
        } else {
            while ($r = mysqli_fetch_assoc($res_total)) {
                $total[] = $r;
            }

            // Total Wanita
            while ($r = mysqli_fetch_assoc($res_wanita)) {
                $wanita[] = $r;
            }

            // Total Pria
            while ($r = mysqli_fetch_assoc($res_pria)) {
                $pria[] = $r;
            }
        }

        $member = [$total, $wanita, $pria];


        return $member;
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

    // Get gender
    public function get_gender()
    {
        $sql = "SELECT * FROM member_gender";
        $gender = array();
        $res = mysqli_query($this->db, $sql);
        // return mysqli_fetch_assoc(mysqli_query($this->db, $sql));
        while ($r = mysqli_fetch_assoc($res)) {
            $gender[] = $r;
        }

        return $gender;
    }

    // Month
    public function month($month)
    {
        return date('F', mktime(0, 0, 0, $month));
    }

    // Get religion
    public function get_religion()
    {
        $religion = array();
        $sql = "SELECT * FROM member_religion";
        $res = mysqli_query($this->db, $sql);
        while ($r = mysqli_fetch_assoc($res)) {
            $religion[] = $r;
        }
        return $religion;
    }
}
