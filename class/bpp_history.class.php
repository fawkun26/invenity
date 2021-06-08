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

  public function get_all() 
  {
    return $this->db->query("SELECT nomor, DATE(created_at) as created_at FROM bpp_history");
  }

  public function get_by_current_day_and_month()
  {
    $hari = Carbon::now()->format('d');
    $bulan = Carbon::now()->format('m');
    $result = $this->db->query("SELECT * FROM bpp_history WHERE month(created_at) = '$bulan' AND day(created_at) = '$hari' ORDER BY created_at");

    return $result;
  }
  
  
  public function get_all_with_total_bpp_and_device() {
    $query = "SELECT nomor, DATE(bpp_history.created_at) AS tanggal, COUNT(bpp.bpp_id) AS total_bpp, SUM(bpp.out_quantity) AS total_out_quantity FROM bpp_history LEFT JOIN bpp ON bpp_history.nomor = bpp.bpp_history_nomor GROUP BY nomor ORDER BY tanggal DESC";
    $result = $this->db->query($query);
    
    return $result;
  }
  
  public function get_between_nowaday_and_7daysago() {
    $nowaday = Carbon::now()->format('Y-m-d');
    $query = "SELECT nomor, DATE(created_at) as created_at FROM bpp_history WHERE created_at BETWEEN DATE_SUB('$nowaday 00:00:00', INTERVAL 7 DAY) AND '$nowaday 23:59:59'";
    $result = $this->db->query($query);
    return $result;
  }

  public function get_all_bpp_of_bpp_history($nomor) 
  {
    $query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, DATE(bpp.created_at) as tanggal FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE bpp_history_nomor = '$nomor' ORDER BY tanggal DESC";
    $result = $this->db->query($query);
    return $result;
  }
  // * semua tentang BPP/LPB Januari-Mei
  public function get_between_january_may() {
    $query = "SELECT nomor, DATE(created_at) AS created_at FROM bpp_history where nomor REGEXP '/(01|02|03|04|05)/2021?' order by substring(nomor, 9, 2) asc";
    $result = $this->db->query($query);
    return $result;
  }
  // * semua tentang BPP/LPB Januari-Mei
}
