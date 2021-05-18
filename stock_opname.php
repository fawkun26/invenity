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
			<legend>Form Stock Opname</legend>
                <div class="box-header with-border"></div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form">
                    <!-- text input -->
                    <div class="form-group">
                      <label class="control-label col-sm-2">Device Name</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Device Name"><br>
                    </div></div><br>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Model</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Model"><br>
                    </div></div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Device Code</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Device Code"><br>
                    </div></div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Quantity</label>
                      <div class="col-sm-9">
                      <input type="number" class="form-control" placeholder="Quantity"><br>
                    </div></div>


                    <hr class="dashed">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="report_summary.php?by=a.location_id&name=per_location" target="_blank" class=" btn btn-primary">Print</a>

                </form>

               <div class="panel-body">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#lpb_list" id="lpb_list_tab" role="tab" data-toggle="tab" aria-controls="lpb_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"></i> Stock Opname</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="lpb_list" aria-labelledby="lpb_list_tab">
          <table class='table table-striped table-bordered datatables'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. LPB</th>                  
                  <!--<th>Device Name</th>-->
                  <th>Quantity</th>
                  <!--<th>SN</th>-->                                    
                  <th>Actions</th>
                </tr>

              </thead>
              <tbody>
        </div>
      </div>
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