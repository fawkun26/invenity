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




/**
 * Add bpp
 */
if ($_POST['action'] === 'add_bpp') {

  $bpp_history_nomor = date('Ymd');
  $request_quantity = $_POST['request_quantity'];
  $request_unit = $_POST['request_unit'];
  $request_description = $_POST['request_description'];
  $out_quantity = $_POST['out_quantity'];
  $out_unit = $_POST['out_unit'];
  $device_id = $_POST['request_code'];
  $out_total = $_POST['out_total'];
  $tanggal = date('Y-m-d');
  $created_by = $_SESSION['username'];
  $created_date = date('Y-m-d h:i:s');
  $updated_by = $created_by;
  $updated_date = $created_date;

  $nomor = $bpp_history_nomor;
  $created_at = $created_date;

  $db->beginTransaction();


  $resultBpp = $db->query("INSERT INTO bpp(bpp_history_nomor, request_quantity, request_unit, request_description, out_quantity, out_unit, device_id, out_total, tanggal, created_by, created_date, updated_by, updated_date) values ('$bpp_history_nomor', '$request_quantity', '$request_unit', '$request_description', '$out_quantity', '$out_unit', '$device_id', '$out_total', '$tanggal', '$created_by', '$created_date', '$updated_by', '$updated_date')");

  $insertedBppId = $db->lastInsertId();


  // Check dulu apakah bppHistory udah ada
  // - Kalo belum maka insert
  // - Kalo udah ada maka tidak insert
  $isBppHistoryExists = (count($db->query("SELECT nomor FROM bpp_history WHERE nomor = '$bpp_history_nomor'")) > 0) ? true : false;
  if ($isBppHistoryExists) {
    // Jangan bikin baru
  } else {
    $resultBppHistory = $db->query("INSERT INTO bpp_history(nomor, created_at) values('$nomor', '$created_at')");
  }

  $old_device_quantity = $db->query("SELECT device_quantity from device_list where device_id='$device_id'");
  $old_device_quantity = $old_device_quantity[0]['device_quantity'];
  $new_device_quantity = $old_device_quantity - $out_quantity;

  $resultDeviceList = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$device_id'");

  $db->commitTransaction();


  $_SESSION['save_status'] = 'Add BPP Sukses!';

  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
}

/**
 * Edit BPP
 */
if ($_POST['action'] === 'edit_bpp') {
  // dd($_POST);
  // $bpp_history_nomor = date('Ymd');
  $bpp_id = $_POST['bpp_id'];
  $old_out_quantity = $_POST['old_out_quantity'];
  $old_device_id = $_POST['old_device_id'];
  $request_quantity = $_POST['request_quantity'];
  $request_unit = $_POST['request_unit'];
  $request_description = $_POST['request_description'];
  $out_quantity = $_POST['out_quantity'];
  $out_unit = $_POST['out_unit'];
  $device_id = $_POST['request_code'];
  $out_total = $_POST['out_total'];
  // $tanggal = date('Y-m-d');
  $updated_by = $_SESSION['username'];
  $updated_date = date('Y-m-d h:i:s');

  // $nomor = $bpp_history_nomor;
  // $created_at = $created_date;

  $db->beginTransaction();


  $resultUpdateBpp = $db->query("UPDATE bpp SET
    request_quantity='$request_quantity',
    request_unit='$request_unit',
    request_description='$request_description',
    out_quantity='$out_quantity',
    out_unit='$out_unit',
    out_total='$out_total',
    device_id='$device_id',
    updated_by='$updated_by',
    updated_date='$updated_date'
    WHERE bpp_id = '$bpp_id'
  ");
  
  // Jika device_id yang lama sama dengan yang baru
  if ($device_id == $old_device_id) {
    $old_device_quantity = $db->query("SELECT device_quantity from device_list where device_id='$device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = ($old_device_quantity + $old_out_quantity) - $out_quantity;
    $resultDeviceList = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$device_id'");
  } else {
    // roll back device quantity yang lama dulu
    $old_device_quantity = $db->query("SELECT device_quantity from device_list where device_id='$old_device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = $old_device_quantity + $old_out_quantity;
    $resultRollbackQuantity = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$old_device_id'");

    // lalu update device quantity yang baru
    $old_device_quantity = $db->query("SELECT device_quantity from device_list where device_id='$device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = $old_device_quantity - $out_quantity;
    $resultDeviceList = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$device_id'");
  }

  $db->commitTransaction();

  $_SESSION['save_status'] = 'Add BPP Sukses!';

  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
}
