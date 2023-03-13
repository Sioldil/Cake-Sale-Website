<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function insert_category($cate_name)
    {
        $cate_name = $this->fm->validation($cate_name);
        $cate_name = mysqli_real_escape_string($this->db->link, $cate_name);

        if (empty($cate_name)) {
            $alert = "Category can't be empty";
            return $alert;
        } else {
            $check_cate = "SELECT * FROM category WHERE CategoryName='$cate_name' LIMIT 1";
            $result_check = $this->db->select($check_cate);
            if ($result_check) {
                $alert = "<span class = 'error'>Category already existed</span>";
            } else {
                $query = "INSERT INTO category(CategoryName) VALUES('$cate_name')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='sucsess'>Insert category successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Insert category not success</span>";
                }
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM category order by Name ASC";
        $result = $this->db->select($query);
        return $result;
    }
}

?>