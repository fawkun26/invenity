<?php
session_start();

require_once(__DIR__ . '/../vendor/autoload.php');

/**
 *	Required Class
 */
require_once(__DIR__ . '/../lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/../class/user.class.php');
$userClass = new UserClass();
require_once(__DIR__ . '/../class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/../class/system.class.php');
$sysClass  = new SystemClass();
require_once(__DIR__ . '/../class/Bpp_model.php');
$bppClass  = new Bpp_model();

use Carbon\Carbon;

// [Update database bpp_history tadi]
// == create new bpp history 

// if ($_GET['action'] == 'get_all_bpp_of_bpp_history') {
//   $nomor = $_GET['nomor'];
//   $query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, tanggal FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE bpp_history_nomor = '$nomor'";

// 		$result = $db->query($query);
//   // $arr = ['name' => 'ilham', 'skill' => 'fullstack'];
//     echo json_encode($result);
//     die();
// }


if ($_POST['action'] == 'create_bpp_history') {
  $bulan = $_POST['bulan'];
  // $bulan = '05';
  $tahun = Carbon::now()->format('Y');

  $db->beginTransaction();
  $query = "SELECT nomor FROM bpp_history WHERE nomor like '%/$bulan/2021'";
  $result = $db->query($query);
  $countResult = count($result);
  // jika belum ada bpp_history di bulan ini
  if ( $countResult == 0) {
    $new_bpp_history = "001/BPP/$bulan/$tahun";
    $result_create = $db->query("INSERT INTO bpp_history(nomor) values ('$new_bpp_history')");
  } else {
    $result_lastest = $db->query('SELECT nomor from bpp_history ORDER BY created_at DESC LIMIT 1');
    $nomor = $result_lastest[0]['nomor'];
    $nomor_increment = substr($nomor, 0, strpos($nomor, '/'));
    $nomor_increment_new = (int) $nomor_increment + 1;
    $nomor_increment_new = str_pad($nomor_increment_new, 3, "0", STR_PAD_LEFT);
    $nomor_increment_new = "$nomor_increment_new/BPP/$bulan/$tahun";
    $result_insert = $db->query("INSERT INTO bpp_history(nomor) VALUES('$nomor_increment_new')");
  }

  $db->commitTransaction();

  $_SESSION['save_status'] = 'Add BPP History Baru Sukses!';

  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
} 