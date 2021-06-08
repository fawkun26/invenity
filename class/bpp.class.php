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
require_once(__DIR__ . '/../class/device.class.php');
// $devClass = new DeviceClass();

class BppClass
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


	public function add_bpp($dt_bpp)
	{

		$tambah = "1";
		
		$bpp_report_id = date("Ymd");
		$request_quantity    = addslashes(trim($dt_bpp["req_quantity"]));
		$request_unit    	   = addslashes(trim($dt_bpp["req_unit"]));
		$request_code        = $dt_bpp["req_code"];
		$request_description = trim($dt_bpp["req_description"]);

		$out_quantity    = addslashes(trim($dt_bpp["o_quantity"]));
		$out_unit    	   = addslashes(trim($dt_bpp["o_unit"]));
		$out_code        = $dt_bpp["o_code"];
		$device_id            = addslashes(trim($dt_bpp["dev_id"]));
		$out_total = addslashes(trim($dt_bpp["o_total"]));
		
		$tanggal = date("Y-m-d");
		
			// if photo upload success 
			if ($tambah>0) {
				// Insert to database & create notification
				$query        = "INSERT INTO bpp (
					bpp_id,
					bpp_report_id,
					request_quantity, 
					request_unit,
					request_code,
					request_description,
					out_quantity,
					out_unit,
					out_code,
					device_id,
					out_total, 
					
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date) 
				VALUES (
					'',
					'$bpp_report_id',
					'$request_quantity', 
					'$request_unit',
					'$request_code',
					'$request_description',
					'$out_quantity',
					'$out_unit',
					'$out_code',
					'$device_id',
					'$out_total',
					
					'$tanggal',
					'$_SESSION[username]', 
					NOW(), 
					'$_SESSION[username]', 
					NOW())";

                
					$process = $this->db->query($query);
					 $query2 = "UPDATE device_list INNER JOIN bpp ON device_list.device_id=bpp.device_id SET device_list.device_quantity = device_list.device_quantity - bpp.out_quantity WHERE bpp.out_quantity='$out_quantity'";
			    $process = $this->db->query($query2);
			}else {
				$process = 0;
				$_SESSION['new_req_quantity']         = $request_quantity;
				$_SESSION['new_req_unit']         = $request_unit;
				$_SESSION['new_req_code']         = $request_code;
				$_SESSION['new_req_description']         = $request_description;
				$_SESSION['new_o_quantity']         = $out_quantity;
				$_SESSION['new_o_unit']         = $out_unit;
				$_SESSION['new_o_code']         = $out_code;
				$_SESSION['new_dev_id']         = $device_id;
				$_SESSION['new_o_total']         = $out_total;
			}


	 	return $process.$notification;
	}

	public function add_bpp_history($dt_bpp)
	{
		$tambah = "1";
		//$bpp_id = "1";
		$bpp_report_id = date("Ymd");
		$request_quantity    = addslashes(trim($dt_bpp["req_quantity"]));
		$request_unit    	   = addslashes(trim($dt_bpp["req_unit"]));
		$request_code        = $dt_bpp["req_code"];
		$request_description = trim($dt_bpp["req_description"]);

		$out_quantity    = addslashes(trim($dt_bpp["o_quantity"]));
		$out_unit    	   = addslashes(trim($dt_bpp["o_unit"]));
		$out_code        = $dt_bpp["o_code"];
		$device_id            = addslashes(trim($dt_bpp["dev_id"]));
		$out_total = addslashes(trim($dt_bpp["o_total"]));
		
		$tanggal = date("Y-m-d");
			if ($tambah>0) {

				$query        = "INSERT INTO bpp_history (
					bpp_history_id,
					bpp_id,
					bpp_report_id,
					request_quantity, 
					request_unit,
					request_code,
					request_description,
					out_quantity,
					out_unit,
					out_code,
					device_id,
					out_total, 
					
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date) 
				VALUES (
					'',
					'$bpp_id',
					'$bpp_report_id',
					'$request_quantity', 
					'$request_unit',
					'$request_code',
					'$request_description',
					'$out_quantity',
					'$out_unit',
					'$out_code',
					'$device_id',
					'$out_total',
					
					'$tanggal',
					'$_SESSION[username]', 
					NOW(), 
					'$_SESSION[username]', 
					NOW())";

                	
					$process = $this->db->query($query);

				$notification = "|";
				// create log
				if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
			// 	}
			 }
			else {
				$process = 0;
				$_SESSION['new_req_quantity']         = $request_quantity;
				$_SESSION['new_req_unit']         = $request_unit;
				$_SESSION['new_req_code']         = $request_code;
				$_SESSION['new_req_description']         = $request_description;
				$_SESSION['new_o_quantity']         = $out_quantity;
				$_SESSION['new_o_unit']         = $out_unit;
				$_SESSION['new_o_code']         = $out_code;
				$_SESSION['new_dev_id']         = $device_id;
				$_SESSION['new_o_total']         = $out_total;
			}

		}

		return $process.$notification;

	}


	public function getBppById($bpp_id)
	{
		$this->db->query(" SELECT * FROM bpp  WHERE bpp_id=:bpp_id");
		$this->db->bind('bpp_id', $bpp_id);
		return $this->db->single();
	}

	public function get_all_bpp() {
		$query = "SELECT bpp_id, bpp_history_nomor, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id ORDER BY created_at DESC";

		$result = $this->db->query($query);
		return $result;
	}

	public function get_all_distinct_tanggal() {
		$query = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM bpp";
		$result = $this->db->query($query);
		return $result;
	}

	public function get_all_distinct_bulan() {
		$query = "SELECT DISTINCT DATE_FORMAT(created_at, '%m') as created_at FROM bpp ORDER BY created_at";
		$result = $this->db->query($query);
		return $result;
	}
	public function get_all_distinct_tahun() {
		$query = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y') as created_at FROM bpp ORDER BY created_at";
		$result = $this->db->query($query);
		return $result;
	}

	// Untuk Report BPP
	public function get_all_bpp_by_tanggal($created_at) {
		$query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, created_at FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE DATE(created_at) = '$created_at'";
		$result = $this->db->query($query);
		return $result;
	}
	public function get_all_bpp_by_bulan($bulan) {
		$query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, created_at FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE MONTH(created_at) = '$bulan'";
		$result = $this->db->query($query);
		return $result;
	}
	public function get_all_bpp_by_tahun($tahun) {
		$query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, created_at FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE YEAR(created_at) = '$tahun'";
		$result = $this->db->query($query);
		return $result;
	}


	public function get_all_bpp_by_bpp_history_nomor($history) 
	{
		$query = "SELECT bpp_id, request_quantity, request_unit, type.type_name, type.type_code, device.device_serial, request_description, out_quantity, out_unit, device_id, out_total, created_at FROM bpp INNER JOIN device_list AS device USING(device_id) INNER JOIN device_type AS type ON device.type_id = type.type_id WHERE bpp_history_nomor = '$history'";
		$result = $this->db->query($query);
		return $result;	
	}
	public function show_bpp_history($id="")
	{
		$query = "SELECT id, nomor, created_at FROM bpp_history";
		$process = $this->db->query($query);
		return $process;
	}

	public function show_bpp_report($bpp_id="",$criteria="")
	{

		$query = "SELECT 
					bpp_report_id,
					request_quantity, 
					request_unit,
					request_code,
					request_description,
					out_quantity,
					out_unit,
					out_code,
					device_id,
					out_total,
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date FROM bpp 
					";
				
		if ($criteria!="") {
			$query .= "WHERE $bpp_id IN ($criteria)"; 
		}
		


		// $query .= "ORDER BY $bpp_id ASC";

		$process = $this->db->query($query);

		return $process;
	}
//}

	public function edit_bpp($dt_bpp)
	{
		// Set var
		$edit = "1";
		$bpp_history_id = $dt_bpp["bpp_history_id"];
		$bpp_id = $dt_bpp["bpp_id"];

		$request_quantity    = addslashes(trim($dt_bpp["req_quantity"]));
		$request_unit    	   = addslashes(trim($dt_bpp["req_unit"]));
		$request_code        = $dt_bpp["req_code"];
		$request_description = trim($dt_bpp["req_description"]);

		$out_quantity    = addslashes(trim($dt_bpp["o_quantity"]));
		$out_unit    	   = addslashes(trim($dt_bpp["o_unit"]));
		$out_code        = $dt_bpp["o_code"];
		$device_id            = addslashes(trim($dt_bpp["dev_id"]));
		$out_total = addslashes(trim($dt_bpp["o_total"]));
		// Check if device exists
		$bpp_check = count($this->show_bpp($bpp_id));
		if ($bpp_check>0) {
			// Get current values
			$bpp_curr_value = $this->show_bpp($bpp_id);
			foreach ($bpp_curr_value as $data) {
				$c_requset_quantity       = $data["request_quantity"];
				$c_request_unit       = $data["request_unit"];
				// baru
				$c_request_code    = $data["request_quantity"];
				// baru
				$c_request_description       = $data["request_description"];
				$c_out_quantity      = $data["out_quantity"];
				$c_out_unit = $data["out_unit"];
				$c_out_code       = $data["out_code"];
				// $c_device_id       = $data["dev_id"];

				$c_out_total     = $data["out_total"];
				
			}

	if ($edit>0) {
				// Update database & create notification
				$query = "UPDATE bpp
							SET 
					request_quantity = '$request_quantity',
					request_unit = '$request_unit',
					request_code = '$request_code',
					request_description = '$request_description',
					out_quantity = '$out_quantity',
					-- device_list.device_quantity = device_list.device_quantity - bpp.out_quantity,
					out_unit = '$out_unit',
					out_code = '$out_code',
					-- device_id = '$device_id',
					out_total = '$out_total'
					WHERE 
					bpp_id = '$bpp_id' ";

				
		
				$process = $this->db->query($query);

				$query = "UPDATE bpp_history
							SET 
					request_quantity = '$request_quantity',
					request_unit = '$request_unit',
					request_code = '$request_code',
					request_description = '$request_description',
					out_quantity = '$out_quantity',
					-- device_list.device_quantity = device_list.device_quantity - bpp.out_quantity,
					out_unit = '$out_unit',
					out_code = '$out_code',
					-- device_id = '$device_id',
					out_total = '$out_total'
					WHERE 
					bpp_id = '$bpp_id' ";

				
		
				$process = $this->db->query($query);

				$notification = "|";
				// create log
				if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
				}
		
			else {
				$process = 0;
				$_SESSION['new_req_quantity']       = $request_quantity;
				$_SESSION['new_req_unit']       = $request_unit;
				$_SESSION['new_req_code']    = $request_code;
				$_SESSION['new_req_description']       = $request_description;
				$_SESSION['new_o_quantity']      = $out_quantity;
				$_SESSION['new_o_unit'] = $out_unit;
				$_SESSION['new_o_code']      = $out_code;
				$_SESSION['new_o_total']     = $out_total;
			}

		}
		return $process.$notification;
	}

	
 }

 public function delete_bpp($bpp_id)
	{
		$out_quantity    = ["o_quantity"];
		$query = "DELETE
					 FROM bpp WHERE bpp_id='$bpp_id'
					";

		$process = $this->db->query($query);


		$notification = "|";
		if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
				}
		

		return $process.$notification;
	}
}
	

?>