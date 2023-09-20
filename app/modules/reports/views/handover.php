  <div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->

                <div class="row center">
                    <h3>Handover Form Report</h3>                    
                   <h4>Choose Issue Number</h4>
                </div>                
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>reports/handover_report" method="post"> 
                <div class="form-group clearfix">
                <label class="col-lg-4 ">Issue Number:</label>
                    <div class="col-lg-8">
           <?php if(is_array($arrReceiptList)){ ?>
                        <select name="receipt_num" class="form-control">
                          <?php foreach($arrReceiptList as $dataRow){ ?>                          
                            <option value="<?php echo $dataRow->id ;?>"><?php echo $dataRow->req_id; ?></option>
                            <?php } ?>
                        </select>
                        <?php }?> 
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
            
            