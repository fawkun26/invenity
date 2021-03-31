/**
*	LPB js
*	
*	@author 	Permana Cakra
* 	@version 	0.2
*/
jQuery(document).ready(function($) {



});


	


// $(document).on('change','#o_code', function() {
//   var device_id = $(this).val();
//   if(device_id != "") {
//    $.ajax({
//     url:"processbpp.php",
//     type:'POST',
//     data:{device_id:device_id},
//     success:function(response) {
//      //var resp = $.trim(response);
//      console.log('ok');
//       if(response != '') {
//       $("#o_code").removeAttr('disabled','disabled').html(response);
//       $("#device_serial").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
//      }
//  }
  
//  });
// }
// });

//Change in coutry dropdown list will trigger this function and
 //generate dropdown options for state dropdown
 

/**
	*	Show  LPB
	*
	*/
	function show_lpb () {
		$("#modal_title_lpb").html("Add LPB");
		$("#type_name").val("");
		$("#brand").val("");
		$("model").val("");
		$("#active").val("yes");
		$("#action").val("add_lpb");
		$("#modal_dialog_lpb").modal("show");
	}

	// function show_add_bpp () {
	// 	$('.tombolTambahData');
	// //.on('click', function(){
	// 	$('#formModalLabel').html('Tambah Data Bpp');
	// 	$('.modal-footer button[type=submit]').html('Tambah Data');
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
	// 	$(".modal-body form").attr("action", "http://localhost/invenity/process.php?aksi=add_bpp");
	// }

	

  //$(function(){
 	function show_add_lpb () {
	//$('#buttonjavascript').click(function() {
      $('#modal_dialog_lpb').modal("show");
      $("#modal_title_lpb").html("Add Lpb");

	//$('.tombolTambahData').on('click', function(){
		$('#formModalLabel').html('Form Lpb');
		$('.modal-footer button[type=submit]').html('Tambah Data');
		$('#lp_quantity').val('');
        $('#lp_unit').val('');
        $('#lp_code').val('');
        $('#lp_description').val('');
        $('#lp_condition').val('');
        $('#lpb_id').val('');
        $("#action").val("add_lpb");
        //$("#modal_title_bpp").html("Add Bpp");

	// });

}

	// function show_add_bppz () {
	
	
	// 	//$('#formModalLabel').html('Form Bpp');
	// 	//$('.modal-footer button[type=submit]').html('Tambah Data');
	// 	$("#bpp_id").val("");
	// 	$("#bpp_report_id".val("");
	// 	$("#req_quantity").val("");
 //        $("#req_unit").val("");
 //        $("#req_code").val("");
 //        $("#req_description").val("");
 //        $("#o_quantity").val("");
 //        $("#o_unit").val("");
 //        $("#o_code").val("");
 //        $("#device_id").val("")''
 //        $("#o_total").val("");
 //        $("tanggal").val("Y-m-d");
 //        $('select').trigger("chosen:updated");
 //        $("#action").val("add_bpp");
	// 	$("#modal_title_bpp").html("Add Bpp");
	// 	$("#modal_dialog_bpp").modal("show");

	// 	// $("#action").val("add_device_type");
	// 	// $("#modal_dialog_device_type").modal("show");
	// }






	function show_edit_lpb (lpb_id) {

		$('#modal_dialog_lpb').modal("show");
		$("#modal_title_lpb").html("Edit Lpb");

		//$('.tampilModalEdit').on('click', function(){

		  $('#formModalLabel').html('Edit Data Lpb');
		  $('.modal-footer button[type=submit]').html('Edit Data');
		
		// $('#only_edit').show();
		// $('#only_add').hide();
		// $("#photo_info").show();

		$('#lpb_id').val($('#l_lpb_id_'+lpb_id).val());
		//$('#bpp_id').val($("#l_bpp_id_"+bpp_id));
		$('#lp_quantity').val($('#l_lp_quantity_'+lpb_id).val());
        $('#lp_unit').val($('#l_lp_unit_'+lpb_id).val());
        $('#lp_code').val($('#l_lp_code_'+lpb_id).val());
        $('#lp_description').val($('#l_lp_description_'+lpb_id).val());
        $('#lp_condition').val($('#l_lp_condition_'+lpb_id).val());

        $('#dev_id').val($('#l_dev_id_'+lpb_id).val());
;
        

        $('select').trigger("chosen:updated");
        $("#action").val("edit_lpb");
		//$("#action").val("edit_bpp");
		 //$('.modal-body form').attr('action', 'http://localhost/invenity/process.php?aksi=edit_bpp');
		
		// $("#modal_title_device").html("Edit Device");
		// $("#modal_dialog_device").modal("show");
	//});
	}

	// function show_delete_bpp () {
	// 	//$('#modal_dialog_bpp').modal("show");
	// 	//$('.tampilModalDelete').on('click', function(){
	// 		$('select').trigger("chosen:updated");
	// 	//$('#bpp_id').val($('#l_bpp_id_'+bpp_id).val());
 //        $('#action').val("delete_bpp");
	// 	//$("#action").val("edit_bpp");
	// 	 //$('.modal-body form').attr('action', 'http://localhost/invenity/process.php?aksi=edit_bpp');
		
	// 	// $("#modal_title_device").html("Edit Device");
	// 	// $("#modal_dialog_device").modal("show");
	// //});
	// }


// 	function delete_bpp (bpp_id) {

// 	// $('.tampilModalDelete').on('click', function(){

// 		$('#bpp_id').val($('#l_bpp_id_'+bpp_id).val());

// 		$('select').trigger("chosen:updated");
    
//     $('.modal-body form').attr('action', 'http://localhost/invenity/process.php?aksi=delete_bpp');
// // });
// 		}


 // function deleteme(hapus)
 // {
 // 	//$('#bpp_id').val(bpp_id);
 // if(confirm("Do you want Delete!")){
 // window.location.href='./class/delete.php?bpp_id=' +hapus+'';
 // return true;
 // }
 // } 
 

	// function konfirmasi (bpp_id) {
		

	// 	$('#bpp_id').val($('#l_bpp_id_'+bpp_id).val());
	// 		$("#action").val("delete_bpp");
	// 		$('.modal-body form').attr('action', 'http://localhost/invenity/process.php?aksi=delete_bpp');
 // tanya = confirm("Anda Yakin Akan Menghapus Data ?");
 // if (tanya == true) return true;
 // else return false;
 // }

	
	
//}


	// $('.tampilModalEdit').on('click', function(){

	// 	$('#formModalLabel').html('Edit Data Bpp');
	// 	$('.modal-footer button[type=submit]').html('Edit Data');
	// 	$('.modal-body form').attr('action', 'http://localhost/invenity/process.php?aksi=edit_bpp');

	// 	const bpp_id = $(this).data('bpp_id');
		
	// 	$.ajax({
	// 		url: 'http://localhost/invenity/class/bpp.class/getedit',
	// 		data: {id : id},
	// 		// id kiri = nama data yg dikirimkan, id kanan = isi datanya
	// 		method: 'post',
	// 		dataType: 'json',
	// 		success: function(data) {
	// 			$('#req_quantity').val('data.req_quantity');
	// 	        $('#req_unit').val('data.req_unit');
	// 	        $('#req_code').val('data.req_code');
	// 	        $('#req_description').val('data.req_description');
	// 	        $('#o_quantity').val('data.o_quantity');
	// 	        $('#o_unit').val('data.o_unit');
	// 	        $('#o_code').val('data.o_code');
	// 	        $('#o_total').val('data.o_total');
	// 	        $('#bpp_id').val('data.bpp_id');
	// 		}
	// 	});

	// });

//});
