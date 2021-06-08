<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_device_detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modal_title_device_detail">Device Detail</h4>
            </div>
            <div class="modal-body form-horizontal" id="modal_content_device_detail">
                <div class="form-group">
                    <label class="control-label col-sm-3">Device Code :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_code"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Device Type :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_type"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Brand :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_brand"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Model :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_model"> </div>
                </div>
                <!-- baru -->
                <div class="form-group">
                    <label class="control-label col-sm-3">Minimum Quantity :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_minimum_quantity"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Quantity :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_quantity"> </div>
                </div>
                <!-- baru -->
                <div class="form-group">
                    <label class="control-label col-sm-3">Color :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_color"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Serial Number :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_serial"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Photo :</label>
                    <div class="col-sm-8 form-control-static">
                        <a class="fancybox" rel="group" href="#" id="dl_dev_photo_real">
                            <img src="" class="img-thumbnail" alt="Device Image" id="dl_dev_photo" style="max-height:180px">
                        </a>
                        <p class="help-block">Click the image to enlarge.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Description :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_description"> </div>
                </div>
                <hr class="dashed">
                <div class="form-group">
                    <label class="control-label col-sm-3">Status :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_status"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Location :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_location"> </div>
                </div>
                <?php if ($setting_location_details=="enable"): ?>
                <div class="form-group">
                    <label class="control-label col-sm-3">Place :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_place"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Building :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_building"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Floor :</label>
                    <div class="col-sm-8 form-control-static" id="dl_dev_floor"> </div>
                </div>
                <?php endif ?>
            </div>
            <div class="modal-footer" id="modal_footer_device_detail">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->