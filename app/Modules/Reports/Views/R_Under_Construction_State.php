<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->
                <div class="row">
                   <h2>Choose District</h2>
                </div>
                <!-- /.row -->
				<div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
					<div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>/reports/R_Under_Construction_State_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" method="post">
                <div class="form-group clearfix">
                <label class="col-lg-4 ">State:</label>
                <div class="col-lg-8 " style="margin-bottom: 10px;">
                  <?php echo et_form_dropdown_db('province', 'province', 'province_name', 'province_id','', '', 'class="form-control distName_search"', array('AddNone'=>false, 'NoneCaption'=>'', 'NoneValue'=>'', 'SortBy'=>'province_name')) ?>
                  <?php //echo user_ador('district', 'dist01district', 'dist01name', 'dist01id','', '', 'class="form-control distName_search"', array('AddNone'=>true, 'NoneCaption'=>'-Select-', 'NoneValue'=>'', 'SortBy'=>'dist01name'));?>
              
                </div>
                <div class="form-group clearfix">
                <label class="col-lg-4 ">&nbsp;</label>
                <div class="col-lg-3 ">
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
            <?=$this->endSection();?>