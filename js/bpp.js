/**
 *	LPB js
 *
 *	@author 	Mohamad Ilham Ramadhan
 * 	@version 	1.0
 */
$(document).ready(function () {
  // showing modal add BPP
  $("#btn_add").click(show_add_bpp);
  function show_add_bpp() {
    $("#modal_dialog_bpp").modal("show");
    $("#modal_title_bpp").html("Add Bpp");

    $("#formModalLabel").html("Form Bpp");
    $(".modal-footer button[type=submit]").html("Tambah Data");
    $("#req_quantity").val("");
    $("#req_unit").val("");
    $("#req_code").val("");
    $("#req_description").val("");
    $("#o_quantity").val("");
    $("#o_unit").val("");
    $("#o_code").val("");
    $("#o_total").val("");
    $("#bpp_id").val("");
    $("#action").val("add_bpp");
  }

  // * Semua tentang BPP Januari-Mei
  // update input:hidden #bulan_hidden value
  $('#bpp_history_bulan').on('change', function(e) {
    const bulan = $(this).find(':selected').val();
    $('#bulan_hidden').val(bulan);
    console.log('Bulan: ', bulan);
    console.log('#bulan_hidden ', $('#bulan_hidden').val());
  })
  // submit <form id="form_create_bpp_history_januari_mei">
  $('#error_msg_create_bpp_history').hide();

  $('#btn_create_bpp_history_januari_mei').click(function(e) {
    if( $('#bulan_hidden').val() ==  '') {
      $('#error_msg_create_bpp_history').show();
      return;
    }
    $('#error_msg_create_bpp_history').hide();
    $('#form_create_bpp_history_januari_mei').submit();
  });
  // showing modal add BPP Januari Mei 
  $('#btn_add_januari_mei').click(show_add_bpp_januari_mei);
  function show_add_bpp_januari_mei() {
    console.log('anjing!')
    $('#modal_dialog_bpp_januari_mei').modal('show');
  }
  
  // * Semua tentang BPP Januari-Mei

	// populate input_device_code_out ketika <select  id="device_code_request"> onchange
  $("#select_device_code_request").on("change", function (e) {
    const device_full_code = $(this).find(":selected").data("device");
    $("#input_device_code_out").val(device_full_code);
  });

});

// Untuk edit BPP
function show_edit_bpp(bpp_id, data) {
  $("#modal_dialog_bpp").modal("show");
  $("#modal_title_bpp").html("Edit Bpp");
  
  $('#input_request_quantity').val(data.request_quantity)
  $('#input_request_unit').val(data.request_unit)
  $('#input_request_description').val(data.request_description)
  $('#input_out_quantity').val(data.out_quantity)
  $('#input_out_unit').val(data.out_unit)
  $('#input_out_total').val(data.out_total)
  $("#select_bpp_history").val(data.bpp_history_nomor).trigger('chosen:updated');
  $("#select_device_code_request").val(data.device_id).trigger('chosen:updated');
  $('#input_device_code_out').val($('#select_device_code_request').find(':selected').data('device'));
  
}

$('.show_modal_edit').click(function(e) {
  $('#input_action').val('edit_bpp');
  $('#btn_submit').text('Update data');
  const bpp_id = e.target.dataset.bppId;
  const bpp_history_nomor = e.target.dataset.bppHistoryNomor;
  const $tr = $(this).closest('tr');
  const request_quantity = $tr.find('.request_quantity').text();
  const request_unit = $tr.find('.request_unit').text();
  const request_description = $tr.find('.request_description').text();
  const out_quantity = $tr.find('.out_quantity').text();
  const out_unit = $tr.find('.out_unit').text();
  const out_total = $tr.find('.out_total').text();
  const device_id = $tr.find('.device_id').data('device-id');
  console.log('device id: ', device_id);
  const data = {
    device_id,
    bpp_history_nomor,
    request_quantity,
    request_unit,
    request_description,
    out_quantity,
    out_unit,
    out_total
  }
  $('#input_bpp_id').val(bpp_id);
  $('#input_old_out_quantity').val(out_quantity);
  $('#input_old_device_id').val(device_id);
  show_edit_bpp(bpp_id, data);
});

// === Code untuk modal delete BPP 
$('[data-toggle="tooltip"]').tooltip()

$('.btn-delete-bpp').click(function(e) {
  const bpp_id = $(this).data('bpp-id');
  const device_id = $(this).data('device-id');
  const out_quantity = $(this).data('out-quantity');
  const $inputBppIds = $('[data-holder="input_delete_bpp_id"]');
  const $inputDeviceIds = $('[data-holder="input_delete_device_id"]');
  const $inputOutQuantities = $('[data-holder="input_delete_out_quantity"]');
  $inputBppIds.val(bpp_id);
  $inputDeviceIds.val(device_id);
  $inputOutQuantities.val(out_quantity);

  $('[data-holder="span-no"]').text($(this).data('no'));
  $('[data-holder="span-diminta"]').text($(this).data('diminta'));
  $('[data-holder="span-satuan"]').text($(this).data('satuan'));
  $('[data-holder="span-kode-barang"]').text($(this).data('kode-barang'));
  $('[data-holder="span-uraian"]').text($(this).data('uraian'));
  $('[data-holder="span-dikeluarkan"]').text($(this).data('out-quantity'));
  $('[data-holder="span-tanggal"]').text($(this).data('tanggal'));
})

// == create new bpp history (modal)
$('#btn_create_bpp_history').click(function(e) {
  // alert('create new bpp history');
  $('#form_create_bpp_history').submit();
})

