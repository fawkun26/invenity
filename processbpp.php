<?php 
session_start();

/**
*	Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/user.class.php');
$userClass = new UserClass();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/system.class.php');
$sysClass  = new SystemClass();
require_once(__DIR__ . '/class/component.class.php');
$comClass  = new ComponentClass();
require_once(__DIR__ . '/class/device.class.php');
$devClass  = new DeviceClass();
require_once(__DIR__ . '/class/location.class.php');
$locClass  = new LocationClass();
require_once(__DIR__ . '/class/Bpp_model.php');
$bppClass  = new Bpp_model();
require_once(__DIR__ . '/class/bpp.class.php');
$bppClass  = new BppClass();




	
	
	
		  if (isset($_POST['device_id'])) {
                      $code = '';
                      $device_types2     = '';
                        $device_type_list2 = $devClass->show_device();
                       
                         foreach ($device_type_list2 as $device_type_data2) {
                       
                         

                         $device_type_name2 = $device_type_data2['device_serial'];
                         $device_type_code2 = $device_type_data2['device_code'];
                         $device_types2    .= "<option value='$device_type_name2'>$device_type_name2($device_type_code2)</option>";
                         }
                         echo $device_types2;
		
		}
?>