<?php
session_start();
/**
* All BPP related request processing
*
* @author 		Mohamad Ilham Ramadhan
* @version 		1.0
*/

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
  $bpp_history_nomor = $_POST['select_bpp_history'];
  $request_quantity = $_POST['request_quantity'];
  $request_unit = $_POST['request_unit'];
  $request_description = $_POST['request_description'];
  $out_quantity = $_POST['out_quantity'];
  $out_unit = $_POST['out_unit'];
  $device_id = $_POST['request_code'];
  $out_total = $_POST['out_total'];
  $created_by = $_SESSION['username'];
  $updated_by = $created_by;
  $db->beginTransaction();
  // if januari - mei
  if ($_POST['modal_type'] == 'januari_mei') {
    $created_at = $db->query("SELECT created_at FROM bpp_history WHERE nomor = '$_POST[select_bpp_history]'");
    $created_at = $created_at[0]['created_at'];
  } else {
    $created_at = date('Y-m-d h:i:s');
  }
  $updated_at = $created_at;
  
  $nomor = $bpp_history_nomor;
  $created_at = $created_at;
  
  
  
  $resultBpp = $db->query("INSERT INTO bpp(
    bpp_history_nomor, 
    request_quantity, 
    request_unit, 
    request_description, 
    out_quantity, 
    out_unit, 
    device_id, 
    out_total, 
    created_by, 
    created_at, 
    updated_by, 
    updated_at) 
    values (
      '$bpp_history_nomor', 
      '$request_quantity', 
      '$request_unit', 
      '$request_description', 
      '$out_quantity', 
      '$out_unit', 
      '$device_id', 
      '$out_total', 
      '$created_by', 
      '$created_at', 
      '$updated_by', 
      '$updated_at')");

  $insertedBppId = $db->lastInsertId();


  // Check dulu apakah bppHistory udah ada
  // - Kalo belum maka insert
  // - Kalo udah ada maka tidak insert
  $isBppHistoryExists = (count($db->query("SELECT 
  nomor 
  FROM 
  bpp_history 
  WHERE 
  nomor = '$bpp_history_nomor'")) > 0) ? true : false;
  if ($isBppHistoryExists) {
    // Jangan bikin baru
  } else {
    $resultBppHistory = $db->query("INSERT INTO 
    bpp_history(nomor, created_at) 
    values(
      '$nomor', 
      '$created_at')"
      );
  }

  $resultDeviceList = $db->query("UPDATE 
  device_list 
  SET 
  device_quantity = device_quantity - '$out_quantity' 
  WHERE 
  device_id='$device_id'");

  $db->commitTransaction();


  $_SESSION['save_status'] = 'Add BPP Sukses!';
    // untuk membuka modal otomatis
  $_SESSION['modal_open'] = 'true';
  if ($_POST['modal_type'] == 'default') {
    $_SESSION['modal'] = 'default';
  } else {
    $_SESSION['modal'] = 'januari_mei';
  }
  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
}

// === Edit BPP
if ($_POST['action'] === 'edit_bpp') {
  // dd($_POST);

  $bpp_history_nomor = $_POST['select_bpp_history'];
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
  $updated_at = date('Y-m-d h:i:s');

  // $nomor = $bpp_history_nomor;
  // $created_at = $created_at;

  $db->beginTransaction();


  $resultUpdateBpp = $db->query("UPDATE bpp SET
    bpp_history_nomor='$bpp_history_nomor',
    request_quantity='$request_quantity',
    request_unit='$request_unit',
    request_description='$request_description',
    out_quantity='$out_quantity',
    out_unit='$out_unit',
    out_total='$out_total',
    device_id='$device_id',
    updated_by='$updated_by',
    updated_at='$updated_at'
    WHERE bpp_id = '$bpp_id'
  ");
  
  // Jika device_id yang lama sama dengan yang baru
  if ($device_id == $old_device_id) {
    $old_device_quantity = $db->query("SELECT 
    device_quantity 
    from 
    device_list 
    where device_id='$device_id'");

    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = ($old_device_quantity + $old_out_quantity) - $out_quantity;
    $resultDeviceList = $db->query("UPDATE 
    device_list 
    set 
    device_quantity='$new_device_quantity' 
    where device_id='$device_id'");
  } else {
    // [Jika beda] roll back device quantity yang lama dulu
    $old_device_quantity = $db->query("SELECT 
    device_quantity 
    from 
    device_list 
    where 
    device_id='$old_device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = $old_device_quantity + $old_out_quantity;
    $resultRollbackQuantity = $db->query("UPDATE 
    device_list 
    set 
    device_quantity='$new_device_quantity' 
    where 
    device_id='$old_device_id'");

    // lalu update device quantity yang baru
    $old_device_quantity = $db->query("SELECT 
    device_quantity 
    from 
    device_list 
    where 
    device_id='$device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];
    $new_device_quantity = $old_device_quantity - $out_quantity;
    $resultDeviceList = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$device_id'");
  }

  $db->commitTransaction();

  $_SESSION['save_status'] = 'Edit BPP Sukses!';

  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
}

// === Delete BPP
if ($_POST['action'] === 'delete_bpp') {
  $is_rollback = ($_POST['is_rollback'] == "true") ? true : false ;
  $bpp_id = $_POST['bpp_id'];
  $device_id = $_POST['device_id'];
  $out_quantity = $_POST['out_quantity'];
  
  
  if ($is_rollback) {
    /**
     * delete bpp
     * update device_quantity
     * check apakah ada masih ada BPP pada tanggal sekarang jika tidak ada maka hapus bpp history
     */
    $db->beginTransaction();
    
    $result_bpp_history_nomor = $db->query("SELECT bpp_history_nomor FROM bpp WHERE bpp_id = '$bpp_id'");
    $bpp_history_nomor = $result_bpp_history_nomor[0]['bpp_history_nomor'];
    $count_bpp_history_nomor = $db->query("SELECT count(*) from bpp where bpp_history_nomor = '$bpp_history_nomor'")[0]['count(*)'];
    
    $resultDeleteBPP = $db->query("DELETE FROM bpp WHERE bpp_id = '$bpp_id'");
    $resultRollbackDeviceQuantity = $db->query("UPDATE device_list SET
      device_quantity = device_quantity + $out_quantity
      WHERE device_id = '$device_id'
    ");

    if ($count_bpp_history_nomor <= 1) {
      $db->query("DELETE FROM bpp_history where nomor = '$bpp_history_nomor'");
    } else {
      // jangan hapus apapun dari bpp_history;
    }
    $db->commitTransaction();
  } else {
    $db->beginTransaction();

    $result_bpp_history_nomor = $db->query("SELECT bpp_history_nomor FROM bpp WHERE bpp_id = '$bpp_id'");
    $bpp_history_nomor = $result_bpp_history_nomor[0]['bpp_history_nomor'];
    $count_bpp_history_nomor = $db->query("SELECT count(*) from bpp where bpp_history_nomor = '$bpp_history_nomor'")[0]['count(*)'];
    
    $resultDeleteBPP = $db->query("DELETE FROM bpp WHERE bpp_id = '$bpp_id'");

    if ($count_bpp_history_nomor <= 1) {
      $db->query("DELETE FROM bpp_history where nomor = '$bpp_history_nomor'");
    } else {
      // jangan hapus apapun dari bpp_history;
    }

    $db->commitTransaction();
  }

  $redirectLocation = '../bpp.php';
  header("Location: $redirectLocation");
  die();
}

if ($_POST['action'] == 'setting_report_bpp') {
      // save ke session
      $_SESSION['bpp_report_setting']['diminta'] = $_POST['diminta'];
      $_SESSION['bpp_report_setting']['diterima'] = $_POST['diterima'];
      $_SESSION['bpp_report_setting']['kasubag_logistik'] = $_POST['kasubag_logistik'];
      $_SESSION['bpp_report_setting']['gm_teknik_1'] = $_POST['gm_teknik_1'];
      $_SESSION['bpp_report_setting']['gm_teknik_2'] = $_POST['gm_teknik_2'];
      $_SESSION['bpp_report_setting']['kabag'] = $_POST['kabag'];
  
      $redirectLocation = '../bpp.php';
      header("Location: $redirectLocation");
      die();
}
