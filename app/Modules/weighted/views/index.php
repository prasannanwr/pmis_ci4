    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    				weighted
    					</h1>
    				</div>
                
                
    
                <?php if (empty($arrDataList)): ?>
                <div id="infoMessage" class="alert alert-info">No data  found.</div>
                <?php else: ?>
                
                    
                <?php endif ?>
                <div class="col-sm-12" style="padding-top: 60px;">
        
                  <form action="<?php echo base_url(); ?>weighted/index" method="post" >
                    <?php if( isset($message) && $message!=''): ?>
                    <div class="message">
                        <?php var_dump( $message);?>
                    </div>
                    <?php endif;?>
                    
                  <div class="col-sm-offset-3 col-sm-6">
                 <?php
                  if(is_array($arrDataList)){
                     foreach( $arrDataList as $data){
                          //var_dump($data);         ?>
                      <div class="form-group clearfix">
    						<label for="" class="col-sm-5 control-label">
    							<?php echo $data->wei01label; ?>
    						</label>
    						<div class="col-sm-7" >
                                <input name="id_<?php echo $data->wei01id; ?>" type="hidden" value="<?php echo $data->wei01id; ?>" />
                                <input id="" class="form-control" type="text" name="wei01value_<?php echo $data->wei01id; ?>"  value="<?php echo et_setFormVal('wei01value', $data); ?>"  />
                                <?php echo form_error('wei01label'); ?>
    						</div>
    					</div>
                        <?php } } ?>
                        
                        
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
<style>
 label{text-align: right;}
</style>
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