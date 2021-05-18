<?php
/**
* Device Class
* Device management class such as device, device type
*
* @author 		Permana Cakra
* @version 		0.2
*/

require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/../class/inventory.class.php');
require_once(__DIR__ . '/../class/location.class.php');
require_once(__DIR__ . '/../class/system.class.php');


class OpnameClass {
  function __construct()
	{
		$this->db        = new DB();
		$this->inventory = new inventory();
		$this->locClass  = new LocationClass();
		$this->sysClass  = new SystemClass();
	}
  public function get_all_device_for_input() {
    $query = "SELECT device_id, device_code, device_brand, device_serial, type_name, type_code FROM device_list INNER JOIN device_type USING(type_id)";
    $result = $this->db->query($query);

    return $result;
  }
}