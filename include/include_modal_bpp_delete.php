<div class="modal fade" tabindex="-1" role="dialog" id="modal_delete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete BPP</h4>
      </div>
      <div class="modal-body">
      <ul class="list-group">
        <li class="list-group-item">No: <span data-holder="span-no"></span></li>
        <li class="list-group-item">Diminta: <span data-holder="span-diminta"></span></li>
        <li class="list-group-item">Satuan: <span data-holder="span-satuan"></span></li>
        <li class="list-group-item">Kode barang: <span data-holder="span-kode-barang"></span></li>
        <li class="list-group-item">Uraian: <span data-holder="span-uraian"></span></li>
        <li class="list-group-item">Dikeluarkan: <span data-holder="span-dikeluarkan"></span></li>
        <li class="list-group-item">Tanggal: <span data-holder="span-tanggal"></span></li>
      </ul>
      <div class="d-flex justify-content-center">
        <form action="process/bpp.php" method="post">
          <input type="hidden" name="action" value="delete_bpp">
          <input type="hidden" name="is_rollback" value="true">
          <input type="hidden" name="bpp_id" data-holder="input_delete_bpp_id">
          <input type="hidden" name="device_id" data-holder="input_delete_device_id">
          <input type="hidden" name="out_quantity" data-holder="input_delete_out_quantity">
          <button type="submit" class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="top" title="Mengembalikan device quantity pada database sejumlah   out quantity di BPP yg dihapus" >Rollback device quantity</button>
        </form>

        <form action="process/bpp.php" method="post">
          <input type="hidden" name="action" value="delete_bpp">
          <input type="hidden" name="is_rollback" value="false">
          <input type="hidden" name="bpp_id" data-holder="input_delete_bpp_id">
          <input type="hidden" name="device_id" data-holder="input_delete_device_id">
          <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Tidak mengubah device quantity pada database">Keep device quantity</button>
        </form>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->