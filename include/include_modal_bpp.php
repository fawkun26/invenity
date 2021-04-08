<?php
// If form error, show error
if (isset($_SESSION["new_out_code"])) {
  echo "<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('#modal_dialog_bpp').modal('show');
            });
        </script>";
  $bpp_code_info = "<span class='text-danger' id='bpp_code_info'>Device with serial number : '$_SESSION[new_out_code]' is already exists!</span>";
}
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_bpp">
  <form class="form-horizontal" name="form_bpp" id="form_bpp" method="post" action="process/bpp.php">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title_bpp">Add Bpp</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="modal_content_bpp">
          <div class="box-header with-border">
            <legend>
              <h6 class="panel-heading">Request</h6>
            </legend>
            <input type="hidden" id="input_bpp_id" name="bpp_id">
            <input type="hidden" id="input_old_out_quantity" name="old_out_quantity">
            <input type="hidden" id="input_old_device_id" name="old_device_id">
            <div class="form-group">
              <label class="control-label col-sm-2">Quantity</label>

              <div class="col-sm-6">
                <input required type="number" class="form-control" placeholder="Quantity" name="request_quantity" id="input_request_quantity"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit</label>

              <div class="col-sm-6">

                <input required id="input_request_unit" type="text" class="form-control" placeholder="Unit" name="request_unit"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Device Code</label>
              <div class="col-sm-7">
                <select class="form-control chosen-select" name="request_code" id="select_device_code_request" required>
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
                   
                  ?>
                  <option data-device='<?= "$device_type_name (code=$device_type_code) (serial=$device_type_serial)" ?>' value="<?= $device_list_id ?>"><?= "$device_type_name (code=$device_type_code) (serial=$device_type_serial)" ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>

            <div class="form-group">
              <label class="control-label col-sm-2">Description</label>

              <div class="col-sm-6">
                <input required type="text" class="form-control" placeholder="Description" name="request_description" id="input_request_description"><br>
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
                <input required type="number" class="form-control" placeholder="Quantity" name="out_quantity" id="input_out_quantity"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit</label>

              <div class="col-sm-6">
                <input required type="text" class="form-control" placeholder="Unit" name="out_unit" id="input_out_unit"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Device Code</label>

              <div class="col-sm-7">
                <input type="text" disabled class="form-control" id="input_device_code_out">
              </div>
              <br>
              <br>
            </div>
            <br>
            <br>
            <div class="form-group">
              <label class="control-label col-sm-2">Total</label>

              <div class="col-sm-6">
                <input required type="number" class="form-control" placeholder="Total" name="out_total" id="input_out_total"><br>
              </div>
            </div>
          </div>


          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit">
              Tambah Data
            </button>
            <input type="hidden" name="action" id="input_action" value="add_bpp">
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