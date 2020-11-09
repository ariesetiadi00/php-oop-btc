<?php
class Auth extends Database
{
    public function __construct()
    {
        // Database Connection
        parent::__construct();
    }

    public function login($username, $password)
    {
        // Check similar username in database
        $sql = "SELECT * FROM user WHERE username = '$username'";

        // Query Result - Username
        $res = mysqli_fetch_assoc(mysqli_query($this->db, $sql));

        // Check username result
        if ($res) {
            // Check Passrow verify
            if (password_verify($password, $res['password'])) {
                $_SESSION['login'] = $res;
                $_SESSION['title'] = "Dashboard";
                header("Location: " . URL . "/view/admin/index.php");
            } else {
                $_SESSION['message'] = "Password Salah";
                header("Location: " . URL);
            }
        } else {
            $_SESSION['message'] = "Username Tidak Terdaftar";
            header("Location: " . URL);
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
    }
}
