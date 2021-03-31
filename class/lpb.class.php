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

class LpbClass
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
	* Select device type
	* 
	* @param 	string 	$type_name
	* @param 	string 	$type_code
	* @param 	string 	$active
	* @return 	array 	$process
	* 
	*/

	public function add_lpb($dt_lpb)
	{
		// Set var
		

		

		$tambah = "1";
		$lpb_report_id = date("Ymd");
		$lpb_quantity    = addslashes(trim($dt_lpb["lp_quantity"]));
		$lpb_unit    	   = addslashes(trim($dt_lpb["lp_unit"]));
		$lpb_code        = $dt_lpb["lp_code"];
		$device_id            = addslashes(trim($dt_lpb["dev_id"]));
		$lpb_description = trim($dt_lpb["lp_description"]);
		$lpb_condition    = $dt_lpb["lp_condition"];

		
		$tanggal = date("Y-m-d");
		//$sisa = $device_quantity-$out_quantity;
		

		
			// if photo upload success 
			if ($tambah>0) {
				// Insert to database & create notification
				$query        = "INSERT INTO lpb (
					lpb_id,
					lpb_report_id,
					lpb_quantity, 
					lpb_unit,
					lpb_code,
					device_id,
					lpb_description,
					lpb_condition,
					 
					
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date) 
				VALUES (
					'',
					'$lpb_report_id',
					'$lpb_quantity', 
					'$lpb_unit',
					'$lpb_code',
					'$device_id',
					'$lpb_description',
					'$lpb_condition',
					
					
					'$tanggal',
					'$_SESSION[username]', 
					NOW(), 
					'$_SESSION[username]', 
					NOW())";

                
					$process = $this->db->query($query);

					// $query1 = "SELECT device_quantity FROM device_list";
					// $query2 = "SELECT out_quantity FROM bpp";

					//$hasil = $device_quantity-$out_quantity;
                 // $query1 = "UPDATE device_list SET device_quantity= $sisa WHERE device_id = '$device_id'";
					 $query2 = "UPDATE device_list INNER JOIN lpb ON device_list.device_id=lpb.device_id SET device_list.device_quantity = device_list.device_quantity + lpb.lpb_quantity WHERE lpb.lpb_quantity='$lpb_quantity'";
					 

					// $query3= "UPDATE device_list INNER JOIN bpp ON (bpp.device_id=device_list.device_id AND bpp.device_id='$device_id') SET device_list.device_quantity = device_list.device_quantity - bpp.out_quantity WHERE bpp.device_id = '$device_id'";



					

     
                
            
    
				 
				$process = $this->db->query($query2);
				$notification = "|";
				// create log
				if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
			// 	}
			 }
			else {
				$process = 0;
				$_SESSION['new_lp_quantity']         = $lpb_quantity;
				$_SESSION['new_lp_unit']         = $lpb_unit;
				$_SESSION['new_lp_code']         = $lpb_code;
				//$_SESSION['new_dev_id']         = $device_id;
				$_SESSION['new_lp_description']         = $lpb_description;
				$_SESSION['new_lp_condition']         = $lpb_condition;

				
				
				// $_SESSION['errors']           = $process_photo_upload;
			}

		}

		return $process.$notification;
	}

	public function show_lpb($lpb_id="")
	{
		$query = "SELECT 
					lpb_id, 
					lpb_report_id,
					lpb_quantity, 
					lpb_unit,
					lpb_code,
					lpb_description,
					lpb_condition, 
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date FROM lpb 
					";



		
		//$query .= " ORDER BY bpp_id ASC";
		//print $query;
		$process = $this->db->query($query);
		return $process;
	}

	public function show_lpb_report($lpb_id="",$criteria="")
	{
		$query = "SELECT 
					lpb_report_id,
					lpb_quantity, 
					lpb_unit,
					lpb_code,
					lpb_description,
					lpb_condition,
					tanggal,
					created_by, 
					created_date, 
					updated_by, 
					updated_date FROM lpb 
					";
				
				
		if ($criteria!="") {
			$query .= "WHERE $lpb_id IN ($criteria)"; 
		}

		// $query .= "ORDER BY $bpp_id ASC";

		$process = $this->db->query($query);
		// $query1= "UPDATE device_list INNER JOIN bpp SET device_quantity = device_quantity - out_quantity WHERE device_list.device_id = bpp.device_id";

     
                
            
    
                 
  //       $process = $this->db->query($query1);
		return $process;
	}

	public function edit_lpb($dt_lpb)
	{
		// Set var
		$edit = "1";
		$lpb_id = $dt_lpb["lpb_id"];
		$lpb_quantity    = addslashes(trim($dt_lpb["lp_quantity"]));
		$lpb_unit    	   = addslashes(trim($dt_lpb["lp_unit"]));
		$lpb_code        = $dt_lpb["lp_code"];
		$lpb_description = trim($dt_lpb["lp_description"]);
		$lpb_condition    = $dt_lpb["lp_condition"];

		// Check if device exists
		$lpb_check = count($this->show_lpb($lpb_id));
		if ($lpb_check>0) {
			// Get current values
			$lpb_curr_value = $this->show_lpb($lpb_id);
			foreach ($lpb_curr_value as $data) {
				$c_lpb_quantity       = $data["lpb_quantity"];
				$c_lpb_unit       = $data["lpb_unit"];
				// baru
				$c_lpb_code    = $data["lpb_quantity"];
				// baru
				$c_lpb_description       = $data["lpb_description"];
				$c_lpb_condition      = $data["lpb_condition"];
				
			}

	if ($edit>0) {
				// Update database & create notification
				$query = "UPDATE lpb 
							SET 
					lpb_quantity = '$lpb_quantity',
					lpb_unit = '$lpb_unit',
					lpb_code = '$lpb_code',
					lpb_description = '$lpb_description',
					lpb_condition = '$lpb_condition'
					WHERE lpb_id='$lpb_id'";
		
				$process = $this->db->query($query);
				$notification = "|";
				// create log
				if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
				}
		
			else {
				$process = 0;
				$_SESSION['new_lp_quantity']       = $lpb_quantity;
				$_SESSION['new_lp_unit']       = $lpb_unit;
				$_SESSION['new_lp_code']    = $lpb_code;
				$_SESSION['new_lp_description']       = $lpb_description;
				$_SESSION['new_lp_condition']      = $lpb_condition;
			}

		}
		// else {
		// 	$process      = 0;
		// 	$notification = "No BPP Found!";
		// }

		return $process.$notification;
	}

	
 }

 public function delete_lpb($lpb_id)
	{
		$query = "DELETE
					 FROM lpb WHERE lpb_id='$lpb_id'
					";
		//$query = "DELETE FROM bpp WHERE bpp_id='".$_GET['bpp_id']."'";
		//$this->db->query($query);
		// $this->db->bind('bpp_id', $bpp_id);

		// $this->db->execute();

		// return $this->db->rowCount();
		$process = $this->db->query($query);
		$notification = "|";
		if ($process>0) {
					$this->sysClass->save_system_log($_SESSION['username'], $query);
				}
		

		return $process.$notification;
	}

}
?>