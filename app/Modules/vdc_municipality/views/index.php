    <div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    					RM / UM List
    					</h1>
    				</div>
                
                <div class="AddBtn">
            	    <?php //if (check_access_general(array('emp_add'))): ?>
                    <?php //format anchor(module_name, caption);?>
            	    <?php echo anchor('vcd_municipality/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Create RM/UM</button>'); ?>
            	    <?php //endif ?>
               </div>
    
                <?php if (empty($arrDataList)): ?>
                <div id="infoMessage" class="alert alert-info">No municipality List found.</div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped ajaxdataTable">
                        <thead>
                            <tr>
                                <th>RM/UM Name</th>
                                <th>RM/UM Code</th>
                                <th>District Name</th>
                                 <th>Zone Name</th>
                                 <th>Dev. Regional Name</th>
                                 <th>State</th>
                                 <th>Total Bridges</th>
                                <th><?php echo lang('index_action_th'); ?></th>
                            </tr>
                        </thead>
                        
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

 <?php //var_dump($arrDataList); ?>
 <script>
    $(document).ready(function(){
        $url = '<?php echo site_url();?>vcd_municipality/ajaxData/';
        $del=  '<img src="<?php echo site_url();?>images/del-btn.png">';
        $add=  '<img src="<?php echo site_url();?>images/edit-btn.png" width="15px" height= "15px" ">';
    //$('.ajaxdataTable').dataTable();
    $('.ajaxdataTable').dataTable({
        "processing": true,
        "serverSide": true,
         ajax: $url,
         columns: [
            {data: 'muni01name'}, 
            {data: 'muni01code'}, 
            {data: 'dist01name'}, 
            {data: 'zon01name'},
           {data: 'dev01name'},
           {data: 'province_name'},
           {data: 'muni01last_bridge_no'},
            {type: 'html',
                data: 'muni01id',
                mRender: function( data, type, full ){
                    //console.log( data );
                    return '<a href="<?php echo site_url();?>vcd_municipality/create/'+ data +'">'+ $add +'</a> <a href="<?php echo site_url();?>vcd_municipality/delete/?id='+ data +'">'+ $del +'</a>';
                }
            }
         ]
        
        });
    });
    </script> 