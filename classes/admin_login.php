<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lib/session.php");
Session::checkLogin();
include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class admin_login
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_admin($Email, $Password)
    {
        $Email = $this->fm->validation($Email);
        $Password = $this->fm->validation($Password);

        $Email = mysqli_real_escape_string($this->db->link, $Email);
        $Password = mysqli_real_escape_string($this->db->link, $Password);

        $Hash_Pass = md5($Password);

        if (empty($Email) || empty($Password)) {
            $alert = "User and Pass can't be empty";
            return $alert;
        } else {
            $query = "SELECT * FROM admin WHERE Email = '$Email' AND Password = '$Hash_Pass' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login', true);
                Session::set('Id', $value['Id']);
                Session::set('Email', $value['Email']);
                Session::set('Username',$value['Username']);
                header('Location:index.php');
            } else {
                $alert = "Email or Password not match";
                return $alert;
            }
        }
    }
}

?>