<?php
session_start();

/**
 *	Required Class
 * beberapa dibutuhkan oleh inlcude 
 */
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once __DIR__ . '/class/device_stock_availability.class.php';
require_once __DIR__ . '/vendor/autoload.php';

$deviceStockAvailability = new DeviceStockAvailability();
// Get all records
$stocks = $deviceStockAvailability->getStock();

include(__DIR__ . "/include/signin_status.php");
include(__DIR__ . "/include/include_header.php");

// dump($_SESSION);
// die();
?>

<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

  <?php if (isset($_SESSION['save_status']) && $_SESSION['save_status'] != "") : ?>

    <div class="alert alert-<?php echo $_SESSION['save_type']; ?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <?php echo $_SESSION['save_status']; ?>
    </div>
    <?php
    // Hapus message (seperti flash message pada Laravel)
    $_SESSION['save_status'] = '';
    ?>
  <?php endif; ?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i class="glyphicon glyphicon-briefcase"></i> &nbsp;
        Device Stock Availibility
        <span class="pull-right">
        </span>
      </h3>
      <br>
    </div>
    <div class='panel-body'>
      <table id="datatable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Type Name</th>
            <th>Type Code</th>
            <th>Device Code</th>
            <th>Minimum Quantity</th>
            <th>Quantity</th>
            <?php if ($_SESSION['level'] == 'admin') : ?>
              <th>Actions</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stocks as $key => $stock) : ?>
            <tr data-quantity="<?php echo $stock['device_quantity']; ?>" data-minimum-quantity="<?php echo $stock['minimum_quantity']; ?>">
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $stock['type_name'] ?></td>
              <td><?php echo $stock['type_code'] ?></td>
              <td><?php echo $stock['device_code'] ?></td>
              <td class="td-minimum-quantity"><?php echo $stock['minimum_quantity'] ?></td>
              <td class="td-quantity"><?php echo $stock['device_quantity'] ?></td>
              <?php if ($_SESSION['level'] == 'admin') : ?>
                <td>
                  <button type="button" class="btn btn-default" title="Edit Device" onclick="show_modal_edit('<?php echo $stock['device_id']; ?>')"><i class="glyphicon glyphicon-pencil"></i></button>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-stock" data-toggle="modal">
  <form action="process/device_stock_availability.php" method="post" class="form-horizontal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Quantity Minimum</h4>
        </div>
        <div class="modal-body">
          <!--  -->
          <input type="hidden" name="device_list_id" id="input_device_list_id">
          <!--  -->
          <input type="hidden" name="action" value="update_minimum_quantity">
          <div class="form-group">
            <label class="control-label col-sm-3">Quantity Minimum</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="minimum_quantity" min="0" id="minimum_quantity" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </form> <!-- form inside -->
</div><!-- /.modal -->

<?php

// get footer
include("./include/include_footer.php");
// get page setting
echo "<script type='text/javascript' src='./js/device_stock_availability.js'></script>";
include("./include/include_modal_component.php");
?>

<link rel="stylesheet" type="text/css" href="./assets/plugins/datatables/media/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="./assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable({
      createdRow: function(row, data, dataIndex) {
        const quantity = Number(row.dataset.quantity);
        const minimumQuantity = Number(row.dataset.minimumQuantity);
        if (quantity < minimumQuantity) {
          row.classList.add('danger');
          const minimumQuantity = row.querySelectorAll('.td-minimum-quantity')[0];
          const quantity = row.querySelectorAll('.td-quantity')[0];
          const minimumQuantityText =  minimumQuantity.textContent;
          const quantityText = quantity.textContent;
          minimumQuantity.innerHTML  = `<strong>${minimumQuantityText}</strong>`;
          quantity.innerHTML  = `<strong>${quantityText}</strong>`;
        }
      }
    });
  });
</script>