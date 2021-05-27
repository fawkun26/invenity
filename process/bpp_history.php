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

if (count($_GET) > 0 && count($_POST) == 0) {
  if ($_GET['action'] == 'get_all_bpp_of_bpp_history') {
    $nomor = $_GET['nomor'];
    $query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, tanggal FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE bpp_history_nomor = '$nomor'";

    $result = $db->query($query);
    // $arr = ['name' => 'ilham', 'skill' => 'fullstack'];
    echo json_encode($result);
    die();
  }
}

// create BPP History
if (count($_POST) > 0) {
  if ($_POST['action'] == 'create_bpp_history') {

    $bulan = Carbon::now()->format('m');
    // $bulan = '05';
    $tahun = Carbon::now()->format('Y');
    $created_by = $_SESSION['username'];
    $updated_by = $created_by;
    $updated_at = date('Y-m-d h:i:s');

    $db->beginTransaction();
    $query = "SELECT nomor FROM bpp_history WHERE MONTH(created_at) = '$bulan'";
    $result = $db->query($query);
    $countResult = count($result);
    // jika belum ada bpp_history di bulan ini
    if ($countResult == 0) {
      $new_bpp_history = "001/BPP/$bulan/$tahun";
      $result_create = $db->query("INSERT INTO bpp_history(nomor, created_by, updated_by, updated_at) values ('$new_bpp_history', '$created_by', '$updated_by', '$updated_at')");
    } else {
      $query = "SELECT MAX(CONVERT(SUBSTRING(nomor, 1, 3), SIGNED)) as latest_nomor FROM bpp_history WHERE nomor REGEXP '/$bulan/2021'";
      $latest_nomor = $db->query($query)[0]['latest_nomor'] + 1;
      $nomor_new = str_pad($latest_nomor, 3, '0', STR_PAD_LEFT);
      $nomor_history_new = "$nomor_new/BPP/$bulan/$tahun";
      $result_insert = $db->query("INSERT INTO bpp_history(nomor, created_by, updated_by, updated_at) VALUES('$nomor_history_new', '$created_by', '$updated_by', '$updated_at')");
    }

    $db->commitTransaction();

    $_SESSION['save_status'] = 'Add BPP History Baru Sukses!';
    // untuk membuka modal otomatis
    $_SESSION['modal_open'] = 'true';
    $_SESSION['modal'] = 'default';

    $redirectLocation = '../bpp.php';
    header("Location: $redirectLocation");
    die();
  }

  // == Delete BPP history

  if ($_POST['action'] == 'delete_bpp_history') {
    $nomor = $_POST['bpp_history_nomor'];
    $isRollback = ($_POST['is_rollback'] == 'true') ? true : false;

    // ambil semua BPP2 untuk rollback device quantity pada `device_list`
    $query = "SELECT device_id, out_quantity from bpp where bpp_history_nomor = '$nomor'";
    $result = $db->query($query);
    // rollback masing2 device quantity pada masing2 BPP
    foreach ($result as $bpp) {
      $query = "UPDATE device_list SET device_quantity=device_quantity + $bpp[out_quantity]  WHERE device_id = $bpp[device_id]";
      $db->query($query);
    }
    // Delete tiap BPP
    $query = "DELETE from bpp where bpp_history_nomor = '$nomor'";
    $db->query($query);
    // Delete BPP History
    $query = "DELETE FROM bpp_history WHERE nomor = '$nomor'";
    $db->query($query);

    // Redirect
    $_SESSION['save_status'] = 'Delete BPP History Baru Sukses!';
    $redirectLocation = '../bpp_history.php';
    header("Location: $redirectLocation");
    die();
  }

  // == Delete BPP history (yang ini belum jika is_rollback = false)

  // == Delete BPP dari sebuah BPP history [START]
  if ($_POST['action'] == 'delete_bpp') {
    // dump($_POST);
    $bpp_id = $_POST['bpp_id'];
    $is_rollback = $_POST['is_rollback'] == 'true' ? true : false;
    $out_quantity = $_POST['out_quantity'];
    $device_id = $_POST['device_id'];
    $bpp_history_nomor = $_POST['bpp_history_nomor'];
    // die();
    if ($is_rollback) {
      $db->beginTransaction();
      $query = "DELETE FROM bpp WHERE bpp_id = '$bpp_id'";
      $db->query($query);
      // rollback quantity di `device_list`
      $query = "UPDATE device_list SET device_quantity = device_quantity + '$out_quantity' WHERE device_id = '$device_id'";
      $db->query($query);
      $db->commitTransaction();
    } else {
      $query = "DELETE FROM bpp WHERE bpp_id = '$bpp_id'";
      $db->query($query);
    }

    // Redirect
    $_SESSION['save_status'] = 'Delete BPP Sukses!';
    // untuk otomatis buka modal detail
    $_SESSION['modal_open'] = 'true';
    $_SESSION['modal'] = 'detail';
    $_SESSION['bpp_history_nomor'] = $bpp_history_nomor;
    $redirectLocation = '../bpp_history.php';
    header("Location: $redirectLocation");
    die();
  }
  // == Delete BPP dari sebuah BPP history [END]

  // == Add BPP dari sebuah BPP history [START]
  if ($_POST['action'] == 'add_bpp') {
    $bpp_history_nomor = $_POST['bpp_history'];
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
    $created_at = $created_date;

    $db->beginTransaction();
    // Insert BPP
    $query = "INSERT INTO bpp (bpp_history_nomor, request_quantity, request_unit, request_description, out_quantity, out_unit, device_id, out_total, tanggal, created_by, created_date, updated_by, updated_date) VALUES ('$bpp_history_nomor', '$request_quantity', '$request_unit', '$request_description', '$out_quantity', '$out_unit', '$device_id', '$out_total', '$tanggal', '$created_by', '$created_date', '$updated_by', '$updated_date' )";
    $db->query($query);
    // Update `device_list` device_quantity
    $query = "UPDATE device_list SET device_quantity=device_quantity - '$out_quantity' WHERE device_id = '$device_id'";
    $db->query($query);
    $db->commitTransaction();

    // Redirect
    $_SESSION['save_status'] = 'Add BPP Sukses!';
    // untuk otomatis buka modal detail
    $_SESSION['modal_open'] = 'true';
    $_SESSION['modal'] = 'detail';
    $_SESSION['bpp_history_nomor'] = $bpp_history_nomor;
    $redirectLocation = '../bpp_history.php';
    header("Location: $redirectLocation");
    die();
  }
  // == Add BPP dari sebuah BPP history [END]


  // == Edit BPP [START]
  if ($_POST['action'] === 'edit_bpp') {
    // dd($_POST);

    $bpp_history_nomor = $_POST['bpp_history'];
    $bpp_id = $_POST['bpp_id'];
    $old_out_quantity = $_POST['old_out_quantity'];
    $old_device_id = $_POST['old_device_id'];
    $request_quantity = $_POST['request_quantity'];
    $request_unit = $_POST['request_unit'];
    $request_description = $_POST['request_description'];
    $out_quantity = $_POST['out_quantity'];
    $out_unit = $_POST['out_unit'];
    $new_device_id = $_POST['request_code'];
    $out_total = $_POST['out_total'];
    // $tanggal = date('Y-m-d');
    $updated_by = $_SESSION['username'];
    $updated_date = date('Y-m-d h:i:s');

    // $nomor = $bpp_history_nomor;
    // $created_at = $created_date;

    $db->beginTransaction();


    $resultUpdateBpp = $db->query("UPDATE bpp SET
      bpp_history_nomor='$bpp_history_nomor',
      request_quantity='$request_quantity',
      request_unit='$request_unit',
      request_description='$request_description',
      out_quantity='$out_quantity',
      out_unit='$out_unit',
      out_total='$out_total',
      device_id='$new_device_id',
      updated_by='$updated_by',
      updated_date='$updated_date'
      WHERE bpp_id = '$bpp_id'
    ");

    // Jika device_id yang lama sama dengan yang baru [sudah benar]
    if ($new_device_id == $old_device_id) {
      $old_device_quantity = $db->query("SELECT 
      device_quantity 
      from 
      device_list 
      where device_id='$new_device_id'");

      $old_device_quantity = $old_device_quantity[0]['device_quantity'];
      $new_device_quantity = ($old_device_quantity + $old_out_quantity) - $out_quantity;
      $resultDeviceList = $db->query("UPDATE 
      device_list 
      set 
      device_quantity='$new_device_quantity' 
      where device_id='$new_device_id'");
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

      // lalu update device_quantity yang baru
      $resultDeviceList = $db->query("UPDATE device_list set device_quantity= device_quantity - '$out_quantity' where device_id='$new_device_id'");
    }

    $db->commitTransaction();

    $_SESSION['save_status'] = 'Edit BPP Sukses!';
    // untuk otomatis buka modal detail
    $_SESSION['modal_open'] = 'true';
    $_SESSION['modal'] = 'detail';
    $_SESSION['bpp_history_nomor'] = $bpp_history_nomor;
    $redirectLocation = '../bpp_history.php';
    header("Location: $redirectLocation");
    die();
  }
  // == Edit BPP [END]
}
