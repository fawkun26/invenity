<?php
require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/../class/inventory.class.php');
require_once(__DIR__ . '/../class/location.class.php');
require_once(__DIR__ . '/../class/system.class.php');

class DelClass
{
function __construct()
	{
		$this->db        = new DB();
		$this->inventory = new inventory();
		$this->locClass  = new LocationClass();
		$this->sysClass  = new SystemClass();
	}

public  function delete(){

$bpp_id = $_GET['bpp_id'];
mysql_query("DELETE FROM bpp WHERE bpp_id='$bpp_id'")or die(mysql_error());

header ("http://localhost/invenity/bpp.php?pesan=hapus");
}

// function delete($bpp_id){
// $query = "DELETE from bpp where bpp_id='".$_GET['bpp_id']."'";
// $select= $this->db->query($query) or die($query);
// //$query = mysqli_query($DB, $select) or die($select);
// header ("http://localhost/invenity/dashboard.php");
// }
 }
?>