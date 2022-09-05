<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

            <div class="container-fluid">
  
                <!-- Page Heading -->
                <div class="row">
                   <h2>Choose TBSU Regional Office</h2>
                </div>
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>/reports/R_Completed_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" method="post"> 
                <div class="form-group clearfix">
                 <label class="col-lg-4 ">TBSU Regional Office:</label>
                <div class="col-lg-8 " style="margin-bottom: 10px;">
                  <?php //echo et_form_dropdown_db('regionaloffice', 'tbis01regional_office', 'tbis01name', 'tbis01id','', '', 'class="form-control regional_search"', array('AddNone'=>true, 'NoneCaption'=>'All', 'NoneValue'=>'', 'SortBy'=>'tbis01name')) ?>                  
				  <?php echo et_form_dropdown_db('regionaloffice', 'tbis01regional_office', 'tbis01name', 'tbis01id','', '', 'class="form-control regional_search"') ?>   
                </div>
                <div class="form-group clearfix">
                <label class="col-lg-4 ">&nbsp;</label>
                <div class="col-lg-3 ">
                  <input type="hidden" name="rtype" value="regional" />
                <input type="submit" class=" form-control btn btn-sm btn-primary" name="submit"  value="Report"/>
            </div>
               <div class="col-lg-3 ">
               <a href="<?php echo  site_url(); ?>" class=" form-control btn btn-sm btn-success">Back</a>
              <!--<input type="submit" class=" form-control btn btn-sm btn-success" name="submit"  value="Back"/>-->
            </div>
                </div>
                
                  </form>
                    
                        
					
                       
					</div>
					
				</div>
                <!-- /.row -->               
                </div>
                <!-- /.row -->

            </div>
            
            