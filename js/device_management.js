/**
*	Device Management js
*	
*	@author 	Permana Cakra
* 	@version 	0.2
*/
jQuery(document).ready(function($) {



});

	/**
	*	Show device detail
	*	
	*	@param 		device_id
	*	
	*/
	function show_device_detail (device_id) {
		$("#dl_dev_code").html($("#l_dev_code_"+device_id).val());
		$("#dl_dev_type").html($("#l_dev_type_name_"+device_id).val());
		$("#dl_dev_brand").html($("#l_dev_brand_"+device_id).val());
		$("#dl_dev_minimum_quantity").html($("#l_dev_minimum_quantity_"+device_id).val());
		$("#dl_dev_quantity").html($("#l_dev_quantity_"+device_id).val());
		$("#dl_dev_model").html($("#l_dev_model_"+device_id).val());
		$("#dl_dev_color").html($("#l_dev_color_"+device_id).val());
		$("#dl_dev_serial").html($("#l_dev_serial_"+device_id).val());
		$("#dl_dev_photo_real").prop('href', $("#l_dev_photo_real_"+device_id).val());
		$("#dl_dev_photo_real").prop('title', $("#l_dev_photo_description_"+device_id).val());
		$("#dl_dev_photo").prop('src', $("#l_dev_photo_"+device_id).val());
		$("#dl_dev_description").html($("#l_dev_description_"+device_id).val());
		$("#dl_dev_status").html($("#l_dev_status_"+device_id).val());
		$("#dl_dev_location").html($("#l_dev_location_name_"+device_id).val());
		$("#dl_dev_place").html($("#l_place_name_"+device_id).val());
		$("#dl_dev_building").html($("#l_building_name_"+device_id).val());
		$("#dl_dev_floor").html($("#l_floor_name_"+device_id).val());
		$("#modal_dialog_device_detail").modal("show");
	}
	

	/**
	*	Show  add device type
	*
	*/
	function show_add_device_type () {
		$("#type_name").val("");
		$("#active").val("yes");
		$("#action").val("add_device_type");
		$("#modal_dialog_device_type").modal("show");
	}


	/**
	*	Deactive Device Type
	*
	*	@param 		type_id
	*	@param 		type_name
	*	@param 		status
	*
	*/
	function device_type_change_status (type_id, type_name, status) {
		// If status yes, activate. If status no, deactivate
		if (status=="yes") {
			confirm_info = "<strong>activate</strong>";
		}
		else if (status=="no") {
			confirm_info = "<strong>deactive</strong>";
		}
		// Set modal value and show it!
		$("#modal_form").attr('action', './process.php');
		$("#modal_title").html("Confirmation");
		$("#modal_content").html("<p class='text-center'>Device Type Name : "+type_name+"<br>Sure want to "+confirm_info+" this device type?</p><input type='hidden' name='type_id' value='"+type_id+"'><input type='hidden' name='status' value='"+status+"'><input type='hidden' name='action' value='device_type_change_status'>");
		$("#modal_footer").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button> <button type='submit' class='btn btn-primary'>Yes</button>");
		$("#modal_dialog").modal("show");
	}


	/**
	* 	Show Add device
	*
	*/
	function show_add_device () {
		$("#only_edit").hide();
		$("#only_add").show();
		$("#photo_info").hide();

		$("#dev_id").val("");
		$("#dev_type_id").val("");
		$("#dev_brand").val("");
		$("#dev_model").val("");
		// baru
		$("#dev_quantity").val("");
		// baru
		$("#dev_color").val("");
		$("#dev_serial").val("");
		$("#dev_photo").val("");
		tinyMCE.get('dev_description').setContent("");
		$("#dev_status").val("new");
		$("#location_id").val("");
		$('select').trigger("chosen:updated");
		$("#action").val("add_device");
		$("#modal_title_device").html("Add Device");
		$("#modal_dialog_device").modal("show");
	}


	/**
	*	Show Edit device
	*
	*/
	function show_edit_device (device_id) {
		$("#only_edit").show();
		$("#only_add").hide();
		$("#photo_info").show();

		$("#dev_id").val($("#l_dev_id_"+device_id).val());
		$("#dev_code_view_edit").html($("#l_dev_code_"+device_id).val());
		$("#dev_code_edit").val($("#l_dev_code_"+device_id).val());
		$("#dev_type_id_edit").html($("#l_type_id_"+device_id).val());
		$("#dev_type_id").val($("#l_type_id_"+device_id).val());
		$("#dev_brand").val($("#l_dev_brand_"+device_id).val());
		$("#dev_model").val($("#l_dev_model_"+device_id).val());
		// baru
		$("#dev_minimum_quantity").val($("#l_dev_minimum_quantity_"+device_id).val());
		$("#dev_quantity").val($("#l_dev_quantity_"+device_id).val());
		// baru
		$("#dev_color").val($("#l_dev_color_"+device_id).val());
		$("#dev_serial").val($("#l_dev_serial_"+device_id).val());
		$("#dev_photo").val("");
		// $("#dev_photo_edit").prop('src', $("#l_dev_photo_"+device_id).val());
		tinyMCE.get('dev_description').setContent($("#l_dev_description_"+device_id).val());
		$("#dev_status").val($("#l_dev_status_"+device_id).val());
		$("#location_id").val($("#l_dev_location_id_"+device_id).val());
		$('select').trigger("chosen:updated");
		$("#action").val("edit_device");
		$("#modal_title_device").html("Edit Device");
		$("#modal_dialog_device").modal("show");
	}

	// function show_add_bpp () {

	// 	$("#bpp_id").val("");
	// 	$("#req_quantity").val("");
	// 	$("#req_unit").val("");
	// 	$("#req_code").val("");
	// 	$("#req_description").val("");
	// 	tinyMCE.get('req_description').setContent("");
	// 	$("#o_quantity").val("");
	// 	$("#o_unit").val("");
	// 	$("#o_code").val("");
	// 	$("#o_total").val("");
	// 	$("#action").val("add_bpp");
	// 	$("#modal_title_bpp").html("Request");
	// 	$("#modal_dialog_bpp").modal("show");

	// }