<?php
session_start();
//  edit edit bpp
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
require_once(__DIR__ . '/class/bpp.class.php');
$bppClass = new BppClass();
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
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <?php
    if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") {
    ?>

      <div class='alert alert-info alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button><?= $_SESSION['save_status'] ?>
      </div>

    <?php $_SESSION["save_status"] = "";
    } ?>


    <div class="panel panel-primary">
      <div class="panel-body">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#bpp_list" id="bpp_list_tab" role="tab" data-toggle="tab" aria-controls="bpp_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"> </i> BPP</a>

          </li>
          <span class="pull-right"><button type="button" class="btn btn-default btn-sm tombolTambahData" id="btn-add"><i class="glyphicon glyphicon-plus"></i> Add Bpp</button>
          </span>
          <a href='bpp_history.php' class='btn btn-primary btn-sm pull-right'>Bpp History</a>
        </ul>
      </div>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="bpp_list" aria-labelledby="bpp_list_tab">

        <!-- disisni -->
        <?php

        $bpp_s = $bppClass->get_all_bpp();
        // $bpp_histories = $bppClass->show_bpp_history(); // <== ada masalah

        // dd($bpp_s);
        ?>
        <table class="table table-striped table-bordered datatables">
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
          <tbody>
            <?php foreach ($bpp_s as $key => $bpp) {
              $code =   $bpp["type_name"] . "($bpp[type_code]) ($bpp[device_serial])";
            ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td class="data-edit request_quantity"><?= $bpp["request_quantity"] ?></td>
                <td class="data-edit request_unit"><?= $bpp["request_unit"] ?></td>
                <td class="data-edit device_id" data-device-id="<?= $bpp['device_id'] ?>"><?= $code ?></td>
                <td class="data-edit request_description"><?= $bpp["request_description"] ?></td>
                <td class="data-edit out_quantity"><?= $bpp["out_quantity"] ?></td>
                <td class="data-edit out_unit"><?= $bpp["out_unit"] ?></td>
                <td class="data-edit"><?= $code ?></td>
                <td class="data-edit out_total"><?= $bpp["out_total"] ?></td>
                <td class="data-edit"><?= $bpp["tanggal"] ?></td>
                <td>
                  <button type='button' class='btn btn-sm btn-info glyphicon glyphicon-pencil float-right ml-1 show_modal_edit' data-toggle='modal' data-target='#formModal' data-bpp-id="<?= $bpp['bpp_id'] ?>" data-bpp-history-nomor="<?= $bpp['bpp_history_nomor'] ?>" title='Edit Bpp'>edit</button>
                  <button class="btn btn-sm btn-danger btn-delete-bpp glyphicon glyphicon-trash float-right ml-1" data-toggle="modal" data-target="#modal_delete" data-bpp-id="<?= $bpp['bpp_id'] ?>" data-device-id="<?= $bpp['device_id'] ?>" data-out-quantity="<?= $bpp['out_quantity'] ?>" data-no="<?= $key + 1 ?>" data-diminta="<?= $bpp['request_quantity'] ?>" data-satuan="<?= $bpp['request_unit'] ?>" data-uraian="<?= $bpp['request_description'] ?>" data-kode-barang='<?= $code ?>' data-tanggal="<?= $bpp['tanggal'] ?>">Delete</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading"><i class="glyphicon glyphicon-pushpin"></i> Report BPP</div>
            <div class="panel-body">
              <!-- <a href="report_lpb.php?by=lpb_report_id&name=lpb_per_date" target="_blank" class="btn btn-large btn-block btn-primary">Print All BPP</a> -->
              <a href="reports/bpp.php" target="_blank" class="btn btn-large btn-block btn-primary">Print All BPP</a>
              <hr>
              <p>Specific Date Type :</p>
              <div class="input-group">
                <!-- get all distinct tanggal from bpp -->
                <?php $tanggal_s = $bppClass->get_all_distinct_tanggal(); ?>
                <select id="select_report_bpp" class="form-control chosen-select">
                  <option>- Select Date Type -</option>
                  <?php foreach ($tanggal_s as $key => $tanggal) { ?>
                    <option value="<?= $tanggal['tanggal'] ?>"><?= $tanggal['tanggal'] ?></option>
                  <?php } ?>
                </select>
                <span class="input-group-btn">
                  <a id="btn_show_report_bpp" href="#" class="btn btn-primary lpb_per_date" target="_blank">Show</a>
                </span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <?php
  // get footer
  include("./include/include_footer.php");
  // get plugins
  include("./include/init_datatables.php");
  include("./include/include_modal_bpp.php"); // ini
  include('./include/include_modal_bpp_delete.php'); // ini

  ?>

  <script src="js/bpp.js"></script> <!-- ini -->
  <!-- ini -->
  <script type="text/javascript">
    $('#select_report_bpp').on('change', function(e) {
      console.log(e.target.value);
      $('#btn_show_report_bpp').attr('href', `reports/bpp.php?tanggal=${e.target.value}`);
    })
  </script>
  <!-- ini -->

</body>

</html>