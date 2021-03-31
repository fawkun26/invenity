<?php 
    // If form error, show error
    if (isset($_SESSION["new_o_code"])) { 
        echo "<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('#modal_dialog_bpp').modal('show');
            });
        </script>";
         $bpp_code_info = "<span class='text-danger' id='bpp_code_info'>Device with serial number : '$_SESSION[new_o_code]' is already exists!</span>";

    }
?>
<!-- enctype="multipart/form-data" -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_bpp">
  <form class="form-horizontal" name="form_bpp" id="form_bpp" method="post" action="process.php">
  <!-- <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true"> -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title_bpp">Add Bpp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      <div class="modal-body" id="modal_content_bpp">
      
        <!-- <form action="process.php?aksi=add_bpp" method="post" enctype="multipart/form-data" id="form_bpp"  > -->
          
          <!-- <input type="hidden" name="id" id="id">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>

         <div class="form-group">
          <label for="nis">NIS</label>
          <input type="number" class="form-control" id="nis" name="nis">
        </div>

         <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email">
        </div> -->
                  <div class="box-header with-border"><!-- /.box-header -->
                    <legend>
                    <h6 class="panel-heading">Request</h6>
                    </legend>
                    <!-- <div class="form-group" type ="hidden">
                      <label class="control-label col-sm-2">Id</label>
                      <div class="col-sm-9"> -->
                  <!-- <div id="only_edit"> -->
                    <input type="show" name="bpp_id" id="bpp_id" <?php if (isset($_SESSION["new_bpp_id"])) { echo " value='".$_SESSION["new_bpp_id"]."'"; unset($_SESSION['new_bpp_id']); } ?>><br>
                  <!-- </div> -->
                     <!-- </div>
                    </div> -->
                     <div class="form-group">
                        <label class="control-label col-sm-4">Quantity</label>
                        <div class="col-sm-9">
                        <input required type="number" class="form-control" placeholder="Quantity" name="req_quantity" id="req_quantity" <?php if (isset($_SESSION["new_req_quantity"])) { echo " value='".$_SESSION["new_req_quantity"]."'"; unset($_SESSION['new_req_quantity']); } ?>><br>
                        </div>
                      </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4">Unit</label>
                        <div class="col-sm-9">
                        <input required type="text" class="form-control" placeholder="Unit" name="req_unit" id="req_unit" <?php if (isset($_SESSION["new_req_unit"])) { echo " value='".$_SESSION["new_req_unit"]."'"; unset($_SESSION['new_req_unit']); } ?>><br>
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="control-label col-sm-4">Device Code</label>
                        <!-- <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Device Code" name="req_code" id="req_code" <?php if (isset($_SESSION["new_req_code"])) { echo " value='".$_SESSION["new_req_code"]."'"; unset($_SESSION['new_req_code']); } ?>><br>
                        </div> -->
                        <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>><br> -->
                        <select class="form-control chosen-select" name="req_code" id="req_code" required <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_req_code"]."'"; unset($_SESSION['new_req_code']); } ?> onchange="set_url('type_id','device_per_name',this.value)">
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
                        <label class="control-label col-sm-4">Description</label>
                        <div class="col-sm-9">
                        <input required type="text" class="form-control" placeholder="Description" name="req_description" id="req_description" <?php if (isset($_SESSION["new_req_description"])) { echo " value='".$_SESSION["new_req_description"]."'"; unset($_SESSION['new_req_description']); } ?>><br>
                        </div>
                    </div>
                  </div>

                    
                <div class="box-header with-border">
                  <br>
                  <br>
                    <legend>
                    <h6 class="panel-heading">Expenditure</h6>
                    </legend>
                    <div class="form-group">
                      
                      <label class="control-label col-sm-4">Quantity</label>
                      <div class="col-sm-9">
                        <input required type="number" class="form-control" placeholder="Quantity" name="o_quantity" id="o_quantity" <?php if (isset($_SESSION["new_o_quantity"])) { echo " value='".$_SESSION["new_o_quantity"]."'"; unset($_SESSION['new_o_quantity']); } ?>><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4">Unit</label>
                      <div class="col-sm-9">
                        <input required type="text" class="form-control" placeholder="Unit" name="o_unit" id="o_unit" <?php if (isset($_SESSION["new_o_unit"])) { echo " value='".$_SESSION["new_o_unit"]."'"; unset($_SESSION['new_o_unit']); } ?>><br>
                      </div>
                    </div>
                    <div class="input-group">
                      <label class="control-label col-sm-4">Device Code</label>
                      <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>><br> -->
                        <select required class="form-control chosen-select" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) { echo " value='".$_SESSION["new_o_code"]."'"; unset($_SESSION['new_o_code']); } ?>onchange="set_url('type_id','device_per_name',this.value)">
                        <option value="">- Select Code -</option>
                            
                       <?php 
                      // Get location
                       // Select buat semua yang ada di table device list
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

                     <br>
                     <br>
                   </div>

                   <label class="control-label col-sm-6">Input Again Device Code</label>
                   <div class="col-sm-9">
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

                     <br>
                     <br>
                   </div>

                    <font class="control-font col-sm-9" size="2" color="red">*Device Code and Input Again Device Code Must Be Same</font>

                  </div>
                     <!-- <div class="input-group">
                      <div class="col-sm-9">
                         <label for="exampleSelect2" class="control-label">Select Serial</label>    <font color=red>Required (*)</color></font>
                         <div class="controls">
                          <select name="country" class="form-control" id="device_serial" ><option><?= $device_types2 ?></option></select>
                         </div>
                      </div>
                    </div> -->
                     

                   <!--  <button type="button" onclick="myFunction()">Coba Klik</button> -->

                      <!-- <select id="device_serial" name="tampil"> 
                      
                     <option>xxxxxxx</option>
                       

                      </select>  -->
                    <!-- </div> -->
                    <!-- //"<option value=''> Select Date Type </option>"
                       // echo '<option value="'.$device_type_list2['device_serial'].'">'.$ -->
                        <!-- onchange="set_url("device_code","device_per_name",this.value)" -->
                         <!-- //device_type_list2['device_serial'].'</option>'; -->

                         <!-- // contoh dropdown sub katageroi  -->
                         <!-- <option value="device_code">- makanan -</option>
                        <option value="device_serial">- minuman-</option>

                      </select>

                      <br><br>
                      <label>Pilih Sub Kategori: </label> 
                      <select id="tampil" name="tampil">
                      </select> -->

                      <!-- //</div> -->
                    <!-- </div> -->
                    <br>
                    <div class="form-group">
                      <label class="control-label col-sm-4">Total</label>
                      <div class="col-sm-9">
                        <input required type="number" class="form-control" placeholder="Total" name="o_total" id="o_total" <?php if (isset($_SESSION["new_o_total"])) { echo " value='".$_SESSION["new_o_total"]."'"; unset($_SESSION['new_o_total']); } ?>><br>
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
        
        <button type="submit" class="btn btn-primary">Tambah Data
        </button>
        <input type="hidden" name="action" id="action" value="add_bpp">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>


      
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
include("./include/init_chosen.php");
?>
