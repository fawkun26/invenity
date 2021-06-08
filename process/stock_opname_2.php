<?php
session_start();
/**
* All Stock opname related request processing
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
require_once __DIR__ . '/../class/device.class.php';
$devClass = new DeviceClass();

if (isset($_POST)) {
  if ($_POST['action'] == 'check_quantity') {
    // dump($_POST);
    // echo ($_POST['device_ids']);
    $ids  = $_POST['device_ids'];
    $new_ids = "";
    foreach ($ids as $id) {
      $new_ids .= "'$id',";
    }
    $new_ids = rtrim($new_ids, ',');
    // dump($new_ids);

    $result = $devClass->get_quantity_by_id($new_ids);
    // dump(json_encode($result));
    echo json_encode($result);
  }
}
