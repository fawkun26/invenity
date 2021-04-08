/**
 *	LPB js
 *
 *	@author 	Permana Cakra
 * 	@version 	0.2
 */
$(document).ready(function () {
  $("#btn-add").click(show_add_bpp);

  function show_bpp() {
    $("#modal_title_bpp").html("Add BPP");
    $("#type_name").val("");
    $("#brand").val("");
    $("model").val("");
    $("#active").val("yes");
    $("#action").val("add_bpp");
    $("#modal_dialog_bpp").modal("show");
  }

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

  function show_add_bpp_history() {
    $("#modal_dialog_bpp_history").modal("show");
    $("#modal_title_bpp_history").html("Add Bpp");

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

	// populate input_device_code_out ketika <select  id="device_code_request"> onchange
  $("#select_device_code_request").on("change", function (e) {
    const device_full_code = $(this).find(":selected").data("device");
    $("#input_device_code_out").val(device_full_code);
  });

});

// bisa kalo di luar $(document).ready();
function show_edit_bpp(bpp_id, data) {
  $("#modal_dialog_bpp").modal("show");
  $("#modal_title_bpp").html("Edit Bpp");
  
  $('#input_request_quantity').val(data.request_quantity)
  $('#input_request_unit').val(data.request_unit)
  $('#input_request_description').val(data.request_description)
  $('#input_out_quantity').val(data.out_quantity)
  $('#input_out_unit').val(data.out_unit)
  $('#input_out_total').val(data.out_total)
  $("#select_device_code_request").val(data.device_id).trigger('chosen:updated');
  $('#input_device_code_out').val($('#select_device_code_request').find(':selected').data('device'));
  
}

$('.show_modal_edit').click(function(e) {
  $('#input_action').val('edit_bpp');
  $('#btn_submit').text('Update data');
  const bpp_id = e.target.dataset.bppId;
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

