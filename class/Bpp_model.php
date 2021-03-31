<?php
/**
* Device Class
* Device management class such as device, device type
*
* @author 		Permana Cakra
* @version 		0.2
*/

require_once(__DIR__ . '/../lib/db.class.php');
require_once(__DIR__ . '/../class/inventory.class.php');
require_once(__DIR__ . '/../class/location.class.php');
require_once(__DIR__ . '/../class/system.class.php');

class Bpp_model
{
	/**
	* Construct
	* 
	*/
	function __construct()
	{
		$this->db        = new DB();
		$this->inventory = new inventory();
		$this->locClass  = new LocationClass();
		$this->sysClass  = new SystemClass();
	}


	/**
	* Add device
	*
	* @param 	array 	$dt_device
	* @param 	array 	$dt_photo
	*
	*/
	// public function add_bpp($dt_bpp)
	// {
	// 	// Set var
	// 	$bpp = "1";
	// 	$request_quantity    = addslashes(trim($dt_bpp["req_quantity"]));
	// 	$request_unit    	   = addslashes(trim($dt_bpp["req_unit"]));
	// 	$request_code        = $dt_bpp["req_code"];
	// 	$request_description = trim($dt_bpp["req_description"]);

	// 	$out_quantity    = addslashes(trim($dt_bpp["o_quantity"]));
	// 	$out_unit    	   = addslashes(trim($dt_bpp["o_unit"]));
	// 	$out_code        = $dt_bpp["o_code"];
	// 	$out_total = addslashes(trim($dt_bpp["o_total"]));
		
	// 		// if photo upload success 
	// 		if ($bpp>0) {
	// 			// Insert to database & create notification
	// 			$query        = "INSERT INTO bpp (
	// 				bpp_id,
	// 				request_quantity, 
	// 				request_unit,
	// 				request_code,
	// 				request_description,
	// 				out_quantity,
	// 				out_unit,
	// 				out_code,
	// 				out_total) 
	// 			VALUES (
	// 				'$request_quantity', 
	// 				'$request_unit',
	// 				'$request_code',
	// 				'$request_description',
	// 				'$out_quantity',
	// 				'$out_unit',
	// 				'$out_code',
	// 				'$out_total') ";
				 
	// 			$process = $this->db->query($query);
	// 			$notification = "|";
	// 			// create log
	// 			if ($process>0) {
	// 				$this->sysClass->save_system_log($_SESSION['username'], $query);
	// 		// 	}
	// 		// }
	// 		// else {
	// 		// 	$process = 0;
	// 		// 	$_SESSION['new_req_quantity']         = $request_quantity;
	// 		// 	$_SESSION['new_req_unit']         = $request_unit;
	// 		// 	$_SESSION['new_req_code']         = $request_code;
	// 		// 	$_SESSION['new_req_description']         = $request_description;
	// 		// 	$_SESSION['new_o_quantity']         = $out_quantity;
	// 		// 	$_SESSION['new_o_unit']         = $out_unit;
	// 		// 	$_SESSION['new_o_code']         = $out_code;
	// 		// 	$_SESSION['new_o_total']         = $out_total;
				
	// 		// 	// $_SESSION['errors']           = $process_photo_upload;
	// 		// }

	// 							}

	// 	return $process.$notification;
	// 					}

	// }

	public function tambahBpp($data)
	{
		$query = "INSERT INTO bpp
					VALUES
					('', :request_quantity, :request_unit, :request_code, :request_description, :out_quantity, :out_unit, :out_code, :out_total)";

		$this->db->query($query);
		$this->db->bind('request_quantity', $data['request_quantity']);
		$this->db->bind('request_unit', $data['request_unit']);
		$this->db->bind('request_code', $data['request_code']);
		$this->db->bind('request_description', $data['request_description']);
		$this->db->bind('out_quantity', $data['out_quantity']);
		$this->db->bind('out_unit', $data['out_unit']);
		$this->db->bind('out_code', $data['out_code']);
		$this->db->bind('out_total', $data['out_total']);

		$this->db->execute();

		return $this->db->rowCount();

	}


}
	

?>