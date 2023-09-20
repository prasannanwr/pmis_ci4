  <div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->

                <div class="row center">
                    <h3>Receipt Report</h3>                    
                   <h4>Choose Receipt Number</h4>
                </div>                
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>reports/receipt_report" method="post"> 
                <div class="form-group clearfix">
                  <label class="col-lg-4 ">Receipt Date:</label>                  
                  <div class="col-lg-8 datebox-container ">
                      <div class="col-lg-10 nopad datetimepicker input-group date ">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                          <input type="text" class=" form-control " name="receipt_date" id="receipt_date" value=""/>
                      </div>
                  </div>                               
                </div>                                
                <div class="form-group clearfix">
                  <label class="col-lg-4 ">Receipt Number:</label>
                  <div class="col-lg-8">
         <?php if(is_array($arrReceiptList)){ ?>
                      <select name="receipt_num" id="receipt_num" class="form-control">
                          <option value="">-Select-</option>
                        <?php foreach($arrReceiptList as $dataRow){ ?>
                          <option value="<?php  echo $dataRow->rcid ;?>"><?php echo $dataRow->rcid; ?></option>
                        
                          <?php }?>
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
<script type="text/javascript">
jQuery(document).ready(function(){

    $("#receipt_date").on('change', function() {
      $.ajax({
        type: "GET",        
        url: "<?php echo base_url();?>reports/getReceiptByDate",
        data:'receipt_date='+$(this).val(),
        // beforeSend: function(){
        //   $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        // },
        success: function(msg){       
          //var data = JSON.parse(msg);               
         $("#receipt_num").html(msg);
         // $("#bridge_number").val(data.bridge_num);                      
          //$("#search-box").css("background","#FFF");
        }                    
      });
    });
  });
</script>            
            
            