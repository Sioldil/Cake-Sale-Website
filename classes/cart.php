<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");
?>

<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

     function total_price($cart){
        $total_price = 0;
        foreach($cart as $key => $value){
            $total_price += $value['sellprice']  * $value['quantity'];
        }
        return $total_price;
    }

}

?>