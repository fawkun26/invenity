/**
 * @author Mohamad Ilham Ramadhan 
 * @description This is the script for component device_stock_availability
 */

function show_modal_edit(device_list_id) {
  console.log('ID:', device_list_id);
  $('#modal-edit-stock').modal();
  $('#input_device_list_id').val(device_list_id);
}
