<?php
session_start();

/**
*	Required Class
*/
require_once(__DIR__ . '/lib/db.class.php');
$db        = new DB();
require_once(__DIR__ . '/class/inventory.class.php');
$invClass  = new Inventory();
require_once(__DIR__ . '/class/location.class.php');
$locClass = new LocationClass();
require_once(__DIR__ . '/class/Bpp_model.php');
$bppModel = new Bpp_model();
require_once(__DIR__ . '/class/device.class.php');
$devClass = new DeviceClass();
require_once(__DIR__ . '/class/bpp.class.php');
$bppClass = new BppClass();
require_once(__DIR__ . '/class/delete.php');
$delClass = new DelClass();
// require_once(__DIR__ . '/class/device.class.php');
// $devClass = new DeviceClass();

// Location details settings 
$setting_location_details = $invClass->setting_data("location_details");

// Check if user already logged in
include("./include/signin_status.php");

// get header
include("./include/include_header.php");

?>

	<?php 
	if (isset($_SESSION['save_status']) && $_SESSION['save_status']!=""){
		// show info
		echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
		// clear save_status session value
		$_SESSION["save_status"] = "";
	}
  // if (isset($_SESSION["new_add_bpp"])) { 
  //       echo "<script type='text/javascript'>
  //           jQuery(document).ready(function($) {
  //               $('#modal_dialog_bpp').modal('show');
  //           });
  //       </script>";
  //       $lpb_info = "<span class='text-danger' id='bpp_info'>BPP '$_SESSION[new_add_bpp]' is already exists!</span>";
  //   }
  
	?>
  <!-- <script type='text/javascript' src='./js/bpp.js'></script> -->
  <!-- bootstrap css -->

 
  <!DOCTYPE html>
  <html>
  
  <body>
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_bpp"> -->
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
  <!-- <div class="row mb-3">
		  <div class="col-lg-6">
				
		</div>
	</div> -->
  <?php 
  if (isset($_SESSION['save_status']) && $_SESSION['save_status']!=""){
    // show info
    echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>$_SESSION[save_status]</div>";
    // clear save_status session value
    $_SESSION["save_status"] = "";
  }
  ?>
  	<!-- Modal -->

  
   
	
<div class="panel panel-primary">
	 <div class="panel-body">
    
          			<ul class="nav nav-tabs" role="tablist">
          				<li role="presentation" class="active">
          					<a href="#bpp_list" id="bpp_list_tab" role="tab" data-toggle="tab" aria-controls="bpp_list" aria-expanded="true"><i class="glyphicon glyphicon-hdd"> </i> BPP</a>

				          </li>
    
                <!-- <span class="pull-right"><button type="button" class="btn btn-default btn-sm" onclick="show_add_bpp()"><i class="glyphicon glyphicon-plus"></i> Add BPP</button>
                </span>  -->
                
                <a href='bpp.php' class='btn btn-primary btn-sm'>Bpp</a>
                <!-- data-toggle="modal" data-target="#formModal" -->
                
				<!-- <li role="presentation">
					<a href="#dev_type_list" id="dev_type_list_tab" role="tab" data-toggle="tab" aria-controls="dev_type_list" aria-expanded="true"><i class="glyphicon glyphicon-pushpin"></i> Device Type List</a>
				</li> -->
			         </ul>
               </div>
  </div>
			<div class="tab-content">
				  <div role="tabpanel" class="tab-pane fade active in" id="bpp_list" aria-labelledby="bpp_list_tab">

            <?php

            $bpp = $bppClass->show_bpp_history();
            if (count($bpp)>0) {
              $no      = 0;
              $content = "<table class='table table-striped table-bordered datatables'>
              <thead>
								<tr>
                
									<th>No</th>
									<th>Diminta</th>		
                  <th>Satuan</th>
                  <th>Kode Barang</th>     
                  <th>Uraian</th>    							
									<th>Dikeluarkan</th>
                  <th>Satuan</th> 
                  <th>Kode Barang</th>
									<th>Total</th>
                  <th>Tanggal</th>
                  <th>Action</th>
																									
									
								</tr>
							</thead>
							<tbody>";
              

              foreach ($bpp as $bpp_data) {
                $no++;
                $bpp_id      = $bpp_data["bpp_id"];
                $request_quantity   = $bpp_data["request_quantity"];
                $request_unit   = $bpp_data["request_unit"];
                $request_code   = $bpp_data["request_code"];
                $request_description   = $bpp_data["request_description"];
                $out_quantity    = $bpp_data["out_quantity"];
                $out_unit    = $bpp_data["out_unit"];
                $out_code    = $bpp_data["out_code"];
                $out_total = $bpp_data["out_total"];
                $tanggal = $bpp_data["tanggal"];
                
              $content .= "<tr>
                  <td>$no</td>
                  <td>$request_quantity</td>
                  <td>$request_unit</td>
                  <td>$request_code</td>
                  <td>$request_description</td>
                  <td>$out_quantity</td>
                  <td>$out_unit</td>
                  <td>$out_code</td>
                  <td>$out_total</td>
                  <td>$tanggal</td>
                  <input type='hidden' id='l_bpp_id_$bpp_id' value='$bpp_id'>
                  <input type='hidden' id='l_req_quantity_$bpp_id' value='$request_quantity'>
                  <input type='hidden' id='l_req_unit_$bpp_id' value='$request_unit'>
                  <input type='hidden' id='l_req_code_$bpp_id' value='$request_code'>
                  <input type='hidden' id='l_req_description_$bpp_id' value='$request_description'>
                  <input type='hidden' id='l_o_quantity_$bpp_id' value='$out_quantity'>
                  <input type='hidden' id='l_o_unit_$bpp_id' value='$out_unit'>
                  <input type='hidden' id='l_o_code_$bpp_id' value='$out_code'>
                  <input type='hidden' id='l_o_total_$bpp_id' value='$out_total'>
                  <td>
                  <button type ='button' class='glyphicon glyphicon-pencil float-right ml-1 tampilModalEdit' data-toggle='modal' data-target='#formModal' title='Edit Bpp' onclick=\"show_edit_bpp('$bpp_id')\">edit</button>
                  

                  
                  

                  <a href='process.php?aksi=delete_bpp&id=$bpp_data[bpp_id]; ?' class='badge badge-danger' id='device_id' onclick=\"return confirm('Anda Yakin Menghapus Data Ini ?')\">Hapus</a> 

                  
                  
                  </td>
                  
                </tr>";
              

              }


              $content .= "</tbody></table>";
              echo $content;
            }
            else {
              echo "<p>No Data Found!</p>";
            }
          ?>
          <!-- <a href='process.php?aksi=delete_bpp&id=$bpp_data[bpp_id]; ?' class='badge badge-danger' onclick=\"return confirm('Anda Yakin Menghapus Data Ini ?')\">Hapus</a> -->
          <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading"><i class="glyphicon glyphicon-pushpin"></i> Report BPP</div>
                <div class="panel-body">
                  <a href="report_bpp.php?by=bpp_report_id&name=bpp_per_date" target="_blank" class="btn btn-large btn-block btn-primary">Print All BPP</a>
                  <hr>
                  <p>Specific Date Type :</p>
                  <div class="input-group">
                    <select class="form-control chosen-select" name="report_specific_bpp_type" onchange="set_url('bpp_report_id','bpp_per_date',this.value)">
                      <option value="">- Select Date Type -</option>
                      <?php 
                      // Get location
                      $bpp_types     = "";
                      $bpp_type_list = $bppClass->show_bpp();
                      foreach ($bpp_type_list as $bpp_type_data) {
                        $bpp_type_id   = $bpp_type_data["bpp_report_id"];
                         // $bpp_type_name = $bpp_type_data["request_code"];
                         // $bpp_types    .= "<option value='$bpp_type_id'>$bpp_type_name</option>";

                         $bpp_type_date = $bpp_type_data["tanggal"];
                         $bpp_types    .= "<option value='$bpp_type_id'>$bpp_type_date</option>";
                      }
                      echo $bpp_types;
                      ?>
                    </select>
                    <span class="input-group-btn">
                      <!-- <a href="report_bpp.php?id=" class="btn btn-primary per_date_type" target="">Show</a> -->
                      <a href="#" class="btn btn-primary bpp_per_date" target="">Show</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>

				  </div>
			</div>
    <!-- <button type='button' class='btn btn-default' title='Edit Bpp'  onclick=\"('bpp_id')\" ><i class='glyphicon glyphicon-pencil'></i></button> -->
    
    
    <!-- // delete dengan JavaScript
    <button type='button' onclick=\"deleteme('$bpp_id')\" name='Delete' value='Delete'>Delete</button>  -->

                  
  		
</div>




<?php
// get footer
include("./include/include_footer.php");
// get plugins
include("./include/init_tinymce.php");
include("./include/init_datatables.php");
include("./include/init_validetta.php");
//include("./include/init_chosen.php");
include("./include/init_fancybox.php");

echo "<script type='text/javascript' src='./js/bpp.js'></script>";
// include("./include/include_modal_bpp.php");
// include("./include/include_modal_bpp_edit.php");
// include("./include/include_modal_bpp_history.php");

// echo "<script type='text/javascript' src='./js/device_management.js'></script>";
// include("./include/include_modal_device_detail.php");
// include("./include/include_modal_device.php");
// include("./include/include_modal_device_type.php");

?>

<script type="text/javascript">

      function set_url (by, nama, kriteria) {
        if (kriteria!="") {
          $("."+nama).attr('href', 'report_bpp.php?by='+by+'&name='+nama+'&criteria='+kriteria);
          $("."+nama).attr('target', '_blank');
        }
        else {
          $("."+nama).attr('href', '#');
          $("."+nama).attr('target', ''); 
        }
      }





    </script>
    </body>
    </html>

<?php 
include("./include/init_chosen.php");
?>