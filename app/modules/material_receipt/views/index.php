    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    					Material Receipt
    					</h1>
    				</div>
                
                <div class="AddBtn">
            	    <?php //if (check_access_general(array('emp_add'))): ?>
                    <?php //format anchor(module_name, caption);?>
            	    <?php   echo anchor('material_receipt/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Add Receipt</button>'); ?>
            	    <?php //endif ?>
               </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="receiptsList">
                        <thead>
                            <tr>
                                <th width="25px">SN</th>
                                <th>Receipt date</th>
                                <th>Material</th>
                                <th>Diameter</th>
                                <th>Input Id</th>
                                <th>Lot</th>
                                <th>Units</th>
                                <th>Purchased by</th>
                                <th><?php echo lang('index_action_th'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    	<?php $i=1; if (!empty($arrDataList)): foreach ($arrDataList as $objData):?>
                    		<tr class="active">
                    			<td><?php echo $i++;?></td>
                                <td><?php echo $objData->receipt_date; ?></td>
                                <td><?php echo $objData->typename; ?></td>
                                <td><?php echo $objData->diametername; ?></td>
                                <td><?php echo $objData->input_id; ?></td>
                                <td><?php echo $objData->lot; ?></td>
                                <td><?php echo $objData->units; ?></td>
                                <td><?php echo ($objData->purchased_by == 1?'GON':'SDC'); ?></td>
                    			<td>
                    				<?php if (check_access_general(array('emp_edit'))): ?>
                    				<?php echo anchor("material_receipt/create/".$objData->id, '<span class="form-edit floatRight">
                                        <img src="'.site_url().'images/edit-btn.png" width="15" height="15"></span>'); ?>
                                    <a class="confirmation" data-href="<?php echo site_url('material_receipt');?>/delete/?id=<?php echo $objData->id;?>" data-toggle="confirmation"  data-singleton="true" data-placement="left" data-btnOkClass="btn-danger" data-btnCancelClass="btn-success" data-title="Are you sure to delete?" data-data accesskey="ss" >
                                    <span class="form-edit floatRight margL">
                                    <img src="<?php echo site_url();?>images/del-btn.png" width="15" height="15"></span>
                                    </a>
                                    <?php endif ?>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No records</td>
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
	    //datatable
        //var table;
        //$url = '<?php //echo site_url();?>//material_receipt/ajaxData/';
        //$del=  '<img src="<?php //echo site_url();?>//images/del-btn.png">';
        //$add=  '<img src="<?php //echo site_url();?>//images/edit-btn.png" width="15px" height= "15px" ">';
        //
        //table = $('#receiptsList').dataTable({
        //    "processing": true,
        //    "serverSide": true,
        //
        //    ajax: $url,
        //    columns: [
        //        {data: 'id'},
        //        {data: 'receipt_date'},
        //        {data: 'typename'},
        //        {data: 'diametername'},
        //        {data: 'input_id'},
        //        {data: 'lot'},
        //        {data: 'units'},
        //        {type: 'html',
        //            data: 'id',
        //            mRender: function( data, type, full ){
        //                //console.log( data );
        //                return '<a href="<?php //echo site_url();?>//material_receipt/create/'+ data +'">'+ $add +'</a> <?php // if($this->session->userdata('type') == ENUM_ADMINISTRATOR){ ?>// <a href="<?php //echo site_url();?>//material_receipt/delete/?id='+ data +'" onclick="return confirm(\'Warning: Once deleted, the action cannot be reverted. Are you sure you want to delete the selected data?\');">'+ $del +'</a> <?php //}?>//';
        //            }
        //        }
        //    ],
        //    order: [[6, 'asc'], [5, 'desc'], [4, 'asc']]
        //
        //});
        //
        //$('input[name="ShowSubmit"], input[name="distSubmit"]').on('click', function(e){
        //    e.preventDefault();
        //    $('.dataTables_filter label input').trigger('keyup');
        //
        //});
        //
        //var table = $('#bridgeList').DataTable();
        //table
        //    .search( '' )
        //    .columns().search( '' )
        //    .draw();
            // $('#bridgeList').DataTable().column( 7 )
            //     .search( $(this).val() )
            //     .draw();

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