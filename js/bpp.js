/**
 *	LPB js
 *
 *	@author 	Mohamad Ilham Ramadhan
 * 	@version 	1.0
 */
$(document).ready(function () {
  // otomatis open modal setelah process create bpp history
  const isModalOpen = $("#is_modal_open").data("value");
  const whichModal = $("#which_modal").data("value");
  console.log("isModalOpen: ", isModalOpen);
  console.log("whichModal: ", whichModal);
  if (isModalOpen) {
    if (whichModal == "default") {
      $("#modal_dialog_bpp").modal("show");
    } else {
      $("#modal_dialog_bpp_januari_mei").modal("show");
    }
  }

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

  // * ===  Semua tentang BPP Januari-Mei [START]* ===

  /**
   *
   * @param {number} month = bulan dari 1-12
   * @returns {number} = tanggal terakhir dari sebuah bulan
   */
  function getLastDateOfMonth(month) {
    let dt = new Date();
    let year = dt.getFullYear();
    let daysInMonth = new Date(year, month, 0).getDate();
    return daysInMonth;
  }
  $("#bpp_history_bulan").on("change", function (e) {
    const bulan = e.target.value;
    const lastDate = getLastDateOfMonth(bulan);
    const $bpp_history_tanggal = $("#bpp_history_tanggal");
    let options = '<option value="">- Pilih Tanggal</option>';
    for (let i = 1; i <= lastDate; i++) {
      options += `<option value="${i}">${i}</option>`;
    }
    document.getElementById("bpp_history_tanggal").innerHTML = options;
    $bpp_history_tanggal.trigger("chosen:updated");
  });

  // update input:hidden #bulan_hidden value
  $("#bpp_history_bulan").on("change", function (e) {
    const bulan = $(this).find(":selected").val();
    $("#bulan_hidden").val(bulan);
  });
  // update input:hidden #tanggal_hidden value
  $("#bpp_history_tanggal").on("change", function (e) {
    const bulan = $(this).find(":selected").val();
    $("#tanggal_hidden").val(bulan);
  });
  // submit <form id="form_create_bpp_history_januari_mei">
  $("#error_msg_create_bpp_history").hide();

  $("#btn_create_bpp_history_januari_mei").click(function (e) {
    if ($("#bulan_hidden").val() == "") {
      $("#error_msg_create_bpp_history").show();
      return;
    }
    $("#error_msg_create_bpp_history").hide();
    $("#form_create_bpp_history_januari_mei").submit();
  });
  // showing modal add BPP Januari Mei
  $("#btn_add_januari_mei").click(show_add_bpp_januari_mei);
  function show_add_bpp_januari_mei() {
    $("#modal_dialog_bpp_januari_mei").modal("show");
  }
  // populate quantity
  $("#input_request_quantity_januari_mei").on("input", function (e) {
    const quantity = $(this).val();
    $("#input_out_quantity_januari_mei").val(quantity);
    $("#input_out_total_januari_mei").val(quantity);
  });
  // populate device unit
  $("#input_request_unit_januari_mei").on("input", function (e) {
    const unit = $(this).val();
    $("#input_out_unit_januari_mei").val(unit);
  });
  // populate device code
  $("#select_device_code_request_januari_mei").on("change", function (e) {
    const device_full_code = $(this).find(":selected").data("device");
    $("#input_device_code_out_januari_mei").val(device_full_code);
  });
  // populate out total
  $("#input_out_quantity_januari_mei").on("input", function (e) {
    $("#input_out_total_januari_mei").val(e.target.value);
  });

  // * === Semua tentang BPP Januari-Mei [END] === *

  // populate input_device_code_out ketika <select  id="device_code_request"> onchange
  $("#select_device_code_request").on("change", function (e) {
    const device_full_code = $(this).find(":selected").data("device");
    $("#input_device_code_out").val(device_full_code);
  });
  // populate quantity
  $("#input_request_quantity").on("input", function (e) {
    const quantity = $(this).val();
    $("#input_out_quantity").val(quantity);
    $("#input_out_total").val(quantity);
  });
  // populate device unit
  $("#input_request_unit").on("input", function (e) {
    const unit = $(this).val();
    $("#input_out_unit").val(unit);
  });
  $("#input_out_quantity").on("input", function (e) {
    $("#input_out_total").val(e.target.value);
  });
}); // $(document).ready()

// * edit bpp [start]
$(".btn-edit").click(function (e) {
  const dataBPP = $(this).data("bpp-data");
  const $selectDeviceCodeRequest = $("#select_device_code_request_edit");
  const $inputDeviceCodeOut = $("#input_device_code_out_edit");
  const $inputRequestQuantity = $("#input_request_quantity_edit");
  const $inputOutQuantity = $("#input_out_quantity_edit");
  const $inputOutTotal = $("#input_out_total_edit");
  const $inputRequestUnit = $("#input_request_unit_edit");
  const $inputOutUnit = $("#input_out_unit_edit");
  console.log(dataBPP);
  $("#select_bpp_history_edit")
    .val(dataBPP.bpp_history_nomor)
    .trigger("chosen:updated");
  $("#input_bpp_id_edit").val(dataBPP.bpp_id);
  $("#input_old_out_quantity_edit").val(dataBPP.out_quantity);
  $("#input_old_device_id_edit").val(dataBPP.device_id);
  $inputRequestQuantity.val(dataBPP.request_quantity);
  $inputRequestUnit.val(dataBPP.request_unit);
  $selectDeviceCodeRequest.val(dataBPP.device_id).trigger("chosen:updated");
  $("#input_request_description_edit").val(dataBPP.request_description);
  $inputOutQuantity.val(dataBPP.out_quantity);
  $inputOutUnit.val(dataBPP.out_unit);
  $inputDeviceCodeOut.val(
    $selectDeviceCodeRequest.find(":checked").data("device")
  );
  $inputOutTotal.val(dataBPP.out_total);

  // populate device code
  $selectDeviceCodeRequest.on("change", function (e) {
    const device_full_code = $(this).find(":selected").data("device");
    $inputDeviceCodeOut.val(device_full_code);
  });
  // populate quantity
  $inputRequestQuantity.on("input", function (e) {
    const quantity = $(this).val();
    $inputOutQuantity.val(quantity);
    $inputOutTotal.val(quantity);
  });
  // populate device unit
  $inputRequestUnit.on("input", function (e) {
    const unit = $(this).val();
    $inputOutUnit.val(unit);
  });
  $inputOutQuantity.on("input", function (e) {
    $inputOutTotal.val(e.target.value);
  });
});
// * edit bpp [end]

// === Code untuk modal delete BPP [start]
$('[data-toggle="tooltip"]').tooltip();

$(".btn-delete-bpp").click(function (e) {
  const bpp_id = $(this).data("bpp-id");
  const device_id = $(this).data("device-id");
  const out_quantity = $(this).data("out-quantity");
  const $inputBppIds = $('[data-holder="input_delete_bpp_id"]');
  const $inputDeviceIds = $('[data-holder="input_delete_device_id"]');
  const $inputOutQuantities = $('[data-holder="input_delete_out_quantity"]');
  $inputBppIds.val(bpp_id);
  $inputDeviceIds.val(device_id);
  $inputOutQuantities.val(out_quantity);

  $('[data-holder="span-no"]').text($(this).data("no"));
  $('[data-holder="span-diminta"]').text($(this).data("diminta"));
  $('[data-holder="span-satuan"]').text($(this).data("satuan"));
  $('[data-holder="span-kode-barang"]').text($(this).data("kode-barang"));
  $('[data-holder="span-uraian"]').text($(this).data("uraian"));
  $('[data-holder="span-dikeluarkan"]').text($(this).data("out-quantity"));
  $('[data-holder="span-tanggal"]').text($(this).data("tanggal"));
});
// === Code untuk modal delete BPP [end]

// === Code untuk modal delete BPP
$('.btn-detail-bpp').click(function(e) {
  const data = $(this).data('detail-bpp');
  console.log(data);
  const $modalDetail = $('#modal_detail');
  
  $modalDetail.find('[data-holder="span-no"]').text(data.no);
  $modalDetail.find('[data-holder="span-no-history"]').text(data.bpp_history_nomor);
  $modalDetail.find('[data-holder="span-request-quantity"]').text(data.request_quantity);
  $modalDetail.find('[data-holder="span-request-unit"]').text(data.request_unit);
  $modalDetail.find('[data-holder="span-kode-barang"]').text(`${data.type_name} type_code(${data.type_code}) serial=(${data.device_serial})`);
  $modalDetail.find('[data-holder="span-uraian"]').text(data.request_description);
  $modalDetail.find('[data-holder="span-out-quantity"]').text(data.out_quantity);
  $modalDetail.find('[data-holder="span-tanggal"]').text(data.created_at);
});
// === Code untuk modal delete BPP


// == create new bpp history (modal)
$("#btn_create_bpp_history").click(function (e) {
  // alert('create new bpp history');
  $("#form_create_bpp_history").submit();
});

// == Select report tanggal | bulan untuk isi query parameter
$('#select_report_bpp_tanggal').on('change', function(e) {
  console.log(e.target.value);
  $('#btn_show_report_bpp_tanggal').attr('href', `reports/bpp_history.php?jenis=bpp&tanggal=${e.target.value}`);
}) 
$('#select_report_bpp_bulan').on('change', function(e) {
  console.log(e.target.value);
  $('#btn_show_report_bpp_bulan').attr('href', `reports/bpp_history.php?jenis=bpp&bulan=${e.target.value}`);
}) 
$('#select_report_bpp_tahun').on('change', function(e) {
  console.log(e.target.value);
  $('#btn_show_report_bpp_tahun').attr('href', `reports/bpp_history.php?jenis=bpp&tahun=${e.target.value}`);
}) 
// search_contains