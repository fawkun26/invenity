function set_url(by, nama, kriteria) {
  if (kriteria != "") {
    $("." + nama).attr('href', 'report_bpp.php?by=' + by + '&name=' + nama + '&criteria=' + kriteria);
    $("." + nama).attr('target', '_blank');
  } else {
    $("." + nama).attr('href', '#');
    $("." + nama).attr('target', '');
  }
}
const $inputBppHistoryEdit = $('#input_bpp_history_nomor_edit');
const $inputBppIdEdit = $('#input_bpp_id_edit');
const $selectRequestCodeEdit = $('#select_device_code_request_edit');
const $inputRequestDescription = $('#input_request_description_edit');
const $inputDeviceCodeOutEdit = $("#input_device_code_out_edit");
const $inputRequestQuantityEdit = $("#input_request_quantity_edit");
const $inputOutQuantityEdit = $("#input_out_quantity_edit");
const $inputOutTotalEdit = $("#input_out_total_edit");
const $inputRequestUnitEdit = $("#input_request_unit_edit");
const $inputOutUnitEdit = $("#input_out_unit_edit");
const $isEditableBppHistory = $('#is_editable_bpp_history');
const $isAdminBppHistory = $('#is_admin_bpp_history');
const $btnTambahBPP = $('#btn_tambah_bpp')

let table_modal = $('#table_modal').DataTable({
  drawCallback: function(settings) {
    $('.btn-delete-bpp').click(function(e) {
      $('#input_delete_bpp_id').val($(this).data('bpp-id'));
      $('#input_delete_out_quantity').val($(this).data('out-quantity'));
      $('#input_delete_device_id').val($(this).data('device-id'));
    });
    // populate semua input modal bpp edit ketika .btn-edit-bpp di click
    $('.btn-edit-bpp').click(function(e) {
      const dataBPP = $(this).data('bpp-json');
      const bppHistoryNomor = $(this).data('bpp-history-nomor');
      console.log(dataBPP);
      console.log(bppHistoryNomor);
      $inputBppHistoryEdit.val(bppHistoryNomor);
      $inputBppIdEdit.val(dataBPP.bpp_id);
      $inputRequestQuantityEdit.val(dataBPP.request_quantity);
      $inputRequestUnitEdit.val(dataBPP.request_unit);
      $selectRequestCodeEdit.val(dataBPP.device_id).trigger('chosen:updated');
      $inputRequestDescription.val(dataBPP.request_description);
      $inputOutQuantityEdit.val(dataBPP.out_quantity);
      $inputOutUnitEdit.val(dataBPP.out_unit);
      $inputOutTotalEdit.val(dataBPP.out_total);
      $inputDeviceCodeOutEdit.val($selectRequestCodeEdit.find(":selected").data("device"));
      $('#old_out_quantity_edit').val(dataBPP.out_quantity);
      $('#old_device_id_edit').val(dataBPP.device_id);
      $('#select_bpp_history_edit').val(bppHistoryNomor).trigger('chosen:updated');
    });
    // fitur spare 7 hari BPP&BPP History : hide btn edit dan delete jika lewat 7 hari
    if ($isEditableBppHistory.data('is-editable')) {
      $('.btn-delete-bpp').show();
      $('.btn-edit-bpp').show();
    } else {
      $('.btn-delete-bpp').hide();
      $('.btn-edit-bpp').hide();
    }
  },
  columns: [{
      data: null
    },
    {
      data: 'request_quantity'
    },
    {
      data: 'request_unit'
    },
    {
      data: function(row, type, set, meta) {
        return `${row.type_name} (${row.type_code}) (${row.device_serial})`;
      }
    },
    {
      data: 'request_description'
    },
    {
      data: 'out_quantity'
    },
    {
      data: 'out_unit'
    },
    {
      data: function(row, type, set, meta) {
        return `${row.type_name} (${row.type_code}) (${row.device_serial})`;
      }
    },
    {
      data: 'out_total'
    },
    {
      data: 'tanggal'
    },
    {
      data: 'action'
    }
  ]
});
table_modal.on('order.dt search.dt', function() {
  table_modal.column(0, {
    search: 'applied',
    order: 'applied'
  }).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
  });
}).draw();

// custom event pada modal detail untuk Ajax datatable
async function ajaxBppHistoryDetail(bppHistoryNomor) {
  table_modal.clear();
  let data = await fetch(`process/bpp_history.php?action=get_all_bpp_of_bpp_history&nomor=${bppHistoryNomor}`).then(response => response.json());
  // console.log(JSON.stringify(data[0]));
  data = data.map(bpp => {
    return {
      ...bpp,
      action: `
        <button class="btn btn-sm btn-danger btn-delete-bpp" data-bpp-id="${bpp.bpp_id}" data-out-quantity="${bpp.out_quantity}" data-device-id="${bpp.device_id}" data-target="#modal_delete_bpp" data-toggle="modal">Delete</button>
        <button class="btn btn-sm btn-info btn-edit-bpp" data-bpp-history-nomor="${bppHistoryNomor}" data-bpp-json='${JSON.stringify(bpp)}' data-target="#modal_edit_bpp" data-toggle="modal">Edit</button>
      `,
    };
  })
  table_modal.rows.add(data).draw();
  // isi <input> bpp history di modal delete bpp untuk buka modal setelah redirect
}
// custom event untuk membuka modal dan render datatable[Ajax] setelah delete BPP
$('#modal_detail').on('bpp_history_detail', function(e, bppHistoryNomor) {
  if (bppHistoryNomor) {
    $('#modal_detail').modal('show');
    ajaxBppHistoryDetail(bppHistoryNomor);
    $('#input_delete_bpp_history_nomor_bpp').val(bppHistoryNomor);
    $('#input_bpp_history_nomor').val(bppHistoryNomor);
    $('.label-bpp-history-nomor').text(bppHistoryNomor);
  }
});
// trigger event 'bpp_history_detail' ketika div:hidden bpp_history_nomor_hidden ada [session]
const bppHistoryNomorHidden = $('#bpp_history_nomor_hidden').data('value');
if (bppHistoryNomorHidden) {
  $('#modal_detail').trigger('bpp_history_detail', [bppHistoryNomorHidden]);
}
$('.btn-detail').click(function(e) {
  const bppHistoryNomor = $(this).data('bpp-history-nomor');
  const createdAt = new Date($(this).data('tanggal'));
  const now = new Date();
  const diffInDays = (now.getTime() - createdAt.getTime()) / (1000 * 3600 * 24); 
  ajaxBppHistoryDetail(bppHistoryNomor);
  $('.label-bpp-history-nomor').text(bppHistoryNomor);
  $('#input_bpp_history_nomor').val(bppHistoryNomor);
  // check apakah user level == 'admin' 
  if ($isAdminBppHistory.data('is-admin')) {
    $btnTambahBPP.sho();
    $isEditableBppHistory.data('is-editable', true);
  } else {
    // fitur spare 7 hari input BPP di BPP_history
    $isEditableBppHistory.data('is-editable', false);
    if ( diffInDays.toFixed() > 7) {
      $btnTambahBPP.hide();
      // $isEditableBppHistory.data('is-editable', false);
    } else {
      // $isEditableBppHistory.data('is-editable', true);
      $btnTambahBPP.show();
    }
  }
});

$('.btn-delete').click(function(e) {
  const bpp_history_nomor = $(this).data('bpp-history-nomor');
  $('#input_delete_bpp_history_nomor').val(bpp_history_nomor);
});


// * modal tambah bpp [START]
$("#select_device_code_request").on("change", function(e) {
  const device_full_code = $(this).find(":selected").data("device");
  $("#input_device_code_out").val(device_full_code);
});
// populate quantity
$("#input_request_quantity").on("input", function(e) {
  const quantity = $(this).val();
  $("#input_out_quantity").val(quantity);
  $("#input_out_total").val(quantity);
});
// populate device unit
$("#input_request_unit").on("input", function(e) {
  const unit = $(this).val();
  $("#input_out_unit").val(unit);
});
$("#input_out_quantity").on("input", function(e) {
  $("#input_out_total").val(e.target.value);
});
// * modal tambah bpp [END]

// * modal edit bpp [START]
// populate out request code
$selectRequestCodeEdit.on("change", function(e) {
  const device_full_code = $(this).find(":selected").data("device");
  $inputDeviceCodeOutEdit.val(device_full_code);
});
// populate out quantity
$inputRequestQuantityEdit.on("input", function(e) {
  const quantity = $(this).val();
  $inputOutQuantityEdit.val(quantity);
  $inputOutTotalEdit.val(quantity);
});
// populate out device unit
$inputRequestUnitEdit.on("input", function(e) {
  const unit = $(this).val();
  $inputOutUnitEdit.val(unit);
});
$inputOutQuantityEdit.on("input", function(e) {
  $inputOutTotalEdit.val(e.target.value);
});
// * modal edit bpp [END]