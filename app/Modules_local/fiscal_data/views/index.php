<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div class="container">
    <div class="row">
    				<div class="panel-heading">
                        <form name="frmChangeView" action="<?php echo site_url();?>/fiscal_data/index" method="GET">
    					<h1 class="">
    						Annual Plan
    					</h1>
						for 
                        <select name="selConstruction" onchange="frmChangeView.submit();"><option value="0" <?php echo ($selConstruction == 0)?'selected':'';?>>New Construction</option><option value="1"  <?php echo ($selConstruction == 1)?'selected':'';?>>Major Maintenance</option></select>
                        <h2> </h2>
                    </form>
    				</div>
                
                <div class="AddBtn">
            	    <?php /*if (check_access_general(array('emp_add'))): ?>
            	    <?php  echo anchor('fiscal_data/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Create Fiscal Data</button>'); ?>
            	    <?php endif*/ ?>
                  <div class="right"> <?php // echo anchor('fiscal_data/form2', 'Form Sample for Add Bridge');?></div> 
               </div>
               <div class="row">
                   <div class="col-lg-3 clearfix">
                    </div>
                    <?php if (empty($arrViewList)): ?>
                <div id="infoMessage" class="alert alert-info">Annual Data Not found.</div>
                <?php else: ?>
                    <div class="col-lg clearfix">
                        
    <form name="frmselFY" action="<?php echo site_url();?>fiscal_data/index" method="post"> 
                <div class="form-group clearfix">                
               <div class="col-lg-12 " style="text-align:center;">
			   <label class="col-lg-12 ">Fiscal Year: <?php  echo $fiscalyear->fis01year; ?></label>
               <?php /*if(is_array($arrFYList)){ ?>
                        <select name="selFY" class="form-control" onchange="frmselFY.submit();">
                          <?php foreach($arrFYList as $fy){ ?>
                            <option value="<?php echo $fy->fis01id ;?>" <?php echo ($fiscalyear->fis01id == $fy->fis01id)?'selected="selected"':'';?>><?php echo $fy->fis01year; ?></option>
                            <?php }?>
                        </select>
                        <?php }*/?>   </div>
                </div>
            </form>
        
            </div>
                <div class="form-group clearfix">
               
            
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped dataTable">
                        <thead>
                            <tr>
                                <th width="25px"><input type="checkbox" name=""></th>
                                <th width="25px">SN</th>
                              
                                <th>District Name</th>
                               <!-- <th>New Committed</th>-->
							   <th>YPO C/Over</th>
                                <th>YPO New</th>
                                <th>Anticipated Completion</th>                                
                                
                                <th><?php echo lang('Locale.index_action_th'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    	<?php $i=1; foreach ($arrViewList as $objData): //var_dump($objData);?>
                    		<tr class="active">
                                <td><input type="checkbox" name="selID[]"></td>
                    			<td><?php echo $i++;?></td>
                   			<td>
                    				<?php echo $objData->dist01name; ?>
                    			</td>
                    			<?php /*<td>
                    				<?php echo $objData->sumdata1; ?>
                    			</td>*/?>								
								<td>
                    				<?php echo $objData->sumdata3; ?>
                    			</td>
                    			
                   			<td>
                    				<?php echo $objData->sumdata4; ?>
                    			</td>
                    			
                   			<td>
                    				<?php echo $objData->sumdata2; ?>
                    			</td>
                    			
                   			
                    			
                   			
                    			<td>
                    				<?php // if (check_access_general(array('emp_edit'))): ?>
                    				<?php /*echo anchor("fiscal_data/create/".$objData->fis02dist01codeid, '<span class="form-edit floatRight">
                                        <img src="'.site_url().'images/edit-btn.png" width="15" height="15"></span>'); */ ?>
                                        <?php echo anchor("fiscal_data/create/".$objData->fis02dist01codeid."/".$objData->fis02year."/".$selConstruction, '<span class="form-edit floatRight">
                                        <img src="'.base_url('images/edit-btn.png').'" width="15" height="15"></span>'); ?>                                        
                                       <!-- <a class="confirmation" data-href="<?php // echo site_url('fiscal_data');?>/delete/?id=<?php //echo $objData->fis02id;?>" data-toggle="confirmation"  data-singleton="true" data-placement="left" data-btnOkClass="btn-danger" data-btnCancelClass="btn-success" data-title="Are you sure to delete?" data-data accesskey="ss" >
                                        <span class="form-edit floatRight margL">
                                        <img src="<?php echo base_url('images/del-btn.png');?>" width="15" height="15"></span>
                                         </a>-->          
                                	<?php // endif ?>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>

                            
                        </tbody>
                    </table>
                </div>
  
                <?php endif; ?>

            
    			</div>
    		</div>
    	</div>
    	<!-- /.container-fluid -->
    	<div class="clear">
    	</div>
    </div>


<?php if (check_access_general(array('emp_delete'))): ?>

<script type="text/javascript">
$(document).ready(function()
	{
	    $('.del-emp').click(function(e){
	    	var link = this.href;
	    	e.preventDefault();
	    	bootbox.confirm('<p class="alert alert-error">Are you sure?</p>', function(result){
	    		if(result) {
	    			window.location = link;
	    		}
	    	});
	    });
	});
</script>

<?php endif ?>
<?= $this->endSection() ?>