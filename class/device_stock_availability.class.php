<?php

require_once __DIR__ . '/../lib/db.class.php';
require_once __DIR__ . '/system.class.php';


class DeviceStockAvailability
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
    $this->sysClass = new SystemClass();
    $this->username = $_SESSION['username'];
  }

  /**
   * Get device stock availability from table `device_type` and `device_list``
   * @return 
   */
  public function getStock()
  {
    $query = 'SELECT device_id, type_name, type_code, device_code, device_quantity, minimum_quantity FROM device_list INNER JOIN device_type USING(type_id);';
    $result = $this->db->query($query);
    return $result;
  }

  /**
   * @param int $device_id
   * @return array
   */
  public function findDeviceList($device_id)
  {
    $query = "select device_id from device_list where device_id = $device_id";
    $result = $this->db->query($query);
    return $result;
  }

  /**
   * Update `minimum_quantity` di table `device_list`
   * @param int $device_id
   * @param int $minimum_quantity
   */
  public function updateQuantityMinimum($device_id, $minimum_quantity)
  {
    $query = "UPDATE device_list SET minimum_quantity = '$minimum_quantity', updated_by = '$this->username', updated_date = NOW(), revision = revision+1 WHERE device_id = $device_id";
    $result = $this->db->query($query);
    // Jika berhasil update => create system log
    if ($result > 0) {
      $this->sysClass->save_system_log($_SESSION['username'], $query);
      $_SESSION['save_status'] = 'Berhasil! Update quantity minimum';
      $_SESSION['save_type'] = 'success';
    } else {
      $_SESSION['save_status'] = 'Gagal! Update quantity minimum';
      $_SESSION['save_type'] = 'danger';
    }
  }
}
