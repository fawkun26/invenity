<?php 

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

public function tambah()
	{

		if($this->model('Bpp_model')->tambahBpp($_POST) > 0 ){
			Flasher::setFlash('berhasil', 'ditambahkan', 'success');
			header('Location:'invenity/bpp.php'');
			exit;
		} else {
			Flasher::setFlash('gagal', 'ditambahkan', 'danger');
			header('Location:' invenity/bpp.php'');
			exit;
		}
	}

