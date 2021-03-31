<?php 
    // If form error, show error
    if (isset($_SESSION["new_lp_code"])) { 
        echo "<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('#modal_dialog_lpb').modal('show');
            });
        </script>";
         $lpb_code_info = "<span class='text-danger' id='lpb_code_info'>Device with serial number : '$_SESSION[new_lp_code]' is already exists!</span>";

    }
?>
<!-- enctype="multipart/form-data" -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_lpb">
  <form class="form-horizontal" name="form_lpb" id="form_lpb" method="post" action="process.php">
  <!-- <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true"> -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_lpb">Edit Lpb</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body" id="modal_content_lpb">
      
        <!-- <form action="process.php?aksi=add_bpp" method="post" enctype="multipart/form-data" id="form_bpp"  > -->
          

                  <div class="box-header with-border"><!-- /.box-header -->
                    <legend>
                    <h6 class="panel-heading">Form LPB</h6>
                    </legend>

                    <input type="show" name="lpb_id" id="lpb_id" <?php if (isset($_SESSION["new_lpb_id"])) { echo " value='".$_SESSION["new_lpb_id"]."'"; unset($_SESSION['new_lpb_id']); } ?>>

                     <div class="form-group">
                        <label class="control-label col-sm-2">Quantity</label>
                        
                        <div class="col-sm-6">
                        <input required type="number" class="form-control" placeholder="Quantity" name="lp_quantity" id="lp_quantity" <?php if (isset($_SESSION["new_lp_quantity"])) { echo " value='".$_SESSION["new_lp_quantity"]."'"; unset($_SESSION['new_lp_quantity']); } ?>><br>
                        </div>
                      </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Unit</label>
                      
                        <div class="col-sm-6">
                        
                        <input required type="text" class="form-control" placeholder="Unit" name="lp_unit" id="lp_unit" <?php if (isset($_SESSION["new_lp_unit"])) { echo " value='".$_SESSION["new_lp_unit"]."'"; unset($_SESSION['new_lp_unit']); } ?>><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Device Code</label>
                        
                        <!-- <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Device Code" name="req_code" id="req_code" <?php if (isset($_SESSION["new_req_code"])) { echo " value='".$_SESSION["new_req_code"]."'"; unset($_SESSION['new_req_code']); } ?>><br>
                        </div> -->
                        <div class="col-sm-7">
                      
                        <!-- <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>><br> -->
                        <select class="form-control chosen-select" name="lp_code" id="lp_code" required <?php if (isset($_SESSION["new_lp_code"])) { echo " value='".$_SESSION["new_lp_code"]."'"; unset($_SESSION['new_lp_code']); } ?> onchange="set_url('type_id','device_per_name',this.value)">
                        <option value="">- Select Code -</option>
                      <?php 
                      // Get Semua list yang ada di table device_type

                      // $device_types     = "";
                      // $device_type_list = $devClass->show_device_type();
                      // foreach ($device_type_list as $device_type_data) {
                      //   $device_type_id   = $device_type_data["type_id"];
                      //    // $bpp_type_name = $bpp_type_data["request_code"];
                      //    // $bpp_types    .= "<option value='$bpp_type_id'>$bpp_type_name</option>";

                      //    $device_type_name = $device_type_data["type_name"];
                      //    $device_type_code = $device_type_data["type_code"];
                      //    $device_types    .= "<option value='$device_type_code'>$device_type_name($device_type_code)</option>";
                      // }
                      // echo $device_types;

                      $device_types ="";
                      $device_type_list = $devClass->show_device1();
                       //$device_type_list = $devClass->show_device();
                      
                      foreach ($device_type_list as $device_type_data) {
                        //$device_type_id   = $device_type_data["type_id"];
                        $device_list_id   = $device_type_data["device_id"];

                         $device_type_name = $device_type_data["type_name"];
                         $device_type_code = $device_type_data["device_code"];
                         $device_type_serial  = $device_type_data["device_serial"];
                         $device_types    .= "<option value='$device_type_name(code=$device_type_code)(serial=$device_type_serial)'>$device_type_name (code=$device_type_code) (serial=$device_type_serial)</option>";
                         }
                      echo $device_types;
                      ?>
                    </select>

                      </div>

                    </div>
                    <br>

                    
                  

                    
               

                   <div class="form-group">
                   <label class="control-label col-sm-2">Confirmation Device Code</label>

                   <div class="col-sm-7">
                        <!-- <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>><br> -->
                        <select required class="form-control chosen-select" name="dev_id" id="dev_id" <?php if (isset($_SESSION["new_dev_id"])) { echo " value='".$_SESSION["new_dev_id"]."'"; unset($_SESSION['new_dev_id']); } ?>onchange="set_url('type_id','device_per_name',this.value)">
                        <option value="">- Select Code -</option>
                         
                       <?php 
                      // Get location
                       // Select buat semua yang ada di table device list
                      $device_types ="";
                      $device_types1 ="";
                      $device_type_list = $devClass->show_device1();
                       //$device_type_list = $devClass->show_device();
                      
                      foreach ($device_type_list as $device_type_data) {
                        //$device_type_id   = $device_type_data["type_id"];
                        $device_list_id   = $device_type_data["device_id"];

                         $device_type_name = $device_type_data["type_name"];
                         $device_type_code = $device_type_data["device_code"];
                         $device_type_serial  = $device_type_data["device_serial"];
                         $device_types1   .= "<option value='$device_list_id'>$device_type_name (code=$device_type_code)(serial=$device_type_serial)</option>";
                         }
                      echo $device_types1;


                      ?> 

                     
                     </select>
                   </div>

                   </div>
                   <font class="control-font col-sm-9" size="2" color="red">*Device Code and Confirmation Device Code Must Be Same</font>

                    

                  
                   
                    <br>
                    <br>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Description</label>
                        
                        <div class="col-sm-6">
                        <input required type="text" class="form-control" placeholder="Description" name="lp_description" id="lp_description" <?php if (isset($_SESSION["new_lp_description"])) { echo " value='".$_SESSION["new_lp_description"]."'"; unset($_SESSION['new_lp_description']); } ?>><br>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2">Conditon</label>

                      <div class="col-sm-6">
                        <input required type="number" class="form-control" placeholder="Condition" name="lpb_condition" id="lpb_condition" <?php if (isset($_SESSION["new_lp_condition"])) { echo " value='".$_SESSION["new_lp_conditon"]."'"; unset($_SESSION['new_lp_condition']); } ?>><br>
                      </div>
                    </div>
                        <!-- <div class="form-group">
                      <label class="control-label col-sm-4">Device Id</label>
                       <div class="col-sm-9">
                         <input type="number" class="form-control" placeholder="Total" name="dev_id" id="dev_id" <?php if (isset($_SESSION["new_dev_id"])) { echo " value='".$_SESSION["new_dev_id"]."'"; unset($_SESSION['new_dev_id']); } ?>><br>
                       </div>
                     </div> -->
                    <div class="form-group">
                      <!-- <label class="control-label col-sm-4">Date</label> -->
                      <div class="col-sm-9">
                        <input type="hidden"  class="form-control"  placeholder="<?php echo date('Y-m-d'); ?>" name="bp_date" id="bp_date" <?php echo date('Y-m-d'); ?>><br>
                      </div>
                    </div>
                </div>
                  
            
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Edit Data
        </button>
        <input type="hidden" name="action" id="action" value="edit_lpb">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>


    </div>
  </div>
      
    </div>
  
  </form>
</div>
<!-- <script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#bpp_id").on('change', function(event) {
            var bppid = $(this).find('option:selected').attr('o_code');
            $("#dynamic_bppid").html(bppid);

            // trim the span, set the value
            // var dev_code = $("#dev_code_view").html().replace('<span id="dynamic_devtype">','');
            // var dev_code = dev_code.replace("</span>","");
            // $("#dev_code").val(dev_code);
        });
    });
</script> -->

<?php 
//include("./include/init_chosen.php");

if (isset($_SESSION["new_lp_code"])) {
    unset($_SESSION['new_lpb_id'], 
        $_SESSION['new_lp_quantity'],         
        $_SESSION['new_lp_unit'],       
        $_SESSION['new_lp_code'],         
        $_SESSION['new_lp_description'],       
        $_SESSION['new_lp_condition']   
        );     
}
?>
