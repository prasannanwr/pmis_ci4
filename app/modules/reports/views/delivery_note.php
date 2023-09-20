  <div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->

                <div class="row center">
                    <h3>Delivery Note Report</h3>                    
                   <h4>Choose Issue Number</h4>
                </div>                
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>reports/delivery_note_report" method="post"> 
                    
                <div class="form-group clearfix">
                <label class="col-lg-4 ">Issue Number:</label>
                    <div class="col-lg-8">
           <?php if(is_array($arrReceiptList)){ ?>
                        <select name="receipt_num" id="receipt_num" class="form-control">
                          <option value=''>-Select-</option>
                          <?php foreach($arrReceiptList as $dataRow){ ?>                                                   
                            <option value="<?php echo $dataRow->id ;?>"><?php echo $dataRow->req_id; ?></option>
                            <?php } ?>
                        </select>
                        <?php }?> 
                          </div>
                </div>

                <div class="form-group clearfix">
                <label class="col-lg-4 ">Bridge Name:</label>
                    <div class="col-lg-8">           
                        <input type="text" name="bridge_name" id="bridge_name" class="form-control">
                        <!-- <div id="suggesstion-box"></div> -->
                          </div>                                
                </div>                           
                <div class="form-group clearfix">
                <label class="col-lg-4 ">Bridge Number:</label>
                    <div class="col-lg-8">           
                        <input type="text" name="bridge_number" id="bridge_number" class="form-control">
                        <!-- <div id="suggesstion-box"></div> -->
                          </div>                                
                </div>       
                
                <div class="form-group clearfix">
                <label class="col-lg-4 ">&nbsp;</label>
                <div class="col-lg-3 ">
                <input type="submit" class=" form-control btn btn-sm btn-primary" name="submit"  value="Report"/>
            </div>
               <div class="col-lg-3 ">
              <input type="submit" class=" form-control btn btn-sm btn-success" name="submit"  value="Back"/>
            </div>
                </div>
                
                  </form>
                    
                        
					
                       
					</div>
					
				</div>
                <!-- /.row -->               
                </div>
                <!-- /.row -->

            </div>
            <script type="text/javascript">
            jQuery(document).ready(function(){

                $("#receipt_num").on('change', function() {
                  $.ajax({
                    type: "GET",
                    //url: "<?php echo base_url();?>reports/bridge_search/",
                    url: "<?php echo base_url();?>material_issue/getRequisitionBridge",
                    data:'receipt_num='+$(this).val(),
                    // beforeSend: function(){
                    //   $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                    // },
                    success: function(msg){       
                      var data = JSON.parse(msg);               
                      $("#bridge_name").val(data.bridge);
                      $("#bridge_number").val(data.bridge_num);                      
                      //$("#search-box").css("background","#FFF");
                    }                    
                  });
                });
                $('#bridge_name').keyup(function() {                
                    $.ajax({
                      type: "GET",
                      url: "<?php echo base_url();?>reports/bridge_search/",
                      data:'bridge_name='+$(this).val(),
                      // beforeSend: function(){
                      //   $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                      // },
                      success: function(data){
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        //$("#search-box").css("background","#FFF");
                      }
                });

                });
            });
            </script>
            
            