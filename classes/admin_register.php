<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class admin_register
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_Admin($data){
        $Username = mysqli_real_escape_string($this->db->link, $data['Username']);
        $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
        $Password = mysqli_real_escape_string($this->db->link, $data['Password']);

        $Hash_Pass = md5($Password);

        if(empty($Username) || empty($Email) || empty($Password)){
            $alert = "<span class = 'error'>Fields must not be empty</span>";
            return $alert;
        }else{
            $check_Email = "SELECT * FROM admin WHERE Email='$Email' LIMIT 1";
            $result_check = $this->db->select($check_Email);
            if($result_check){
                $alert = "<span class = 'error'>Email already existed</span>";
            }else{
                $query = "INSERT INTO admin(Username,Email,Password,Role) VALUES('$Username','$Email','$Hash_Pass','2')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class = 'success'>Register succesfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'error'>Register failed</span>";
                    return $alert;
                }
            }
        }
    }
}

?>