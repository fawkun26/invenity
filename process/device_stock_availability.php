<?php 
session_start();

/**
 * Processing Crud request and response untuk Device Stock Availibility component 
 */

 // autolaod packages 
 require_once(__DIR__.'/../vendor/autoload.php');

 require_once(__DIR__. '/../class/device_stock_availability.class.php');

$dsa = new DeviceStockAvailability();
$sysClass = new SystemClass();
$redirectLocation ='../device_stock_availability.php';
/**
 * 
 */
if ($_POST['action'] === 'update_minimum_quantity') {
	$device_list_id = (int)$_POST['device_list_id'];
	$minimum_quantity = (int)$_POST['minimum_quantity'];
	// Gak boleh di bawah 0 $minimum_quantitynya
	if ($minimum_quantity < 0) {
		$_SESSION['save_status'] = 'Gagal! Update quantity minimum';
		$_SESSION['save_type'] = 'danger';
		header("Location: $redirectLocation");
		die();
	}
	// jika device_list ada pada table maka update `minimum_quantity` nya.
	if (count($dsa->findDeviceList($device_list_id))) {
		$result = $dsa->updateQuantityMinimum($device_list_id, $minimum_quantity);
	} else {
		$_SESSION['save_status'] = 'Gagal! Update quantity minimum';
		$_SESSION['save_type'] = 'danger';
	}
	
	header("Location: $redirectLocation");
	die();
}