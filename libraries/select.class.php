<?php
class SelectList
{
    protected $conn;
 
        public function __construct()
        {
            $this->DbConnect();
        }
 
        protected function DbConnect()
        {
            include "db_config.php";
            $this->conn = mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db,$this->conn) OR die("can not select the database $db");
            return TRUE;
        }
 
/*         public function ShowCategory()
        {
            $sql = "SELECT * FROM category";
            $res = mysql_query($sql,$this->conn);
            $category = '<option value="0">choose...</option>';
            while($row = mysql_fetch_array($res))
            {
                $category .= '<option value="' . $row['id_cat'] . '">' . $row['name'] . '</option>';
            }
            return $category;
        } */
 
        public function ShowRank()
        {
			if($_POST[id]==3){
				$sql = "SELECT rowID,rankName FROM tbl_rank WHERE forSentry='yes'";
			}
			else{
				$sql = "SELECT rowID,rankName FROM tbl_rank WHERE forSentry='no'";			
			}
			
            $res = mysql_query($sql,$this->conn);
            $rank = '<option value="">Choose...</option>';
            while($row = mysql_fetch_array($res))
            {
                $rank .= '<option value="' . $row['rowID'] . '">' . $row['rankName'] . '</option>';
            }

            return $rank;
        }
}
 
$opt = new SelectList();
?>