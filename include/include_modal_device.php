<?php
// If form error, show error
if (isset($_SESSION["new_dev_serial"])) {
    echo "<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('#modal_dialog_device').modal('show');
            });
        </script>";
    $device_serial_info = "<span class='text-danger' id='device_serial_info'>Device with serial number : '$_SESSION[new_dev_serial]' is already exists!</span>";
}
?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_device">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" name="form_device" id="form_device" method="post" enctype="multipart/form-data" action="process.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal_title_device">Add Device</h4>
                </div>
                <div class="modal-body" id="modal_content_device">
                    <!-- <div class="form-group">
                        <label class="control-label col-sm-3">Device Code</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="dev_code" id="dev_code" <?php if (isset($_SESSION["new_dev_code"])) {
                                                                                                        echo " value='" . $_SESSION["new_dev_code"] . "'";
                                                                                                        unset($_SESSION['new_dev_code']);
                                                                                                    } ?>>
                        </div>
                    </div> -->
                    <div id="only_edit">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Device Code</label>
                            <div class="col-sm-6">
                                <p class="form-control-static" id="dev_code_view_edit"></p>
                                <input type="hidden" name="dev_code_edit" id="dev_code_edit" value="">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-3">Device Type</label>
                            <div class="col-sm-6">
                                <p class="form-control-static" id="dev_type_id_edit"></p>
                            </div>
                        </div> -->
                    </div>

                    <div id="only_add">
                        <div class="form-group">
                            < <label class="control-label col-sm-3">Device Code</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static" id="dev_code_view"><?php
                                                                                        $generated_code = $devClass->generate_device_code();
                                                                                        if (strpos($generated_code, "devtype") !== FALSE) {
                                                                                            $generated_code = str_replace("devtype", "<span id='dynamic_devtype'>devtype</span>", $generated_code);
                                                                                        }
                                                                                        echo $generated_code;
                                                                                        ?></p>
                                    <input type="hidden" name="dev_code" id="dev_code" value="<?php echo $devClass->generate_device_code(); ?>">
                                    <p class="help-block">If you assign 'devtype' in device code format, the code will change based on your device type.</p>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Device Type</label>
                            <div class="col-sm-6">
                                <select class="form-control chosen-select" name="dev_type_id" id="dev_type_id" data-placeholder="Device Type">
                                    <option value=""></option>
                                    <?php
                                    $type_select = "";
                                    $dev_type_select = $devClass->show_device_type();
                                    if (count($dev_type_select) > 0) {
                                        foreach ($dev_type_select as $dts) {
                                            // set variable
                                            $dev_type_id   = $dts["type_id"];
                                            $dev_type_name = ucwords(stripslashes($dts["type_name"]));

                                            // if isset new dev type - set selected
                                            if (isset($_SESSION['new_type_id'])) {
                                                if ($_SESSION['new_type_id'] == $dev_type_id) {
                                                    $type_select  .= "<option value='$dev_type_id' type_code='$dts[type_code]' selected>$dev_type_name</option>";
                                                } else {
                                                    $type_select  .= "<option value='$dev_type_id' type_code='$dts[type_code]'>$dev_type_name</option>";
                                                }
                                                unset($_SESSION['new_type_id']);
                                            }
                                            // else
                                            else {
                                                $type_select  .= "<option value='$dev_type_id' type_code='$dts[type_code]'>$dev_type_name</option>";
                                            }
                                        }
                                    }
                                    echo $type_select;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Brand</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" name="dev_brand" id="dev_brand" <?php if (isset($_SESSION["new_dev_brand"])) {
                                                                                                            echo " value='" . $_SESSION["new_dev_brand"] . "'";
                                                                                                            unset($_SESSION['new_dev_brand']);
                                                                                                        } ?> required>
                                <div class="input-group-addon">*</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Model</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="dev_model" id="dev_model" <?php if (isset($_SESSION["new_dev_model"])) {
                                                                                                        echo " value='" . $_SESSION["new_dev_model"] . "'";
                                                                                                        unset($_SESSION['new_dev_model']);
                                                                                                    } ?>>
                        </div>
                    </div>
                    <!-- // baru -->
                    <div class="form-group">
                        <label class="control-label col-sm-3">Quantity</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="dev_quantity" id="dev_quantity" <?php if (isset($_SESSION["new_dev_quantity"])) {
                                                                                                                echo " value='" . $_SESSION["new_dev_quantity"] . "'";
                                                                                                                unset($_SESSION['new_dev_quantity']);
                                                                                                            } ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Minimum Quantity</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" name="dev_minimum_quantity" id="dev_minimum_quantity" <?php if (isset($_SESSION["new_minimum_quantity"])) {
                                                                                                                        echo " value='" . $_SESSION["new_minimum_quantity"] . "'";
                                                                                                                        unset($_SESSION['new_minimum_quantity']);
                                                                                                                    } ?> min="0">
                        </div>
                    </div>
                    <!-- baru // -->
                    <div class="form-group">
                        <label class="control-label col-sm-3">Color</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="dev_color" id="dev_color" <?php if (isset($_SESSION["new_dev_color"])) {
                                                                                                        echo " value='" . $_SESSION["new_dev_color"] . "'";
                                                                                                        unset($_SESSION['new_dev_color']);
                                                                                                    } ?>>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Serial Number</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" name="dev_serial" id="dev_serial" <?php if (isset($_SESSION["new_dev_serial"])) {
                                                                                                                echo " value='" . $_SESSION["new_dev_serial"] . "'";
                                                                                                                unset($_SESSION['new_dev_serial']);
                                                                                                            } ?> required>
                                <div class="input-group-addon">*</div>
                            </div>
                            <?php if (isset($device_serial_info)) {
                                echo $device_serial_info;
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Photo</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" name="dev_photo" id="dev_photo">
                            <p class="help-block" id="photo_info">Leave empty if you don't want to change the photo.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control tinymce" name="dev_description" id="dev_description"> <?php if (isset($_SESSION["new_dev_description"])) {
                                                                                                                    echo $_SESSION["new_dev_description"];
                                                                                                                    unset($_SESSION['new_dev_description']);
                                                                                                                } ?></textarea>
                        </div>
                    </div>

                    <hr class="dashed">

                    <div class="form-group">
                        <label class="control-label col-sm-3">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="dev_status" id="dev_status" data-placeholder="Status">
                                <option value=""></option>
                                <option value="new" <?php if (isset($_SESSION['new_dev_status']) && $_SESSION['new_dev_status'] == "new") {
                                                        echo "selected";
                                                    } ?>>New</option>
                                <option value="in use" <?php if (isset($_SESSION['new_dev_status']) && $_SESSION['new_dev_status'] == "in use") {
                                                            echo "selected";
                                                        } ?>>In Use</option>
                                <option value="damaged" <?php if (isset($_SESSION['new_dev_status']) && $_SESSION['new_dev_status'] == "damaged") {
                                                            echo "selected";
                                                        } ?>>Damaged</option>
                                <option value="repaired" <?php if (isset($_SESSION['new_dev_status']) && $_SESSION['new_dev_status'] == "repaired") {
                                                                echo "selected";
                                                            } ?>>Repaired</option>
                                <option value="discarded" <?php if (isset($_SESSION['new_dev_status']) && $_SESSION['new_dev_status'] == "discarded") {
                                                                echo "selected";
                                                            } ?>>Discarded</option>
                            </select>
                            <?php unset($_SESSION['new_dev_status']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Location</label>
                        <div class="col-sm-6">
                            <select class="form-control chosen-select" name="location_id" id="location_id" data-placeholder="Location">
                                <option value="0"></option>
                                <?php
                                $location_select = "";
                                $location_select = $locClass->show_location();
                                if (count($location_select) > 0) {
                                    foreach ($location_select as $ls) {
                                        $location_id     = $ls["location_id"];
                                        $location_name   = stripslashes($ls["location_name"]);

                                        // if isset new location - set selected
                                        if (isset($_SESSION['new_location_id'])) {
                                            if ($_SESSION['new_location_id'] == $location_id) {
                                                $location_select .= "<option value='$location_id' selected>$location_name</option>";
                                            } else {
                                                $location_select .= "<option value='$location_id'>$location_name</option>";
                                            }
                                            unset($_SESSION['new_location_id']);
                                        } else {
                                            $location_select .= "<option value='$location_id'>$location_name</option>";
                                        }
                                    }
                                }
                                echo $location_select;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="modal_footer_device">
                    <p class="pull-left">* Required fields</p>
                    <input type="hidden" name="dev_id" id="dev_id" value="">
                    <input type="hidden" name="action" id="action" value="add_device">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#dev_type_id").on('change', function(event) {
            var devtype = $(this).find('option:selected').attr('type_code');
            $("#dynamic_devtype").html(devtype);

            // trim the span, set the value
            var dev_code = $("#dev_code_view").html().replace('<span id="dynamic_devtype">', '');
            var dev_code = dev_code.replace("</span>", "");
            $("#dev_code").val(dev_code);
        });
    });
</script>
<?php
include("./include/init_chosen.php");
?>