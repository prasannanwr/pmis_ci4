<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->

                <div class="row center">
                    <h3>Site Assesment and Survey Report DateWise</h3>
                    <h5 class="one_newRpt">[ <?php echo choosename($blnMM);?> ]</h5>
                   <h4>Choose Date</h4>
                </div>                 
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>/reports/Eng_SiteAssesment_Survey_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" method="post"> 
                <div class="form-group clearfix">
                <label class="col-lg-4 ">Start Date:</label>
                <div class="col-lg-8 datebox-container ">
                  <div class="col-lg-10 nopad datetimepicker input-group date ">    
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    	<input type="text" class=" form-control " name="start_date" id="start_date" value=""/>
                     </div>
           </div>
                </div>
                <div class="form-group clearfix">
                <label class="col-lg-4 ">End Date</label>
                <div class="col-lg-8 datebox-container ">
                       <div class="col-lg-10 nopad datetimepicker input-group date ">    
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    	<input type="text" class=" form-control " name="end_date" id="end_date" value=""/>
                     </div>
               
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
            <?=$this->endSection();?>