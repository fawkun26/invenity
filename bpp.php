<?php
session_start();
//  edit edit bpp
/**
 *	Required Class
 */
require_once(__DIR__ . '/vendor/autoload.php');

use Carbon\Carbon;

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
require_once(__DIR__ . '/class/user.class.php');
$userclass = new UserClass();
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
    // dump($_SESSION);
    if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") {
    ?>

      <div class='alert alert-info alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button><?= $_SESSION['save_status'] ?>
      </div>

    <?php unset($_SESSION["save_status"]);
    } ?>

    <?php
    if (isset($_SESSION['modal_open']) && isset($_SESSION['modal'])) {
      if ($_SESSION['modal_open'] == 'true' && $_SESSION['modal'] == 'default') { ?>
        <div id="is_modal_open" data-value="<?= $_SESSION['modal_open'] ?>" hidden></div>
        <div id="which_modal" data-value="<?= $_SESSION['modal'] ?>" hidden></div>
      <?php
      } else { ?>
        <div id="is_modal_open" data-value="<?= $_SESSION['modal_open'] ?>" hidden></div>
        <div id="which_modal" data-value="<?= $_SESSION['modal'] ?>" hidden></div>
    <?php }
    }
    unset($_SESSION['modal_open']);
    unset($_SESSION['modal']);
    ?>

    <div class="panel panel-primary">
      <div class="panel-body">

        <ul class="nav nav-tabs d-flex mb-5" role="tablist">
          <li role="presentation" class="active">
            <a href="#bpp_list" id="bpp_list_tab" role="tab" data-toggle="tab" aria-controls="bpp_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"> </i> BPP</a>

          </li>
          <a href='bpp_history.php' class='d-flex items-center btn btn-primary btn-sm ml-auto'>Bpp History</a>
          <a type="button" href="#form_report" class="btn btn-default btn-sm d-flex items-center" id="btn_report"><i class="glyphicon glyphicon-print" style="margin-right: 4px;"></i> Report Bpp</a>
          <button type="button" class="btn btn-default btn-sm btn-tambah-data" id="btn_add"><i class="glyphicon glyphicon-plus"></i> Add Bpp</button>
          <button type="button" class="btn btn-default btn-sm btn-tambah-data" id="btn_add_januari_mei"><i class="glyphicon glyphicon-plus"></i> Add Bpp Januari-Mei</button>
          </span>
        </ul>
        <!-- table -->
        <table class="table table-striped table-bordered datatables">
          <thead>
            <tr>
              <th>No</th>
              <th>Diminta</th>
              <th>Kode Barang</th>
              <th>Dikeluarkan</th>
              <th>Kode Barang</th>
              <th>Total</th>
              <th>Tanggal</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $bpp_s = $bppClass->get_all_bpp();
            foreach ($bpp_s as $key => $bpp) {
              $code = $bpp["type_name"] . "($bpp[type_code]) ($bpp[device_serial])";
            ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td class="data-edit request_quantity"><?= $bpp["request_quantity"] ?></td>
                <td class="data-edit device_id" data-device-id="<?= $bpp['device_id'] ?>"><?= $code ?></td>
                <td class="data-edit out_quantity"><?= $bpp["out_quantity"] ?></td>
                <td class="data-edit"><?= $code ?></td>
                <td class="data-edit out_total"><?= $bpp["out_total"] ?></td>
                <td class="data-edit"><?= $bpp["created_at"] ?></td>
                <td style="vertical-align: middle; text-align: center;">
                  <?php
                  if ($_SESSION['level'] == 'admin') { ?>
                    <button type='button' class='btn btn-sm btn-info btn-edit glyphicon glyphicon-pencil float-right ml-1' data-toggle='modal' data-target='#modal_bpp_edit' data-bpp-id="<?= $bpp['bpp_id'] ?>" data-bpp-history-nomor="<?= $bpp['bpp_history_nomor'] ?>" title='Edit Bpp' data-bpp-data='<?= json_encode($bpp) ?>'></button>
                    <button class="btn btn-sm btn-danger btn-delete-bpp glyphicon glyphicon-trash float-right ml-1" data-toggle="modal" data-target="#modal_delete" data-bpp-id="<?= $bpp['bpp_id'] ?>" data-device-id="<?= $bpp['device_id'] ?>" data-out-quantity="<?= $bpp['out_quantity'] ?>" data-no="<?= $key + 1 ?>" data-diminta="<?= $bpp['request_quantity'] ?>" data-satuan="<?= $bpp['request_unit'] ?>" data-uraian="<?= $bpp['request_description'] ?>" data-kode-barang='<?= $code ?>' data-tanggal="<?= $bpp['created_at'] ?>"></button>

                  <?php }  ?>


                  <button class="btn btn-sm btn-primary btn-detail-bpp glyphicon glyphicon-eye-open float-right ml-1" data-toggle="modal" data-target="#modal_detail" data-detail-bpp='<?php
                                                                                                                                                                                        $data = $bpp;
                                                                                                                                                                                        $data['no'] = $key + 1;
                                                                                                                                                                                        echo json_encode($data);
                                                                                                                                                                                        ?>'></button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="bpp_list" aria-labelledby="bpp_list_tab">

        <div class="panel panel-default" id="form_report">
          <div class="panel-heading">Setting nama-nama pejabat untuk report BPP</div>
          <div class="panel-body">
            <form action="process/bpp.php" method="post">
              <input type="hidden" name="action" value="setting_report_bpp">
              <div class="row">
                <?php
                if (isset($_SESSION['bpp_report_setting'])) {
                  $setting = $_SESSION['bpp_report_setting'];
                } else {
                  $setting['diminta'] = '';
                  $setting['diterima'] = '';
                  $setting['kasubag_logistik'] = '';
                  $setting['gm_teknik_1'] = '';
                  $setting['gm_teknik_2'] = '';
                  $setting['kabag'] = '';
                }
                ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="diminta" class="text-capitalize">diminta</label>
                    <input id="diminta" name="diminta" type="text" class="form-control" value="<?= $setting['diminta'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="diterima" class="text-capitalize">diterima</label>
                    <input id="diterima" name="diterima" type="text" class="form-control" value="<?= $setting['diterima'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="kasubag_logistik" class="text-capitalize">Kasubag logistik</label>
                    <input id="kasubag_logistik" name="kasubag_logistik" type="text" class="form-control" value="<?= $setting['kasubag_logistik'] ?>">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="diterima">Disetujui GM. Teknik 1</label>
                    <input id="diterima" name="gm_teknik_1" type="text" class="form-control" value="<?= $setting['gm_teknik_1'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="diterima">Disetujui GM. Teknik 2</label>
                    <input id="diterima" name="gm_teknik_2" type="text" class="form-control" value="<?= $setting['gm_teknik_2'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="kabag" class="text-capitalize">Kabag. Teknik perencanaan & logistik</label>
                    <input id="kabag" name="kabag" type="text" class="form-control" value="<?= $setting['kabag'] ?>">
                  </div>
                </div>
                <div class="col-xs-12">
                  <button class="btn btn-primary">Save ke session</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- report berdasarkan tanggal -->
        <div class="panel panel-default">
          <div class="panel-heading"><i class="glyphicon glyphicon-pushpin"></i> Report BPP</div>
          <div class="panel-body">
            <hr>
            <div class="row">

            </div>
            <div class="col-xs-6">
              <p>Berdasarkan tanggal:</p>
              <div class="input-group">
                <!-- get all distinct bulan from bpp -->
                <?php $tanggal_s = $bppClass->get_all_distinct_tanggal(); ?>
                <select id="select_report_bpp_tanggal" class="form-control chosen-select">
                  <option>- Pilih Tanggal -</option>
                  <?php foreach ($tanggal_s as $key => $tanggal) { ?>
                    <option value="<?= $tanggal['created_at'] ?>"><?= $tanggal['created_at'] ?></option>
                  <?php } ?>
                </select>
                <span class="input-group-btn">
                  <a id="btn_show_report_bpp_tanggal" href="#" class="btn btn-primary lpb_per_date" target="_blank">Show</a>
                </span>
              </div>
            </div>
            <div class="col-xs-6">
              <p>Berdasarkan Bulan:</p>
              <div class="input-group">
                <!-- get all distinct tanggal from bpp -->
                <?php
                $bulan_s_mapping = [
                  '01' => 'Januari',
                  '02' => 'Februari',
                  '03' => 'Maret',
                  '04' => 'April',
                  '05' => 'Mei',
                  '06' => 'Juni',
                  '07' => 'Juli',
                  '08' => 'Agustus',
                  '09' => 'September',
                  '10' => 'Oktober',
                  '11' => 'November',
                  '12' => 'Desember',
                ];
                $bulan_s = $bppClass->get_all_distinct_bulan();
                ?>
                <select id="select_report_bpp_bulan" class="form-control chosen-select">
                  <option>- Pilih Bulan -</option>
                  <?php foreach ($bulan_s as $key => $bulan) { ?>
                    <option value="<?= $bulan['created_at'] ?>"><?= $bulan_s_mapping[$bulan['created_at']] ?></option>
                  <?php } ?>
                </select>
                <span class="input-group-btn">
                  <a id="btn_show_report_bpp_bulan" href="#" class="btn btn-primary lpb_per_date" target="_blank">Show</a>
                </span>
              </div>

            </div>

            <div class="col-xs-6">
              <p class="mt-5">Berdasarkan Tahun:</p>
              <div class="input-group">
                <!-- get all distinct tanggal from bpp -->
                <?php
                $tahun_s = $bppClass->get_all_distinct_tahun();
                ?>
                <select id="select_report_bpp_tahun" class="form-control chosen-select">
                  <option>- Pilih Tahun -</option>
                  <?php foreach ($tahun_s as $key => $tahun) { ?>
                    <option value="<?= $tahun['created_at'] ?>"><?= $tahun['created_at'] ?></option>
                  <?php } ?>
                </select>
                <span class="input-group-btn">
                  <a id="btn_show_report_bpp_tahun" href="#" class="btn btn-primary lpb_per_date" target="_blank">Show</a>
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
  include("./include/include_modal_bpp.php");
  include("./include/include_modal_bpp_edit.php");
  include("./include/include_modal_bpp_detail.php");
  include("./include/include_modal_bpp_januari_mei.php");
  include('./include/include_modal_bpp_delete.php');
  include("./include/init_chosen.php");

  ?>

  <script src="js/bpp.js"></script> <!-- ini -->

</body>

</html>