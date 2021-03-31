


 <div class="modal fade" tabindex="-1" role="dialog" id="modal_dialog_bpp_history">
	<div class="modal-dialog modal-lg">
    <div class="modal-content">

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
                $bpp_history_id      = $bpp_data["bpp_history_id"];
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
                       <a href="report_bpp.php?id=" class="btn btn-primary per_date_type" target="">Show</a> -->
                      <a href="#" class="btn btn-primary bpp_per_date" target="">Show</a>
                    </span>
                  </div>
                </div>
              </div>
            </div>


				  </div>
			</div>
			</div>
		</div>
</div>
</div> 
</div> 

<?php 
// include("./include/init_chosen.php");
?>