    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    						Walkway Width List
    					</h1>
    				</div>
                
                <div class="AddBtn">
            	    <?php //if (check_access_general(array('emp_add'))): ?>
                    <?php //format anchor(module_name, caption);?>
            	    <?php echo anchor('walkway_width/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Create Walkway Width</button>'); ?>
            	    <?php //endif ?>
               </div>
    
                <?php if (empty($arrDataList)): ?>
                <div id="infoMessage" class="alert alert-info">No Walkway Width found.</div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="25px"><input type="checkbox" name=""></th>
                                <th width="25px">SN</th>
                                <th>Code</th>
                                <th>Width</th>
                                
                                <th><?php echo lang('index_action_th'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    	<?php $i=1; foreach ($arrDataList as $objData):?>
                    		<tr class="active">
                                <td><input type="checkbox" name="selID[]"></td>
                    			<td><?php echo $i++;?></td>
                    			<td>
                    				<?php // echo anchor('walkway_width/view/'.$objData->wal01id, $objData->wal01walkwaywidth_code); ?>
                    			 <?php echo $objData->wal01walkwaywidth_code; ?>
                                </td>
                    			
                    			<td>
                    				<?php echo $objData->wal01walkway_width; ?>
                    			</td>
                    			<td>
                    				<?php if (check_access_general(array('emp_edit'))): ?>
                    				<?php echo anchor("walkway_width/create/".$objData->wal01id, '<span class="form-edit floatRight">
                                        <img src="'.site_url().'images/edit-btn.png" width="15" height="15"></span>'); ?>
                                        <a class="confirmation" data-href="<?php echo site_url('walkway_width');?>/delete/?id=<?php echo $objData->wal01id;?>" data-toggle="confirmation"  data-singleton="true" data-placement="left" data-btnOkClass="btn-danger" data-btnCancelClass="btn-success" data-title="Are you sure to delete?" data-data accesskey="ss" >
                                        <span class="form-edit floatRight margL">
                                        <img src="<?php echo site_url();?>images/del-btn.png" width="15" height="15"></span>
                                        </a>

                                    <?php endif ?>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>

                            
                        </tbody>
                    </table>
                </div>
                                    

                <?php endif ?>

            
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