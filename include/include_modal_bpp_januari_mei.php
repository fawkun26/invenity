<?php

// require_once '../vendor/autoload.php';

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
<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_bpp_januari_mei">
  <div class="modal-dialog modal-lg">
    <form class="form-horizontal" name="form_bpp" id="form_bpp_januari_mei" method="post" action="process/bpp.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title_bpp_januari_mei">Add Bpp</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="modal_content_bpp_januari_mei">
          <div class="box-header with-border">
            <legend>
              <h6 class="panel-heading">Buat BPP History</h6>
            </legend>
            <input type="hidden" name="action" value="create_bpp_history">
            <div class="form-group">
              <label class="control-label col-sm-2">Pilih Bulan</label>
              <div class="col-sm-8">
                <select name="bulan" id="bpp_history_bulan" class="form-control chosen-select">
                  <option value="">- Pilih Bulan</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Pilih Tanggal</label>
              <div class="col-sm-8">
                <select name="tanggal" id="bpp_history_tanggal" class="form-control chosen-select">
                  <option value="">- Pilih Tanggal</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                <button class="btn btn-primary mb-2" id="btn_create_bpp_history_januari_mei" type="button" type="submit"><span class="glyphicon glyphicon-alert
"></span>Buat BPP history baru</button> <small style="color: red" id="error_msg_create_bpp_history"><span class="glyphicon glyphicon-exclamation-sign"></span>Pilih bulan dan tanggal terlebih dahulu</small>
              </div>
            </div>
            <legend>
              <h6 class="panel-heading">BPP History</h6>
            </legend>
            <div class="form-group">
              <label class="control-label col-sm-2">Pilih BPP history</label>
              <div class="col-sm-8">
                <!-- button ini jika di click akan submit <form name="create_new_bpp_history' > check bpp.js -->
                <div data-toggle="tooltip" data-placement="top" title="Ini adalah daftar BPP history rentang Januari-Mei">
                  <select class="form-control chosen-select" name="select_bpp_history" id="select_bpp_history_januari_mei" required data-toggle="tooltip" data-placement="top" title="Ini adalah daftar BPP history rentang Januari-Mei">
                    <option value="">- Pilih BPP History</option>
                    <?php
                    $bpp_histories = $bppHistoryClass->get_between_january_may();
                    foreach ($bpp_histories as $key => $history) { ?>
                      <option value="<?= $history['nomor'] ?>"><?= $history['nomor'] ?></option>
                    <?php } ?>
                  </select>
                </div>

              </div>
            </div>


            <legend>
              <h6 class="panel-heading">Request</h6>
            </legend>
            <input type="hidden" id="input_bpp_id_januari_mei" name="bpp_id">
            <input type="hidden" id="input_old_out_quantity_januari_mei" name="old_out_quantity">
            <input type="hidden" id="input_old_device_id_januari_mei" name="old_device_id">
            <div class="form-group">
              <label class="control-label col-sm-2">Quantity</label>

              <div class="col-sm-6">
                <input required type="number" class="form-control" placeholder="Quantity" name="request_quantity" id="input_request_quantity_januari_mei"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit</label>

              <div class="col-sm-6">

                <input required id="input_request_unit_januari_mei" type="text" class="form-control" placeholder="Unit" name="request_unit"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Device Code</label>
              <div class="col-sm-7">
                <select class="form-control chosen-select" name="request_code" id="select_device_code_request_januari_mei" required>
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
                <input required type="text" class="form-control" placeholder="Description" name="request_description" id="input_request_description_januari_mei"><br>
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
                <input required type="number" class="form-control" placeholder="Quantity" name="out_quantity" id="input_out_quantity_januari_mei"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit</label>

              <div class="col-sm-6">
                <input required type="text" class="form-control" placeholder="Unit" name="out_unit" id="input_out_unit_januari_mei"><br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Device Code</label>

              <div class="col-sm-7">
                <input type="text" disabled class="form-control" id="input_device_code_out_januari_mei">
              </div>
              <br>
              <br>
            </div>
            <br>
            <br>
            <div class="form-group">
              <label class="control-label col-sm-2">Total</label>

              <div class="col-sm-6">
                <input required type="number" class="form-control" placeholder="Total" name="out_total" id="input_out_total_januari_mei"><br>
              </div>
            </div>
          </div>


          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_submit_januari_mei">
              Tambah Data
            </button>
            <input type="hidden" name="action" id="input_action_januari_mei" value="add_bpp">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </form>
  </div>

  <form action="process/bpp_history_januari_mei.php" method="post" name="create_bpp_history" id="form_create_bpp_history_januari_mei">
    <input type="hidden" name="bulan" value="" id="bulan_hidden">
    <input type="hidden" name="tanggal" value="" id="tanggal_hidden">
    <input type="hidden" name="action" value="create_bpp_history">
  </form>
</div>