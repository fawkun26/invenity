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
require_once(__DIR__ . '/class/device.class.php');
$devClass = new DeviceClass();
require_once(__DIR__ . '/class/opname.class.php');
$opnameClass = new OpnameClass();

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

// Check if user already logged in
include("./include/signin_status.php");

// get header
include("./include/include_header.php");
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

  <?php
  // $devices = $opnameClass->get_all_device_for_input();
  // dump($devices);
  ?>

  <ol class="breadcrumb-progress bg-white mb-2" id="breadcrumb">
    <li data-step="1"><span>Input devices</span></li>
    <li data-step="2"><span>Print kosong</span></li>
    <li data-step="3"><span>Check fisik</span></li>
    <li data-step="4"><span>Input quantity</span></li>
    <li data-step="5"><span>Check selisih</span></li>
    <li data-step="6"><span>Print</span></li>
  </ol>

  <div class="step mb-2" data-step="1" id="step_1">
    <div class="card">
      <div class="card-title">
        <h4 class="m-0">Input device</h4>
      </div>
      <div class="card-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2 text-left">Nama device</label>
            <div class="col-sm-10">
              <select class="form-control chosen-select" name="select_device" id="select_device" required>
                <option value="">- Pilih Device</option>
                <?php
                // $bpp_histories = $bppHistoryClass->get_by_current_day_and_month();
                $devices = $opnameClass->get_all_device_for_input();
                foreach ($devices as $key => $device) {
                  $nama_device =  $device['type_name'] . ' type_code=' . $device['type_code'] . ' device_serial=' . $device['device_serial'];
                ?>
                  <option value="<?= $device['device_id'] ?>" data-nama-device="<?= $nama_device ?>"><?= $nama_device ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <button class="btn btn-primary" id="btn_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
        </form>
      </div>
    </div>
  </div>

  <div class="step mb-2" data-step="2" id="step_2">

    <div class="card">
      <div class="card-title">
        <h5>Daftar device</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered" id="table_empty">
          <thead>
            <tr>
              <th>Device</th>
              <th>Quantity fisik</th>
              <th>Quantity database</th>
              <th>Selisih</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <br>

        <a href="reports/opname_empty.php?" id="btn_print_empty" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-print"></span> Print</a>
        <!-- <button id="btn_print_empty" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Print</button> -->
      </div>
    </div>
  </div>

  <div class="step mb-2" data-step="3" id="step_3">
    <div class="card text-center">
      <button class="btn btn-lg btn-success" id="btn_check_fisik">
        <span class="glyphicon glyphicon-ok"></span> Check fisik selesai
      </button>
    </div>
  </div>

  <div class="step mb-2" data-step="4" id="step_4">
    <div class="card">
      <div class="card-title">
        <h5>Daftar device</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered" id="table_selisih">
          <thead>
            <tr>
              <th>Device</th>
              <th>Quantity fisik</th>
              <th>Quantity database</th>
              <th>Selisih</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <br>
        
        <!-- <div  class="step d-inline-block"> -->
          <button class="btn btn-default step" data-step="5" id="btn_check_selisih"><i class="glyphicon glyphicon-check"></i> Check</button>
        <!-- </div> -->
        <!-- <div  class="step d-inline-block"> -->
          <form action="reports/opname_result.php" class="step" method="post" data-step="6" target="_blank">
            <input type="hidden" name="data" id="input_data_table_selisih">
            <button class="btn btn-default"  id="btn_print_report"><i class="glyphicon glyphicon-print"></i> Print</button>
          </form>
        <!-- </div> -->
      </div>
    </div>
  </div>
  
</div>

<?php
// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_datatables.php");
// get page setting
include("./include/include_modal_device_detail.php");
include("./include/include_modal_device.php");
include("./include/include_modal_device_type.php");

?>
<script src="js/stock_opname_2.js"></script>