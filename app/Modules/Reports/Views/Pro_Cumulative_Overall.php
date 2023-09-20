<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

            <div class="container-fluid">
  
                <!-- Page Heading -->
                <div class="row">
                   <h2>Choose Fiscal Year</h2>
                </div>
                <!-- /.row -->
                <div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
                    <div class="col-lg-5 clearfix">
                   <form action="<?php echo site_url();?>/reports/Pro_Cumulative_Overall_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" method="get"> 
                <div class="form-group clearfix">
                <label class="col-lg-4 ">Start Year:</label>
                    <div class="col-lg-8">
           <?php if(is_array($arrDistList)){ ?>
                        <select name="start_year" class="form-control">
                          <?php foreach($arrDistList as $dataRow){ ?>
                            <option value="<?php  echo $dataRow->fis01id;?>"><?php echo $dataRow->fis01year; ?></option>
                          
                            <?php }?>
                        </select>
                        <?php }?> 
                          </div>                
                
                </div>
                <div class="form-group clearfix">
                <label class="col-lg-4 ">End Year</label>
                <div class="col-lg-8">
           <?php if(is_array($arrDistList)){ ?>
                        <select name="end_year" class="form-control">
                          <?php foreach($arrDistList as $dataRow){ ?>
                            <option value="<?php  echo $dataRow->fis01id ;?>"><?php echo $dataRow->fis01year; ?></option>
                          
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
            <?= $this->endSection() ?>            