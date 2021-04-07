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
  // dump($_POST);
  // dump($_SESSION);
  /**
   * Table => bpp
   *  - bpp_report_id => tanggal sekarang varchar()
   *  - tanggal => tanggal sekarang date()
   *  - created_date => tanggal sekarang datetime()
   *  - updated_by => username dari `users` varchar()
   *  - updated_date => tanggal sekrang datetime()
   * 
   * Table => bpp_history
   *  - nomor => bpp_report_id dari `bpp`
   *  - created_at => tanggal sekarang timestamp
   * 
   * Table => device_list
   *  - device_quantity => dikurang dengan out_quantity table `bpp`
   */

    $bpp_report_id = date('Ymd');
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

    $nomor = $bpp_report_id;
    $created_at = $created_date;

    $old_device_quantity = $db->query("SELECT device_quantity from device_list where device_id='$device_id'");
    $old_device_quantity = $old_device_quantity[0]['device_quantity'];

    $new_device_quantity = $old_device_quantity - $out_quantity;

    $resultBpp = $db->query("INSERT INTO bpp(bpp_report_id, request_quantity, request_unit, request_description, out_quantity, out_unit, device_id, out_total, tanggal, created_by, created_date, updated_by, updated_date) values ('$bpp_report_id', '$request_quantity', '$request_unit', '$request_description', '$out_quantity', '$out_unit', '$device_id', '$out_total', '$tanggal', '$created_by', '$created_date', '$updated_by', '$updated_date')");
    
    $resultBppHistory = $db->query("INSERT INTO bpp_history(nomor, created_at) values('$nomor', '$created_at')");

    $resultDeviceList = $db->query("UPDATE device_list set device_quantity='$new_device_quantity' where device_id='$device_id'");

    $_SESSION['save_status'] = 'Add BPP Sukses!';

    $redirectLocation ='../bpp.php';
    header("Location: $redirectLocation");
    die();
}
