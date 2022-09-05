<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="" class="dashboard-bg">
    	<div class="container-fluid">
    		<div class="panel panel-default">
    			<div class="ShowForm-form ">
    				<div class="panel-heading">
    					<h1 class="">
    				District Name List
    					</h1>
    				</div>
                
                <div class="AddBtn">
            	    <?php //if (check_access_general(array('emp_add'))): ?>
                    <?php //format anchor(module_name, caption);?>
            	    <?php echo anchor('district_name/create', '<button type="button" class="btn btn-small"><i class="icon-user icon"></i> Create New District </button>'); ?>
            	    <?php //endif ?>
               </div>
    
                <?php if (empty($arrDataList)): ?>
                <div id="infoMessage" class="alert alert-info">No Zone List found.</div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped ajaxdataTable">
                        <thead>
                            <tr>
                               <!-- <th width="25px"><input type="checkbox" name=""></th>-->
                               <!-- <th width="25px">SN</th>-->
                                <th>Name</th>
                                <th>code</th>
                                <th>Zone</th>
                                <th>State</th>
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

     <script>
    $(document).ready(function(){
        $url = '<?php echo site_url();?>district_name/ajaxData/';
        $del=  '<img src="<?php echo site_url();?>images/del-btn.png">';
        $add=  '<img src="<?php echo site_url();?>images/edit-btn.png" width="15px" height= "15px" ">';
    //$('.ajaxdataTable').dataTable();
    $('.ajaxdataTable').dataTable({
        "processing": true,
        "serverSide": true,
         ajax: $url,
         columns: [
            {data: 'dist01name'}, 
            {data: 'dist01code'}, 
            {data: 'zon01name'}, 
            {data: 'province_name'},
            {type: 'html',
                data: 'dist01id',
                mRender: function( data, type, full ){
                    //console.log( data );
                    return '<a href="<?php echo site_url();?>district_name/create/'+ data +'">'+ $add +'</a> <a href="<?php echo site_url();?>district_name/delete/?id='+ data +'">'+ $del +'</a>';
                }
            }
         ]
        
        });
    });
    </script>  
    <?=$this->endSection();?>