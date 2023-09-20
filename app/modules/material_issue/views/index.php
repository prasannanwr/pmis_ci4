    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    					Material Issue
    					</h1>
    				</div>
                
                <div class="AddBtn">
            	    <?php //if (check_access_general(array('emp_add'))): ?>
                    <?php //format anchor(module_name, caption);?>
            	    <?php   echo anchor('material_issue/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Add </button>'); ?>
            	    <?php //endif ?>
               </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="25px">SN</th>
                                <th>Date</th>
                                <th>Diameter</th>
                                <th>Type</th>
                                <th>Units</th>
                                <th><?php echo lang('index_action_th'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    	<?php $i=1; if (!empty($arrDataList)): foreach ($arrDataList as $objData):?>
                    		<tr class="active">
                    			<td><?php echo $i++;?></td>
                    			<td><?php echo $objData->issued_date; ?></td>
                                <td><?php echo $objData->diametername; ?></td>
                                <td><?php echo $objData->materialtype; ?></td>
                                <td><?php echo $objData->units; ?></td>
                    			<td>
                    				<?php if (check_access_general(array('emp_edit'))): ?>
                    				<?php echo anchor("material_issue/create/".$objData->id, '<span class="form-edit floatRight">
                                        <img src="'.site_url().'images/edit-btn.png" width="15" height="15"></span>'); ?>
                                    <a class="confirmation" data-href="<?php echo site_url('material_issue');?>/delete/?id=<?php echo $objData->id;?>" data-toggle="confirmation"  data-singleton="true" data-placement="left" data-btnOkClass="btn-danger" data-btnCancelClass="btn-success" data-title="Are you sure to delete?" data-data accesskey="ss" >
                                    <span class="form-edit floatRight margL">
                                    <img src="<?php echo site_url();?>images/del-btn.png" width="15" height="15"></span>
                                    </a>                    				
                                    <?php endif ?>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No records</td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
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