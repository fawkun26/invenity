<?php
session_start();

/**
 *	Required Class
 */
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/location.class.php');
$locClass = new LocationClass();
require_once(__DIR__ . '/class/Bpp_model.php');
$bppModel = new Bpp_model();
require_once(__DIR__ . '/class/device.class.php');
$devClass = new DeviceClass();
// require_once(__DIR__ . '/class/bpp.class.php');
// $bppClass = new BppClass();
require_once(__DIR__ . '/class/bpp_history.class.php');
$bppHistoryClass = new BPPHistoryClass();
require_once(__DIR__ . '/class/delete.php');
$delClass = new DelClass();
// require_once(__DIR__ . '/class/device.class.php');
// $devClass = new DeviceClass();

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

// Check if user already logged in
include("./include/signin_status.php");

// get header
include("./include/include_header.php");

?>

<!DOCTYPE html>
<html>

<body>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
    <?php
    if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") {
    ?>

      <div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><?= $_SESSION['save_status'] ?></div>

    <?php
      // clear save_status session value
      unset($_SESSION['save_status']);
    }
    ?>

    <?php
    if (isset($_SESSION['modal_open']) && isset($_SESSION['modal'])) {
      if ($_SESSION['modal_open'] == 'true' && $_SESSION['modal'] == 'detail') { ?>
        <div id="is_modal_open" data-value="<?= $_SESSION['modal_open'] ?>" hidden></div>
        <div id="which_modal" data-value="<?= $_SESSION['modal'] ?>" hidden></div>
      <?php
      }
    }
    if (isset($_SESSION['bpp_history_nomor'])) { ?>
      <div id="bpp_history_nomor_hidden" data-value="<?= $_SESSION['bpp_history_nomor'] ?>" hidden></div>
    <?php }
    // unset session karena mereka semua hanya sebagai flash session.
    unset($_SESSION['modal_open']);
    unset($_SESSION['modal']);
    unset($_SESSION['bpp_history_nomor']);
    ?>

    <div class="panel panel-primary">
      <div class="panel-body">

        <ul class="nav nav-tabs d-flex" role="tablist">
          <li role="presentation" class="active">
            <a href="#bpp_list" id="bpp_list_tab" role="tab" data-toggle="tab" aria-controls="bpp_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"> </i> BPP</a>

          </li>

          <a href='bpp.php' class='btn btn-primary btn-sm ml-auto d-flex items-center'>Bpp</a>

        </ul>
      </div>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="bpp_list" aria-labelledby="bpp_list_tab">
        <table class="table table-striped table-bordered datatables">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor</th>
              <th style="width: 10%;">Jumlah BPP</th>
              <th style="width: 10%;">Total device out</th>
              <th>Tanggal</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $histories = $bppHistoryClass->get_all_with_total_bpp_and_device();
            foreach ($histories as $key => $history) { ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $history['nomor'] ?></td>
                <td><?= $history['total_bpp'] ?></td>
                <td><?= $history['total_out_quantity'] ?></td>
                <td><?= $history['tanggal'] ?></td>
                <td>
                  <button class="btn btn-sm btn-primary btn-detail" data-target="#modal_detail" data-toggle="modal" data-bpp-history-nomor="<?= $history['nomor'] ?>">Detail</button>
                  <button class="btn btn-sm btn-danger btn-delete" data-target="#modal_delete" data-toggle="modal" data-bpp-history-nomor="<?= $history['nomor'] ?>">Delete</button>
                  <a class="btn btn-sm btn-info" href="reports/bpp_history.php?history=<?= $history['nomor'] ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Print</a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>

    </div>

    <!-- Modal Detail -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_detail">
      <div class="modal-dialog" role="document" style="width: 1280px; overflow-x: scroll;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">BPP History: <strong class="label-bpp-history-nomor"></strong></h4>
          </div>
          <div class="modal-body">
            <table id="table_modal" class="table table-striped table-bordered">
              <thead>
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
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="modal_table_body">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_tambah_bpp" data-target="#modal_tambah_bpp" data-toggle="modal">Tambah BPP</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal Detail-->

    <!-- Modal Delete BPP History -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete BPP history</h4>
          </div>
          <form action="process/bpp_history.php" method="post">
            <div class="modal-body">
              <p class="mb-2">Apakah anda yakin ingin menghapus BPP history beserta BPP-BPP-nya?</p>
              <div class="form-group d-flex justify-content-center">
                <input type="hidden" name="action" value="delete_bpp_history">
                <input type="hidden" name="bpp_history_nomor" value="" id="input_delete_bpp_history_nomor">
                <input type="radio" name="is_rollback" value="true" id="radio_rollback_true" checked>
                <label for="radio_rollback_true" class="mr-2 ml-05" data-toggle="tooltip" data-placement="top" title="Mengembalikan out quantity ke database">Rollback</label>
                <input type="radio" name="is_rollback" value="false" id="radio_rollback_false">
                <label for="radio_rollback_false" class="ml-05" data-toggle="tooltip" data-placement="top" title="Tidak mengubah device quantity pada database">Keep quantity</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal Delete BPP History -->

    <!-- Modal delete BPP -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_delete_bpp">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete BPP</h4>
          </div>
          <form action="process/bpp_history.php" method="post">
            <div class="modal-body">
              <p class="mb-2">Apakah anda yakin ingin menghapus BPP Ini?</p>
              <div class="form-group d-flex justify-content-center">
                <input type="hidden" name="action" value="delete_bpp">
                <input type="hidden" name="bpp_id" value="" id="input_delete_bpp_id">
                <input type="hidden" name="out_quantity" value="" id="input_delete_out_quantity">
                <input type="hidden" name="device_id" value="" id="input_delete_device_id">
                <!-- bpp_history_nomor untuk buka modal setelah redirect -->
                <input type="hidden" name="bpp_history_nomor" value="" id="input_delete_bpp_history_nomor_bpp">
                <input type="radio" name="is_rollback" value="true" id="radio_rollback_delete_bpp_true" checked>
                <label for="radio_rollback_delete_bpp_true" class="mr-2 ml-05" data-toggle="tooltip" data-placement="top" title="Mengembalikan out quantity ke database">Rollback</label>
                <input type="radio" name="is_rollback" value="false" id="radio_rollback_delete_bpp_false">
                <label for="radio_rollback_delete_bpp_false" class="ml-05" data-toggle="tooltip" data-placement="top" title="Tidak mengubah device quantity pada database">Keep quantity</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal delete BPP -->

    <!-- Modal tambah BPP -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_tambah_bpp">
      <div class="modal-dialog modal-lg">
        <form class="form-horizontal" name="form_bpp" id="form_bpp" method="post" action="process/bpp_history.php">
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
                  <h6 class="panel-heading">Nomor: <strong class="label-bpp-history-nomor"></strong></h6>
                </legend>
                <legend>
                  <h6 class="panel-heading">Request</h6>
                </legend>
                <input type="hidden" id="input_bpp_history_nomor" name="bpp_history">
                <input type="hidden" id="input_bpp_id" name="bpp_id">
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
        </form>
      </div>
    </div>
    <!-- Modal tambah BPP -->

    <!-- Modal edit BPP -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_bpp">
      <div class="modal-dialog modal-lg">
        <form class="form-horizontal" name="form_bpp" id="form_bpp_edit" method="post" action="process/bpp_history.php">
          <input type="hidden" name="action" id="input_action_edit" value="edit_bpp">
          <input type="hidden" id="input_bpp_history_nomor_edit" name="bpp_history">
          <input type="hidden" id="input_bpp_id_edit" name="bpp_id">
          <input type="hidden" id="old_out_quantity_edit" name="old_out_quantity">
          <input type="hidden" id="old_device_id_edit" name="old_device_id">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title_bpp">Edit Bpp</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body" id="modal_content_bpp">
              <div class="box-header with-border">
                <legend>
                  <h6 class="panel-heading">Pilih BPP History</h6>
                </legend>
                <div class="form-group">
                  <label class="control-label col-sm-2">Pilih BPP history</label>
                  <div class="col-sm-8">
                    <!-- button ini jika di click akan submit <form name="create_new_bpp_history' > check bpp.js -->

                    <select class="form-control chosen-select" name="select_bpp_history" id="select_bpp_history_edit" required data-toggle="tooltip" data-placement="top" title="Ini adalah daftar BPP history pada hari ini saja">
                      <option value="">- Pilih BPP History</option>
                      <?php
                      $bpp_histories = $bppHistoryClass->get_all();
                      foreach ($bpp_histories as $key => $history) { ?>
                        <option value="<?= $history['nomor'] ?>"><?= $history['nomor'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                </div>
                <!-- <legend>
                  <h6 class="panel-heading">Nomor: <strong class="label_bpp_history_nomor"></strong></h6>
                </legend> -->
                <legend>
                  <h6 class="panel-heading">Request</h6>
                </legend>
                <div class="form-group">
                  <label class="control-label col-sm-2">Quantity</label>

                  <div class="col-sm-6">
                    <input required type="number" class="form-control" placeholder="Quantity" name="request_quantity" id="input_request_quantity_edit"><br>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Unit</label>

                  <div class="col-sm-6">

                    <input required id="input_request_unit_edit" type="text" class="form-control" placeholder="Unit" name="request_unit"><br>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Device Code</label>
                  <div class="col-sm-7">
                    <select class="form-control chosen-select" name="request_code" id="select_device_code_request_edit" required>
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
                    <input required type="text" class="form-control" placeholder="Description" name="request_description" id="input_request_description_edit"><br>
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
                    <input required type="number" class="form-control" placeholder="Quantity" name="out_quantity" id="input_out_quantity_edit"><br>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Unit</label>

                  <div class="col-sm-6">
                    <input required type="text" class="form-control" placeholder="Unit" name="out_unit" id="input_out_unit_edit"><br>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Device Code</label>

                  <div class="col-sm-7">
                    <input type="text" disabled class="form-control" id="input_device_code_out_edit">
                  </div>
                  <br>
                  <br>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <label class="control-label col-sm-2">Total</label>

                  <div class="col-sm-6">
                    <input required type="number" class="form-control" placeholder="Total" name="out_total" id="input_out_total_edit"><br>
                  </div>
                </div>
              </div>


              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_submit_edit">
                  Edit Data
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
    <!-- Modal edit BPP -->
    <?php
    // get footer
    include("./include/include_footer.php");
    // get plugins
    include("./include/init_tinymce.php");
    include("./include/init_datatables.php");
    include("./include/init_validetta.php");
    //include("./include/init_chosen.php");
    include("./include/init_fancybox.php");
    ?>
    <script src="js/bpp_history.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>

<?php
include("./include/init_chosen.php");
?>