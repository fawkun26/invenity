<form class="form-horizontal" name="form_bpp" id="form_bpp" method="post" enctype="multipart/form-data" action="process.php">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="glyphicon glyphicon-briefcase"></i> &nbsp; <?php echo $current_page_name; ?>
			<!--	<span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_device_type()"><i class="glyphicon glyphicon-plus"></i> Add Device Type</button></span> -->
				<!-- <span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_bpp()"><i class="glyphicon glyphicon-plus"></i> Add BPP</button></span> -->
			</h3>
			<br>
		</div>
		<div class='panel-body'>

			<legend>BPP Form</legend>
			<h6 class="panel panel-heading" id="modal_title_bpp">Request</h6>
                <div class="box-header with-border"><!-- /.box-header -->
                <div class="box-body">
                  <!-- <form role="form"> -->
                    <!-- text input -->
                    <!-- <div class="form-group">
                        <label class="control-label col-sm-3">Model</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="dev_model" id="dev_model" <?php if (isset($_SESSION["new_dev_model"])) { echo " value='".$_SESSION["new_dev_model"]."'"; unset($_SESSION['new_dev_model']); } ?>>
                        </div>
                    </div> -->
                       <div class="form-group">
                        <label class="control-label col-sm-2">Quantity</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" placeholder="Quantity" name="req_quantity" id="req_quantity" <?php if (isset($_SESSION["new_req_quantity"])) { echo " value='".$_SESSION["new_req_quantity"]."'"; unset($_SESSION['new_req_quantity']); } ?>><br>

                        </div>
                      </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Unit</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Unit" name="req_unit" id="req_unit" <?php if (isset($_SESSION["new_req_unit"])) { echo " value='".$_SESSION["new_req_unit"]."'"; unset($_SESSION['new_req_unit']); } ?>><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Device Code</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Device Code" name="req_code" id="req_code" <?php if (isset($_SESSION["new_req_code"])) { echo " value='".$_SESSION["new_req_code"]."'"; unset($_SESSION['new_req_code']); } ?>><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Description</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Description" name="req_description" id="req_description" <?php if (isset($_SESSION["new_req_description"])) { echo " value='".$_SESSION["new_req_description"]."'"; unset($_SESSION['new_req_description']); } ?>><br>
                        </div>
                    </div>

                    <h6 class="panel panel-heading">Expenditure</h6>
                <div class="box-header with-border"></div><!-- /.box-header -->
                <div class="box-body">
                  <!-- <form role="form"> -->
                    <!-- text input -->
                    <div class="form-group">
                      <label class="control-label col-sm-2">Quantity</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" placeholder="Quantity" name="o_quantity" id="o_quantity" <?php if (isset($_SESSION["new_o_quantity"])) { echo " value='".$_SESSION["new_o_quantity"]."'"; unset($_SESSION['new_o_quantity']); } ?>><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Unit</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Unit" name="o_unit" id="o_unit" <?php if (isset($_SESSION["new_o_unit"])) { echo " value='".$_SESSION["new_o_unit"]."'"; unset($_SESSION['new_o_unit']); } ?>><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Device Code</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Total</label>
                      <div class="col-sm-9">
                        <input type="" class="form-control" placeholder="Total" name="o_total" id="o_total" <?php if (isset($_SESSION["new_o_total"])) { echo " value='".$_SESSION["new_o_total"]."'"; unset($_SESSION['new_o_total']); } ?>><br>
                      </div>
                    </div>


                    <hr class="dashed">
                <!-- <input type="hidden" name="level" id="level" value="user">
                <input type="hidden" name="action" id="action" value="edit_user">
                <input type="hidden" name="action2" id="action2" value="edit_user">
                <a href="" class="btn btn-default" >Cancel</a> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="report_summary.php?by=a.location_id&name=per_location" target="_blank" class=" btn btn-primary">Print</a>

                <!-- </form> -->

            </div>
          </div>
        </div>
      </div>
    </div>
    </form>


    <table class='table table-striped table-bordered datatables'>
            <tr>
                  <th>No</th>
                  <th>Diminta</th>    
                  <th>Satuan</th>
                  <th>Kode Barang</th>     
                  <th>Uraian</th>                 
                  <th>Dikeluarkan</th>
                  <th>Satuan</th> 
                  <th>Kode Barang</th>
                  <th>Total</th>
                  <th>Action</th>
            </tr>

            <?php
            $no   = 1;
            $bpp = $bppClass->show_bpp();
            //if (count($bpp)>0) {
       //        $no      = 0;
       //        $content = "<table class='table table-striped table-bordered datatables'>
       //        <thead>
                
              // </thead>
              // <tbody>";
       //      }  

              foreach ($bpp as $bpp_data) {
                ?>
                <tr>
                  <td><?= $no++; ?><td>
                  <td><?= $bpp_data['request_quantity']; ?></td>
                  <td><?= $bpp_data['request_unit']; ?></td>
                  <td><?= $bpp_data['request_code']; ?></td>
                  <td><?= $bpp_data['request_description']; ?></td>
                  <td><?= $bpp_data['out_quantity']; ?></td>
                  <td><?= $bpp_data['out_unit']; ?></td>
                  <td><?= $bpp_data['out_code']; ?></td>
                  <td><?= $bpp_data['out_total']; ?></td>
                  <td>
                  <button type ='button' class='glyphicon glyphicon-pencil float-right ml-1 tampilModalEdit' data-toggle='modal' data-target='#formModal' title='Edit Bpp' onclick=\"show_edit_bpp('$bpp_id')\">edit</button>
                  
                  <a href='http://localhost/invenity/process.php?aksi=delete_bpp'>Hapus</a>
                  </td>
                <!-- $bpp_id      = $bpp_data["bpp_id"];
                $request_quantity   = $bpp_data["request_quantity"];
                $request_unit   = $bpp_data["request_unit"];
                $request_code   = $bpp_data["request_code"];
                $request_description   = $bpp_data["request_description"];
                $out_quantity    = $bpp_data["out_quantity"];
                $out_unit    = $bpp_data["out_unit"];
                $out_code    = $bpp_data["out_code"];
                $out_total = $bpp_data["out_total"]; -->
                
              <!-- $content .= "<tr>
                  <td>$no</td>
                  <td>$request_quantity</td>
                  <td>$request_unit</td>
                  <td>$request_code</td>
                  <td>$request_description</td>
                  <td>$out_quantity</td>
                  <td>$out_unit</td>
                  <td>$out_code</td>
                  <td>$out_total</td> -->
                  <!-- <input type='hidden' id='l_bpp_id_$bpp_id' value='$bpp_id'>
                  <input type='hidden' id='l_req_quantity_$bpp_id' value='$request_quantity'>
                  <input type='hidden' id='l_req_unit_$bpp_id' value='$request_unit'>
                  <input type='hidden' id='l_req_code_$bpp_id' value='$request_code'>
                  <input type='hidden' id='l_req_description_$bpp_id' value='$request_description'>
                  <input type='hidden' id='l_o_quantity_$bpp_id' value='$out_quantity'>
                  <input type='hidden' id='l_o_unit_$bpp_id' value='$out_unit'>
                  <input type='hidden' id='l_o_code_$bpp_id' value='$out_code'>
                  <input type='hidden' id='l_o_total_$bpp_id' value='$out_total'> -->
                  <!-- <td>
                  <button type ='button' class='glyphicon glyphicon-pencil float-right ml-1 tampilModalEdit' data-toggle='modal' data-target='#formModal' title='Edit Bpp' onclick=\"show_edit_bpp('$bpp_id')\">edit</button>
                  
                  <a href='http://localhost/invenity/process.php?aksi=delete_bpp'>Hapus</button>
                  </td> -->
                  
                
                <?php
              //}
              // $content .= "</tbody></table>";
              // echo $content;
            }
          //}
            // }
            // else {
            //   echo "<p>No Data Found!</p>";
            // }
          ?>
          </table>


          <!-- if ($device_quantity < $out_quantity) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
            document.location='./';
        </script>
        <?php
    }
    //proses    
    else{
        // $tambah =mysqli_query("INSERT INTO tb_out (id_brg, nomor, jumlah) VALUES ('$id_brg', '$nomor', '$jumlah')");
            if($tambah){
                //update stok
                $upstok= mysqli_query($conn, "UPDATE device_list SET device_quantity='$sisa' WHERE type_id='$type_id'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='./';
                </script>
                <?php
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    } -->

    // <div class="form-group">
    //                   <label class="control-label col-sm-4">Device Id</label>
    //                   <div class="col-sm-9">
    //                     <input type="number" class="form-control" placeholder="Total" name="dev_id" id="dev_id" <?php if (isset($_SESSION["new_dev_id"])) { echo " value='".$_SESSION["new_dev_id"]."'"; unset($_SESSION['new_dev_id']); } ?>><br>
    //                   </div>
    //                 </div>

    // lpb

    
    <?php
session_start();

/**
* Required Class
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
        <!-- <span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_device_type()"><i class="glyphicon glyphicon-plus"></i> Add Device Type</button></span>
        <span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_device()"><i class="glyphicon glyphicon-plus"></i> Add Device</button></span> -->
        </h3>
        <br>
      </div>

      <div class='panel-body'>
      <!--  <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#dev_list" id="dev_list_tab" role="tab" data-toggle="tab" aria-controls="dev_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"></i> Device List</a>
        </li>
        <li role="presentation">
          <a href="#dev_type_list" id="dev_type_list_tab" role="tab" data-toggle="tab" aria-controls="dev_type_list" aria-expanded="true"><i class="glyphicon glyphicon-pushpin"></i> Device Type List</a>
        </li>
      </ul> -->
      <legend>Form LPB</legend>
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
                    <div class="form-group">
                      <label class="control-label col-sm-2">Condition</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Condition"><br>
                    </div></div>


                    <hr class="dashed">
                <!-- <input type="hidden" name="level" id="level" value="user">
                <input type="hidden" name="action" id="action" value="edit_user">
                <input type="hidden" name="action2" id="action2" value="edit_user">
                <a href="" class="btn btn-default" >Cancel</a> -->
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="report_summary.php?by=a.location_id&name=per_location" target="_blank" class=" btn btn-primary">Print</a>

                </form>

  <!-- <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i class="glyphicon glyphicon-briefcase"></i> &nbsp; <?php echo $current_page_name; ?>
      
        <span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_lpb()"><i class="glyphicon glyphicon-plus"></i> Add LPB</button></span> 
      </h3>
      <br> -->
    </div>
    <div class='panel-body'>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#lpb_list" id="lpb_list_tab" role="tab" data-toggle="tab" aria-controls="lpb_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"></i> LPB</a>
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
echo "<script type='text/javascript' src='./js/lpb.js'></script>";
include("./include/include_modal_lpb.php"); 
// include("./include/include_modal_device_edit.php");
?>