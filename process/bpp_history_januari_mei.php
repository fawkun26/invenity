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
  //   dump($_POST);
  // die();
  $bulan = $_POST['bulan'];
  $tanggal = $_POST['tanggal'];
  $tahun = Carbon::now()->format('Y');
  $created_at = "$tahun-$bulan-$tanggal";
  $created_by = $_SESSION['username'];
  $updated_by = $created_by;
  $updated_at = $created_at;

  $db->beginTransaction();
  $query = "SELECT nomor FROM bpp_history WHERE nomor like '%/$bulan/$tahun'";
  $result = $db->query($query);
  $countResult = count($result);
  // jika belum ada bpp_history di bulan ini
  if ( $countResult == 0) {
    $new_bpp_history = "001/BPP/$bulan/$tahun";
    $result_create = $db->query("INSERT INTO bpp_history(nomor, created_by, created_at, updated_by, updated_at) values ('$new_bpp_history', '$created_by', '$created_at', '$updated_by', '$updated_at')");
  } else {
    $query = "SELECT MAX(CONVERT(SUBSTRING(nomor, 1, 3), SIGNED)) as latest_nomor FROM bpp_history WHERE nomor REGEXP '/$bulan/2021'";
    $latest_nomor = $db->query($query)[0]['latest_nomor'] + 1;
    $nomor_new = str_pad($latest_nomor, 3, '0', STR_PAD_LEFT) ;
    $nomor_history_new = "$nomor_new/BPP/$bulan/$tahun";
    // $created_at = "$tahun-$bulan-$tanggal";
    $result_insert = $db->query("INSERT INTO bpp_history(nomor, created_by, created_at, updated_by, updated_at) VALUES('$nomor_history_new', '$created_by', '$created_at', '$updated_by', '$updated_at')");
  }

  $db->commitTransaction();

  $_SESSION['save_status'] = 'Add BPP History Baru Sukses!';
  // untuk membuka modal otomatis
  $_SESSION['modal_open'] = 'true';
  $_SESSION['modal'] = 'januari_mei';
  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
} 