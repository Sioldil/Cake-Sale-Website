<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class user_register
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_user($data){
        $Fullname = mysqli_real_escape_string($this->db->link, $data['Fullname']);
        $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
        $Password = mysqli_real_escape_string($this->db->link, $data['Password']);

        $Hash_Pass = md5($Password);

        if(empty($Fullname) || empty($Email) || empty($Password)){
            $alert = "<span class = 'error'>Fields must not be empty</span>";
            return $alert;
        }else{
            $check_Email = "SELECT * FROM customers WHERE Email='$Email' LIMIT 1";
            $result_check = $this->db->select($check_Email);
            if($result_check){
                $alert = "<span class = 'error'>Email already existed</span>";
            }else{
                $query = "INSERT INTO customers(Fullname,Email,Password) VALUES('$Fullname','$Email','$Hash_Pass')";
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