<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class Brands
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    //Hiển thị danh sách phản hồi người dùng
    public function show_Contact(){
        $query = "SELECT *FROM contacts order by name asc";
        $result = $this->db->select($query);
        return $result;
    }

    



}

?>
