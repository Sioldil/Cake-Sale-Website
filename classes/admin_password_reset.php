<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class admin_reset_pass
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function reset_pass($Email)
    {
        $Email = $this->fm->validation($Email);
        $Token = md5(rand());

        $Email = mysqli_real_escape_string($this->db->link, $Email);

        if (empty($Email)){
            $alert = "Email can't be empty";
            return $alert;
        } else {
            $query = "SELECT * FROM admin WHERE Email = '$Email' LIMIT 1";
            $result = $this->db->select($query);
        }

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $get_name = $row['Username']; 
            $get_email = $row['Email'];

            $update_token = "UPDATE admin SET "
        }else{
            $_SESSION['status'] = "No Email Found";
            header("Location: forgot_password.php");
            exit(0);
        }
    }
}
?>