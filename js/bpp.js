/**
 *	LPB js
 *
 *	@author 	Permana Cakra
 * 	@version 	0.2
 */
$(document).ready(function ($) {

	$('#btn-add').click(show_add_bpp);
	
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
	
	function show_edit_bpp(bpp_id) {
		$("#modal_dialog_bpp").modal("show");
		$("#modal_title_bpp").html("Edit Bpp");
	
		$("#formModalLabel").html("Edit Data Bpp");
		$(".modal-footer button[type=submit]").html("Edit Data");
	
		$("#bpp_history_id").val($("#l_bpp_id_" + bpp_id).val());
		$("#bpp_id").val($("#l_bpp_id_" + bpp_id).val());
		$("#req_quantity").val($("#l_req_quantity_" + bpp_id).val());
		$("#req_unit").val($("#l_req_unit_" + bpp_id).val());
		$("#req_code").val($("#l_req_code_" + bpp_id).val());
		$("#req_description").val($("#l_req_description_" + bpp_id).val());
		$("#o_quantity").val($("#l_o_quantity_" + bpp_id).val());
		$("#o_unit").val($("#l_o_unit_" + bpp_id).val());
		$("#o_code").val($("#l_o_code_" + bpp_id).val());
		$("#dev_id").val($("#l_dev_id_" + bpp_id).val());
		$("#o_total").val($("#l_o_total_" + bpp_id).val());
		$("select").trigger("chosen:updated");
		$("#action").val("edit_bpp");
	}
	
	 $("#device_code_request").on("change", function (e) {
		const value = e.target.value;
		$('#device_code_out').val(value);
	});
});

