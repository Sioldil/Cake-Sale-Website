<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lib/session.php");
Session::checkLogin();
include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class user_login
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_user($Email, $Password)
    {
        $Email = $this->fm->validation($Email);
        $Password = $this->fm->validation($Password);

        $Email = mysqli_real_escape_string($this->db->link, $Email);
        $Password = mysqli_real_escape_string($this->db->link, $Password);

        $Hash_Pass = md5($Password);

        if (empty($Email) || empty($Password)) {
            $alert = "Email and Pass can't be empty";
            return $alert;
        } else {
            $query = "SELECT * FROM customers WHERE Email = '$Email' AND Password = '$Hash_Pass' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login', true);
                Session::set('CustomerId', $value['CustomerId']);
                Session::set('Email', $value['Email']);
                Session::set('Name',$value['Name']);
                header('Location:index.php');
            } else {
                $alert = "Email or Password not match";
                return $alert;
            }
        }
    }
}

?>