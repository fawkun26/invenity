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
      // show info
      echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
      // clear save_status session value
      $_SESSION["save_status"] = "";
    }
    ?>

    <div class="panel panel-primary">
      <div class="panel-body">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#bpp_list" id="bpp_list_tab" role="tab" data-toggle="tab" aria-controls="bpp_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"> </i> BPP</a>

          </li>

          <a href='bpp.php' class='btn btn-primary btn-sm'>Bpp</a>

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
              <th>Jumlah BPP</th>
              <th>Jumlah Barang yang dikeluarkan</th>
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
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="glyphicon glyphicon-pushpin"></i> Report BPP</div>
          <div class="panel-body">
            <a href="report_bpp.php?by=bpp_report_id&name=bpp_per_date" target="_blank" class="btn btn-large btn-block btn-primary">Print All BPP</a>
            <hr>
            <p>Specific Date Type :</p>
            <div class="input-group">
              <select class="form-control chosen-select" name="report_specific_bpp_type" onchange="set_url('bpp_report_id','bpp_per_date',this.value)">
                <option value="">- Select Date Type -</option>
              </select>
              <span class="input-group-btn">
                <!-- <a href="report_bpp.php?id=" class="btn btn-primary per_date_type" target="">Show</a> -->
                <a href="#" class="btn btn-primary bpp_per_date" target="">Show</a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- col-lg-9 col-md-9 col-sm-12 col-xs-12 -->



  <!-- Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal_detail" style="z-index: 2050;">
    <div class="modal-dialog" role="document" style="width: 1280px; overflow-x: scroll;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">BPP History</h4>
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
              </tr>
            </thead>
            <tbody id="modal_table_body">

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <?php
  // get footer
  include("./include/include_footer.php");
  // get plugins
  include("./include/init_tinymce.php");
  include("./include/init_datatables.php");
  include("./include/init_validetta.php");
  //include("./include/init_chosen.php");
  include("./include/init_fancybox.php");

  echo "<script type='text/javascript' src='./js/bpp.js'></script>";

  ?>

  <script type="text/javascript">
    function set_url(by, nama, kriteria) {
      if (kriteria != "") {
        $("." + nama).attr('href', 'report_bpp.php?by=' + by + '&name=' + nama + '&criteria=' + kriteria);
        $("." + nama).attr('target', '_blank');
      } else {
        $("." + nama).attr('href', '#');
        $("." + nama).attr('target', '');
      }
    }

    // ===
    $('.btn-detail').click(function(e) {
      let table_modal = $('#table_modal').DataTable({
        ajax: {
          url: `process/bpp_history.php?action=get_all_bpp_of_bpp_history&nomor=${e.target.dataset.bppHistoryNomor}`,
          dataSrc: ''
        },
        columns: [{
            data: null
          },
          {
            data: 'request_quantity'
          },
          {data: 'request_unit'},
          {data: function(row, type, set, meta) {
            return `${row.type_name} (${row.type_code}) (${row.device_serial})`;
          }},
          {data: 'request_description'},
          {data: 'out_quantity'},
          {data: 'out_unit'},
          {data: function(row, type, set, meta) {
            return `${row.type_name} (${row.type_code}) (${row.device_serial})`;
          }},
          {data: 'out_total'},
          {data: 'tanggal'},
        ]
      });
      // untuk index column
      table_modal.on('order.dt search.dt', function() {
        table_modal.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();
      // destroy datatable ketika modal di hide
      $('#modal_detail').on('hide.bs.modal', function(e) {
        console.log('destroy datatable');
        table_modal.destroy();
      })
    });
  </script>
</body>

</html>

<?php
include("./include/init_chosen.php");
?>