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
    <li ><span>Input devices</span></li>
    <li><span>Print kosong</span></li>
    <li><span>Check fisik</span></li>
    <li class="active"><span>Input quantity</span></li>
    <li><span>Check selisih</span></li>
    <li><span>Print</span></li>
  </ol>

  <div class="step" id="step_1">
  <div class="card mb-2">
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
        <button class="btn btn-primary" id="btn_tambah"><span class="glyphicon glyphicon-plus
"></span> Tambah</button>
      </form>
    </div>
  </div>

  <div class="card mb-2">
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
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      <br>

      <a href="reports/opname_empty.php" class="btn btn-info" target="_blank"><span class="glyphicon glyphicon-print
"></span> Print</a>
    </div>
  </div>
  </div>
  
  <div class="step" id="step_2">
  <div class="card">
  
    <button class="btn btn-lg btn-success">
      <span class="glyphicon glyphicon-ok
"></span> Check fisik selesai
    </button>
  </div>
  </div>

  <div id="container">
    <div class="btn-group" role="group" aria-label="...">
      <button id="btn_content_1" data-target="#content_1" type="button" class="btn btn-default btn-content">Content #1</button>
      <button id="btn_content_2" data-target="#content_2" type="button" class="btn btn-default btn-content">Content #2</button>
      <button id="btn_content_3" data-target="#content_3" type="button" class="btn btn-default btn-content">Content #3</button>
      <button id="btn_content_4" data-target="#content_4" type="button" class="btn btn-default btn-content">Content #4</button>
    </div>

    <div class="card content" id="content_1">
      <div class="card-title">Content #1</div>
      <div class="card-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus labore blanditiis quaerat molestiae tenetur delectus fugit. Quae libero maxime a laboriosam perferendis ea harum dolore deleniti numquam, sit facilis impedit?</div>
    </div>

    <div class="card content" id="content_2">
      <div class="card-title">Content #2</div>
      <div class="card-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus labore blanditiis quaerat molestiae tenetur delectus fugit. Quae libero maxime a laboriosam perferendis ea harum dolore deleniti numquam, sit facilis impedit?</div>
    </div>

    <div class="card content" id="content_3">
      <div class="card-title">Content #3</div>
      <div class="card-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus labore blanditiis quaerat molestiae tenetur delectus fugit. Quae libero maxime a laboriosam perferendis ea harum dolore deleniti numquam, sit facilis impedit?</div>
    </div>

    <div class="card content" id="content_4">
      <div class="card-title">Content #4</div>
      <div class="card-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus labore blanditiis quaerat molestiae tenetur delectus fugit. Quae libero maxime a laboriosam perferendis ea harum dolore deleniti numquam, sit facilis impedit?</div>
    </div>
    
  </div>

</div>

<?php
// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_datatables.php");
// get page setting
echo "<script type='text/javascript' src='./js/device_management.js'></script>";
include("./include/include_modal_device_detail.php");
include("./include/include_modal_device.php");
include("./include/include_modal_device_type.php");
?>

<script>
$('.content').hide();
$('.btn-content').click(function(e) {
  $('.content').hide();
  const targetId = this.dataset.target;
  $(targetId).show();
});

// ==============
  const $breadcrumb = $('#breadcrumb');
  const $lis = $breadcrumb.children();
  const $active = $breadcrumb.children('li.active');
  let activeIndex = $active.index();
  const allActiveLi = $lis.slice(0, activeIndex + 1);
  allActiveLi.map((i, el) => {
    el.classList.add('blue')
  });
  $lis.click(function(e) {
    const targetLi = e.target.closest('li');
    allActiveLi.map((i, el) => {
      el.classList.remove('active', 'blue');
    })
    targetLi.classList.add('active');
  });

  // tambah data ke datatables
  const $tableEmpty = $('#table_empty').DataTable({
    columnDefs: [{
      width: "60%",
      "targets": 0
    }]
  });
  const $selectDevice = $('#select_device');
  $('#btn_tambah').click((e) => {
    e.preventDefault();
    const namaDevice = $('#select_device option:selected').data('nama-device')
    $tableEmpty.row.add(
      [
        namaDevice,
        '-',
        '-',
        '-'
      ],
    ).draw(false);
  })
</script>