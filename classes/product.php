<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class Products
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
}

?>