<?php

use Dotenv\Dotenv;

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
require_once(__DIR__ . '/class/bpp.class.php');
$bppClass = new BppClass();
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

<?php
if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") {
  // show info
  echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
  // clear save_status session value
  $_SESSION["save_status"] = "";
}
?>

<!DOCTYPE html>
<html>

<body>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
    <?php
    if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") { ?>
      <div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><?= $_SESSION['save_status'] ?></div>";
      <?php 
      // clear save_status session value
      $_SESSION["save_status"] = "";
      ?>
    <?php } ?>


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

        <!--  -->
        <?php

        $bpp_s = $bppClass->show_bpp_new();
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
                  <button  type='button' class='glyphicon glyphicon-pencil float-right ml-1 show_modal_edit' data-toggle='modal' data-target='#formModal' data-bpp-id="<?= $bpp['bpp_id'] ?>" title='Edit Bpp'>edit</button>

                  <a href='process.php?aksi=delete_bpp&id=$bpp_data[bpp_id]; ?' class='badge badge-danger' id='device_id' onclick="return confirm('Anda Yakin Menghapus Data Ini ?')">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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
  //include("./include/init_chosen.php");
  include("./include/init_fancybox.php");

  include("./include/include_modal_bpp.php");
  // include("./include/include_modal_bpp_edit.php");

  ?>
  <script src="js/bpp.js"></script>
  <script type="text/javascript">
  $(document).ready(function () {
      function set_url(by, nama, kriteria) {
        if (kriteria != "") {
          $("." + nama).attr('href', 'report_bpp.php?by=' + by + '&name=' + nama + '&criteria=' + kriteria);
          $("." + nama).attr('target', '_blank');
        } else {
          $("." + nama).attr('href', '#');
          $("." + nama).attr('target', '');
        }
      }
    })
  </script>
</body>

</html>