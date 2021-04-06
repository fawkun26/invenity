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
        </div>

        <div class="modal-body" id="modal_content_bpp">

          <!-- <form action="process.php?aksi=add_bpp" method="post" enctype="multipart/form-data" id="form_bpp"  > -->


          <div class="box-header with-border">
            <!-- /.box-header -->
            <legend>
              <h6 class="panel-heading">Request</h6>
            </legend>

            <input type="show" name="bpp_id" id="bpp_id" <?php if (isset($_SESSION["new_bpp_id"])) {
                                                            echo " value='" . $_SESSION["new_bpp_id"] . "'";
                                                            unset($_SESSION['new_bpp_id']);
                                                          } ?>>

            <div class="form-group">
              <label class="control-label col-sm-2">Quantity</label>

              <div class="col-sm-6">
                <input required type="number" class="form-control" placeholder="Quantity" name="req_quantity" id="req_quantity" <?php if (isset($_SESSION["new_req_quantity"])) {
                                                                                                                                  echo " value='" . $_SESSION["new_req_quantity"] . "'";
                                                                                                                                  unset($_SESSION['new_req_quantity']);
                                                                                                                                } ?>><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit</label>

              <div class="col-sm-6">

                <input required id="unit_request" type="text" class="form-control" placeholder="Unit" name="req_unit" id="req_unit" <?php if (isset($_SESSION["new_req_unit"])) {
                                                                                                                    echo " value='" . $_SESSION["new_req_unit"] . "'";
                                                                                                                    unset($_SESSION['new_req_unit']);
                                                                                                                  } ?>><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Device Code</label>

              <!-- <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Device Code" name="req_code" id="req_code" <?php if (isset($_SESSION["new_req_code"])) {
                                                                                                                          echo " value='" . $_SESSION["new_req_code"] . "'";
                                                                                                                          unset($_SESSION['new_req_code']);
                                                                                                                        } ?>><br>
                        </div> -->
              <div class="col-sm-7">

                <!-- <input type="text" class="form-control" placeholder="Device Code" name="o_code" id="o_code" <?php if (isset($_SESSION["new_o_code"])) {
                                                                                                                    echo " value='" . $_SESSION["new_o_code"] . "'";
                                                                                                                    unset($_SESSION['new_o_code']);
                                                                                                                  } ?>><br> -->
                <select class="form-control chosen-select" name="req_code" id="device_code_request" required <?php if (isset($_SESSION["new_o_code"])) {
                                                                                                    echo " value='" . $_SESSION["new_req_code"] . "'";
                                                                                                    unset($_SESSION['new_req_code']);
                                                                                                  } ?> onchange="set_url('type_id','device_per_name',this.value)">
                  <option value="">- Select Code -</option>
                  <?php
                  // Get Semua list yang ada di table device_type

                  $device_types = "";
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
              <br>

              <div class="form-group">
                <label class="control-label col-sm-2">Description</label>

                <div class="col-sm-6">
                  <input required type="text" class="form-control" placeholder="Description" name="req_description" id="req_description" <?php if (isset($_SESSION["new_req_description"])) {
                                                                                                                                            echo " value='" . $_SESSION["new_req_description"] . "'";
                                                                                                                                            unset($_SESSION['new_req_description']);
                                                                                                                                          } ?>><br>
                </div>
              </div>
            </div>


            <div class="box-header with-border">

              <legend>
                <h6 class="panel-heading">Expenditure</h6>
              </legend>
              <div class="form-group">

                <label class="control-label col-sm-2">Quantity</label>

                <div class="col-sm-6">
                  <input required type="number" class="form-control" placeholder="Quantity" name="o_quantity" id="o_quantity" <?php if (isset($_SESSION["new_o_quantity"])) {
                                                                                                                                echo " value='" . $_SESSION["new_o_quantity"] . "'";
                                                                                                                                unset($_SESSION['new_o_quantity']);
                                                                                                                              } ?>><br>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Unit</label>

                <div class="col-sm-6">
                  <input required type="text" class="form-control" placeholder="Unit" name="o_unit" id="o_unit" <?php if (isset($_SESSION["new_o_unit"])) {
                                                                                                                  echo " value='" . $_SESSION["new_o_unit"] . "'";
                                                                                                                  unset($_SESSION['new_o_unit']);
                                                                                                                } ?>><br>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Device Code</label>

                <div class="col-sm-7">
                <input type="text" disabled class="form-control" id="device_code_out"> 

                </div>
                <br>
                <br>
              </div>


              <font class="control-font col-sm-9" size="2" color="red">*Device Code and Confirmation Device Code Must Be Same</font>





              <br>
              <br>
              <div class="form-group">
                <label class="control-label col-sm-2">Total</label>

                <div class="col-sm-6">
                  <input required type="number" class="form-control" placeholder="Total" name="o_total" id="o_total" <?php if (isset($_SESSION["new_o_total"])) {
                                                                                                                        echo " value='" . $_SESSION["new_o_total"] . "'";
                                                                                                                        unset($_SESSION['new_o_total']);
                                                                                                                      } ?>><br>
                </div>
              </div>
              <!-- <div class="form-group">
                      <label class="control-label col-sm-4">Device Id</label>
                       <div class="col-sm-9">
                         <input type="number" class="form-control" placeholder="Total" name="dev_id" id="dev_id" <?php if (isset($_SESSION["new_dev_id"])) {
                                                                                                                    echo " value='" . $_SESSION["new_dev_id"] . "'";
                                                                                                                    unset($_SESSION['new_dev_id']);
                                                                                                                  } ?>><br>>
                     </div> -->
              <div class="form-group">
                <!-- <label class="control-label col-sm-4">Date</label> -->
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" name="bp_date" id="bp_date" <?php echo date('Y-m-d'); ?>><br>
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
  </form>
</div>

<?php
include("./include/init_chosen.php");
?>