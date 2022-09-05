<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">
       
            <div class="container-fluid">
                <form action="<?php echo site_url();?>/bridge/ajaxData" method="post" id="manualSearch"  >
                <!-- Page Heading -->
                 
                <div class="row form-group">
                    <div class="col-lg-12">
						<div class="header">
							<!--<h2 class="page-header">Trial Bridge Support Unit/Helvetas Nepal</h2>-->
							<div class="col-lg-8 options">
                                                              	
        
							</div>
							
							<div class="clear"></div>
						</div>
                    </div>
                </div>
                <!-- /.row -->

				<div class="row ">
					<div class="mainBoard">
						<div class="col-lg-3 left">
                            <?php  if(session()->get('type') != 6  ){ ?>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Quick Menu</h3>
								</div>
								<div class="padd" style="padding:7px 15px;">
								   <?php echo anchor('bridge/form', 'Add Bridge') ?>
								</div>
								<?php  
                //     if  (session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_CENTRAL_MANAGER)
                // {
                    if  (session()->get('type') == ENUM_ADMINISTRATOR)
                {  
                ?>
								<div class="padd" style="padding:0px 10px 10px 15px;">
								    <?php echo anchor('fiscal_data/index', 'Annual Plan') ?>
								</div>
				<?php } ?>
								<div class="padd" style="padding:0px 10px 10px 15px;">
								    <?php echo anchor('bridge/lists/new', 'New Construction Bridges') ?>
								</div>
								<div class="padd" style="padding:0px 10px 10px 15px;">
								    <?php echo anchor('bridge/lists/mm', 'Major Maintenance Bridges') ?>
								</div>
							<!--	<div class="panel-body  padd">
								   <a href="#">Delete Bridge</a>
								</div>
								<div class="panel-body padd">
								   <a href="#">Display Details</a>
								</div> -->
							</div>
                            <?php } ?>
                            
							<div class="panel panel-primary" style="display:none">
								<div class="panel-heading">
									<h3 class="panel-title">Search - Bridge</h3>
								</div>
                               
                               
								<div class="panel-body">
									<div class="form-group">
									<label>Enter Bridge Number/Name</label>
									<input name="bridge_no" type="text" class="form-control bottom form-group number" id="manu_search" />
                                    <input type="submit"  name="ShowSubmit" class="btn btn-sm btn-primary" value="Show" />
				                   <input type="submit"  name="ShowAll" class="btn btn-sm btn-info" value="Show All" />
									
									</div>
								</div>
                                
							</div>
							<div class="panel panel-primary"style="display:none">
								<div class="panel-heading">
									<h3 class="panel-title">Search - Main District</h3>
								</div>
                              
								<div class="panel-body">
									<div class="form-group">
									<label>Select District Name</label>
         <?php echo et_form_dropdown_db('district', 'dist01district', 'dist01name', 'dist01id','', '', 'class="form-control distName_search"', array('AddNone'=>true, 'NoneCaption'=>'All District', 'NoneValue'=>'', 'SortBy'=>'dist01name')) ?>
 		                             
                                     <input type="submit"  name="distSubmit" class="btn btn-sm btn-primary" value="Show" />
				                    <input type="submit"  name="ShowAll" class="btn btn-sm btn-info" value="Show All" />
		
									</div>
								</div>
                                
							</div>
						</div>
                        <div style="font-size:36px; text-align:center; padding-top:100px;">Programme Monitoring Information System (PMIS)</div>
						<div class="col-lg-9 right" style="display:none">                            
						<h3 style="text-align: center;">Bridge List</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-hover ajaxdata" id="bridgeList">
									<thead>
										<tr>
											<!--<th>S.N.</th>-->
                                            
											<th>Bridge No</th>
											<th>Name</th>
											<th>River name</th>
											<th>Span</th>
											<th>District</th>
											<th>Completed Date</th>
											<th>Completed check</th>
											<th>Construction Type</th>
											<th>Work Category</th>
								            <th><?php echo lang('index_action_th'); ?></th> 
										</tr>
									</thead>
									
								</table>
							</div>
						</div>
                        
						<div class="clear"></div>
					</div>
							<!--<div class="col-lg-12">
								<div class="alert alert-info alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
								</div>
							</div>-->
				</div>
                <!-- /.row -->

                </form>
                </div>
               
                <!-- /.row -->

            </div>
            
   
        
    <script>
    var table;
    $(document).ready(function(){
        $url = '<?php echo site_url();?>bridge/ajaxData/';
        $del=  '<img src="<?php echo site_url();?>images/del-btn.png">';
        $add=  '<img src="<?php echo site_url();?>images/edit-btn.png" width="15px" height= "15px" ">';
   
        table = $('#bridgeList').dataTable({
            "processing": true,
            "serverSide": true,
            
             ajax: $url,
             columns: [
             
                {data: 'bri03bridge_no'}, 
                {data: 'bri03bridge_name'}, 
                {data: 'bri03river_name'}, 
                {data: 'bri03design'},
                {name: 'dist01name', data: 'dist01name', visible: true},
                {name: 'bri05bridge_complete', data: 'bri05bridge_complete',
                    mRender: function( data, type, full){
                        if(data == '0000-00-00'){
                            return '';
                        }
                        return data;
                    }
                },
                {name: 'bri05bridge_complete_check', data: 'bri05bridge_complete_check', visible: false},
                {name: 'bri03construction_type', data: 'bri03construction_type', visible: false},
                {name: 'bri03work_category', data: 'bri03work_category', visible: false},
                {type: 'html',
                    data: 'bri03bridge_no',
                    mRender: function( data, type, full ){
                        //console.log( data );
                        return '<a href="<?php echo site_url();?>bridge/form/'+ data +'">'+ $add +'</a> <?php  if(session()->get('type') == ENUM_ADMINISTRATOR || session()->get('type') == ENUM_REGIONAL_MANAGER  ){ ?> <a href="<?php echo site_url();?>bridge/delete/?id='+ data +'" onclick="return confirm(\'Warning: Once deleted, the action cannot be reverted. Are you sure you want to delete the selected bridge?\');">'+ $del +'</a> <?php }?>';                        
                    }
                }
             ],
             order: [[6, 'asc'], [5, 'desc'], [4, 'asc']]
        
        });
        $('.dataTables_filter label input').on('keyup', function(){
            $('#manu_search').val( $(this).val());
        });
        $('#manu_search').on('keyup', function(){
            $('.dataTables_filter label input').val( $(this).val()).trigger('keyup');
            
        });
		$('input[name="ShowSubmit"], input[name="distSubmit"]').on('click', function(e){
			e.preventDefault();
            $('.dataTables_filter label input').trigger('keyup');
            
        });
		$('input[name="ShowAll"]').on('click', function(e){
			e.preventDefault();
            $('#manu_search').val('');
			$('#district').val('').trigger('change');
            
        });
            
        $('#district').on('change', function(ev){
            //4 for column: dist01name;
            $('#bridgeList').DataTable().column( 4 )
                .search( $('#district option:selected').text() )
                .draw();
                ev.preventDefault();
            return false;
        });
        $('.optChange').on('change', function(ev){
            //console.log($(this).val());
            //5 for column: construction type;
            
		    var table = $('#bridgeList').DataTable();
				table
				 .search( '' )
				 .columns().search( '' )
				 .draw();

            if($(this).attr("id") == "cancelled") {
            	$('#bridgeList').DataTable().column( 8 )
                .search( $(this).val() )
                .draw();
                ev.preventDefault();
            	return false;
			} else if($(this).attr("id") == "completed") {            	
            	$('#bridgeList').DataTable().column( 6 )
                .search( 1 )
                .draw();
                ev.preventDefault();
            	return false;
            } else if($(this).attr("id") == "inprogress") {            	
            	$('#bridgeList').DataTable().column( 6 )
                .search(0)
                .draw();
                $('#bridgeList').DataTable().column( 8 )
                .search('')
                .draw();
                ev.preventDefault();
            	return false;
            } else {
            	$('#bridgeList').DataTable().column( 7 )
                .search( $(this).val() )
                .draw();
                ev.preventDefault();
            	return false;
            }            
        });
    });
       
</script>
<?= $this->endSection() ?>   