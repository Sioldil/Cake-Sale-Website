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

    //Hiển thị danh sách thương hiệu
    public function show_Brands()
    {
        $query = "SELECT *FROM BRANDS order by name asc";
        $result = $this->db->select($query);
        return $result;
    }


    //Thêm mới thương hiệu
    public function insert_Brand($data,$file)
    {
        //Kiểm tra xem tên thương hiệu có hợp lệ hay chưa
        $brand_name = mysqli_real_escape_string($this->db->link, $data['brand_name']);

        $permited = array('.jpg', '.png', '.gif', '.jepg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $div = explode(".", $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $upload_image = "uploads/".$unique_image;


        if (empty($brand_name)) {
            $alter = "Tên thương hiệu không được để trống";
            return $alter;
        }
        else if(empty($brand_image)){
            $alter = "Hình ảnh không được để trống";
            return $alter;
        } else {
            //Kiểm tra tên thương hiệu đã tồn tại trong danh sách hay chưa ?
            $check_brand_name = "SELECT *FROM brands WHERE Name='$brand_name' LIMIT 1";
            $result_check = $this->db->select($check_brand_name);
            if ($result_check) {
                $alert = "<span class = 'error'>Tên thương hiệu đã tồn tại !!!</span>";
            } else {
                move_uploaded_file($file_tmp,$upload_image);
                $query = "INSERT INTO Brands(Name,Image) Values Name='$brand_name' Image=$unique_image";
                $result = $this->db->insert($query);
                if ($result) {
                    $alter = "Thêm mới thương hiệu thành công";
                    return $alter;
                } else {
                    $alter = "Thêm mới thương hiệu thất bại ";
                    return $alter;
                }
            }
        }
    }


    //Cập nhật thông tin thương hiệu
    public function get_Brand_By_Id($id)
    {
        $query = "SELECT *FROM Brands where BrandId = '$id' order by BrandId desc";
        $result = $this->db->select($query);
        return $result;
    }


    //Xóa thương hiệu
    public function delete_Brand()
    {
    }
}

?>
