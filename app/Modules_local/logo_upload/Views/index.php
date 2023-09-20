    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    				Logo 
    					</h1>
    				</div>
                
                
    
                <?php if (empty($arrDataList)): ?>
                <div id="infoMessage" class="alert alert-info">No data  found.</div>
                <?php else: ?>
                <div class="table-responsive col-sm-6" style="padding-top: 60px; text-align: center;">
                       <img class="img-responsive" src="<?php echo  base_url()."uploads/".$arrDataList->log01file; ?>" height="100" /> 
                    
                </div>
                    
                <?php endif ?>
                <div class="col-sm-6" style="padding-top: 60px;">
        
                  <form action="<?php echo base_url(); ?>logo_upload/index" method="post" enctype="multipart/form-data">
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message">
                        <?php var_dump( $message);?>
                    </div>
                    <?php endif;?>
                  
					<div class="form-group clearfix">
						<label for="" class="col-sm-3 control-label">
							Logo Name:
						</label>
						<div class="col-sm-6" >
                        
                            <input id="log01name" class="form-control" type="text" name="log01name" maxlength="20" value="<?php echo et_setFormVal('log01name', $objOldRec); ?>"  />
                            <?php echo form_error('log01name'); ?>
						</div>
					</div>
					<div class="form-group clearfix" >
						<label for="" class="col-sm-3 control-label">
						Logo:
						</label>
						<div class="col-sm-6 required">
                            <input id="log01file" class="form-control" type="file" name="log01file"  value="<?php echo et_setFormVal('log01file', $objOldRec); ?>"  />
                            <?php echo form_error('log01file'); ?>
						</div>
					</div>
 					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
                          <?php
                                $btn_submit = array(
                                      'id' => 'btn_submit',
                                      'name' => 'btn_submit',
                                      'value' => 'submit',
                                      'type' => 'submit',
                                      'content' => 'Submit',
                                      'class' => 'btn btn-primary'
                                );
                          ?>
                        <?php echo form_hidden('log01id', et_setFormVal('log01id', $objOldRec)); ?>
                        <?php echo form_button($btn_submit); ?>
                        <?php echo anchor('logo_upload', 'Cancel', array('class' => 'btn btn-default')); ?>
						</div>
					</div>
                   </form>
                   </div>
    			</div>
    		</div>
    	</div>
    	<!-- /.container-fluid -->
    	<div class="clear">
    	</div>
    </div>


<?php if (check_access_general(array('emp_delete'))): ?>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootbox.min.js"></script>
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