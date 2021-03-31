<?php
session_start();

/**
*	Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/location.class.php');
$locClass = new LocationClass();
require_once(__DIR__ . '/class/device.class.php');
$devClass = new DeviceClass();

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

// Check if user already logged in
include("./include/signin_status.php");

// get header
include("./include/include_header.php");

?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php 
	if (isset($_SESSION['save_status']) && $_SESSION['save_status']!=""){
		// show info
		echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
		// clear save_status session value
		$_SESSION["save_status"] = "";
	}
	?>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="glyphicon glyphicon-briefcase"></i> &nbsp; <?php echo $current_page_name; ?>
				</h3>
				<br>
			</div>

			<div class='panel-body'>
				    <form name="form_user" class="form-horizontal validetta" enctype="multipart/form-data" id="form_user" method="post" action="process.php">
				 <legend>LPB Form</legend>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="device_lpb">Device Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="device_lpb" id="device_lpb" placeholder="Device Name" data-validetta="required" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="brand_lpb">Brand Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="brand_lpb" id="brand_lpb" placeholder="Brand Name" data-validetta="required" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="model_lpb">Model</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="model_lpb" id="model_lpb" placeholder="Model" data-validetta="required" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="quantity_lpb">Quantity</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="quantity_lpb" id="quantity_lpb" placeholder="Quantity" data-validetta="required" value="">
                    </div>
                </div>

                <!-- <hr class="dashed">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="photo">User Photo</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="photo" id="photo"> 
                        <span class="help-block">Max file size 2 Mb. JPEG, PNG and GIF. (Optional)</span
                    </div>
                </div> -->

                
            	<hr class="dashed">
                <!-- <input type="hidden" name="level" id="level" value="user">
                <input type="hidden" name="action" id="action" value="edit_user">
                <input type="hidden" name="action2" id="action2" value="edit_user">
                <a href="" class="btn btn-default" >Cancel</a> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="report_lpb.php?by=a.location_id&name=per_location" target="_blank" class=" btn btn-primary">Print</a>
		    </form>
		</div>
	</div>
</div>


<?php


// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_tinymce.php");
include("./include/init_datatables.php");
include("./include/init_validetta.php");
include("./include/init_chosen.php");
include("./include/init_fancybox.php");
// get page setting
echo "<script type='text/javascript' src='./js/device_management.js'></script>";
include("./include/include_modal_device_detail.php");
include("./include/include_modal_device.php");
include("./include/include_modal_device_type.php");
// include("./include/include_modal_device_edit.php");
?>