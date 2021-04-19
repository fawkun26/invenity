<?php

/**
 * Device Class
 * Device management class such as device, device type
 *
 * @author 		Mohamad Ilham Ramadhan
 * @version 		1.0
 */
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/../class/inventory.class.php');
require_once(__DIR__ . '/../class/location.class.php');
require_once(__DIR__ . '/../class/system.class.php');
require_once(__DIR__ . '/../class/device.class.php');

use Carbon\Carbon;

class BPPHistoryClass
{
  function __construct()
  {
    $this->db        = new DB();
    $this->inventory = new inventory();
    $this->locClass  = new LocationClass();
    $this->sysClass  = new SystemClass();
  }

  public function add()
  {
  }

  public function get_by_current_day_and_month()
  {
    $hari = Carbon::now()->format('d');
    $bulan = Carbon::now()->format('m');
    $result = $this->db->query("SELECT * FROM bpp_history WHERE month(created_at) = '$bulan' AND day(created_at) = '$hari' ORDER BY created_at");

    return $result;
  }
  public function get_all_with_total_bpp_and_device() {
    $query = "SELECT nomor, DATE(created_at) AS tanggal, COUNT(*) AS total_bpp, SUM(bpp.out_quantity) AS total_out_quantity FROM bpp_history INNER JOIN bpp ON bpp_history.nomor = bpp.bpp_history_nomor GROUP BY nomor";
    $result = $this->db->query($query);

    return $result;
  }
}
