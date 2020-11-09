<?php
class PaymentModel extends Database
{
    public function __construct()
    {
        // Database Connection
        parent::__construct();
    }


    // Get All Payment
    public function get_all()
    {
        // Prepare SQL for all member data
        $sql = "SELECT * FROM member_payment ORDER BY id DESC";

        // Execute query
        $res = mysqli_query($this->db, $sql);

        // Looping fetching data
        while ($r = mysqli_fetch_assoc($res)) {
            $member[] = $r;
        }

        // Return all payment data
        return $member;
    }

    public function get($id)
    {

        // Prepare SQL and array
        $history = array();
        $sql = "SELECT * FROM member_payment WHERE member_id = '$id' ORDER BY member_payment.month DESC";

        // get result
        $res = mysqli_query($this->db, $sql);

        // Looping fetch data
        while ($r = mysqli_fetch_assoc($res)) {
            $history[] = $r;
        }

        // Return History
        return $history;
    }

    // Get Debt by ID
    public function get_debt($id)
    {
        // Prepare Array 
        $debt = array();
        $sql = "SELECT * FROM member_payment_debt WHERE member_id = '$id' ORDER BY member_payment_debt.month DESC";

        // Query data
        $res = mysqli_query($this->db, $sql);

        // Execute
        while ($r = mysqli_fetch_assoc($res)) {
            $debt[] = $r;
        }

        return $debt;
    }

    // Cek debt
    public function debt($status, $id)
    {
        // prepare data debt
        $month = date('m');
        $created_at = date('today');

        // Jika belum bayar bulan ini
        if (!$status) {
            // Cek apakah data hutang sudah tercatat
            $sql = "SELECT * FROM member_payment_debt WHERE 
                    member_payment_debt.member_id = '$id' AND
                    member_payment_debt.month = '$month'
                    ";

            // Jika belum tercatat, maka insert ke table debt 
            if (!mysqli_fetch_assoc(mysqli_query($this->db, $sql))) {
                // Siapkan SQL untuk insert data debt
                $sql = "INSERT INTO member_payment_debt VALUES (0, '$id', '$month', '$created_at')";
                // Execute
                mysqli_query($this->db, $sql);
            }
        }
    }

    public function get_price()
    {
        return mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM member_payment_price"));
    }

    // Insert payment
    public function insert_payment($member_id, $month, $price, $created_at)
    {
        // Prepare SQL
        $sql = "INSERT INTO member_payment VALUES (0, '$member_id', '$month', '$price', '$created_at')";
        return mysqli_query($this->db, $sql);
    }
}
