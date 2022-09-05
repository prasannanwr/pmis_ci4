<div id="page-wrapper">
    <div class="container-fluid">
 
 
   <!-- Page Heading 
	<form role="form form-group New_Bridge">-->
               
     <?php // var_dump($objOldRec); ?>
     <div class="row add_form_btn">
     <a href="<?php echo site_url();?>bridge" class="btn btn-md btn-primary">Back</a>        

     </div>
           <div class="row">
                    <div class="NewFormTopHeader">
						<div class="header">
							<ul class="nav navbar-nav tabHeads nav-tabs">
								<li class="active"><a href="#Basic_Data">Basic Data and Geographic Info</a></li>
								<li><a href="#Basic_Technical">Basic Technical Data</a></li>
								<li><a href="#Implementation">Implementation Process</a></li>
								<li><a href="#Personnel_Information">Personnel Information</a></li>
								<li><a href="#Estimated_Cost">Estimated Cost &amp; Contribution</a></li>
								<li><a href="#Actual_Cost">Actual Cost &amp; Contribution</a></li>
							</ul>
							<div class="clear"></div>
						</div>
                    </div>
                </div>             

                    <div id='content' class="tab-content">
                      <div class="tab-pane active" id="Basic_Data">
  			<!--/ start first Bridge .row-->
                <div class="row">
				<div class="col-lg-12">
					<u><h1 class="page-header font">
                        Basic Bridge Data and Geographic Information
                    </h1></u>
				</div>
				</div>
                <!-- /.row -->
				<div class="row clearfix">
					<div class="col-lg-12">
						<div class="col-lg-4">
                     <?php  // print_r($objOldRec );?> 
								<div class="form-group clearfix ">
									<label class="col-lg-5 ">Bridge Name:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03bridge_name; ?></label>
			                      </div>
								</div>
					
									<div class="form-group clearfix">
										<label class="col-lg-5 ">District Name Left Bank:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->left_muni01name; ?></label>
                                  
	              						</div>
										
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5">VCD/Municipality LB:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->left_muni01name; ?></label>
                                        
										</div>
										
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 ">Major VDC/NP:</label>
										<div class="col-lg-7 ">
                                                    <label><?php echo et_setFormVal('bri03major_vdc', $objOldRec); ?></label>
    									</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 ">Ward LB:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->bri03ward_lb; ?></label>
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Road Head:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->bri03road_head; ?></label>
                             			</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5">Bridge Type:</label>
										<div class="col-lg-7 ">
                       <label><?php echo $objOldRec->bri01bridge_type_name; ?></label>
       
 										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5">WW Width(cm):</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->wal01walkway_width; ?></label>
   		                                        
									
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5">Development Region:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->dev01name; ?></label>
        								
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 ">Supporting agency:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->sup01sup_agency_name; ?></label>
                                   
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 ">Project Fiscal Year:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->fis01year; ?></label>
                   
                                        
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 ">Coordinate North:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->bri03coordinate_north; ?></label>
                                   					</div>
									</div>
                                   
									
						</div>
						<div class="col-lg-5">
								<div class="form-group clearfix">
								<label class="col-lg-5 ">Construction Type:</label>
								<div class="col-lg-7 ">
                                <label><?php echo $objOldRec->con02construction_type_name; ?></label>
                    
								</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">District Name Right Bank:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->right_dist01name; ?></label>
                                       
									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">VCD/Municipality RB:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->right_muni01name; ?></label>
                             
							                                    
									
									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Bridge Series:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03coordinate_north; ?></label>
                                   	
									
									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Ward RB:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03ward_rb; ?></label>
                                 
 									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Portering Distance(Days):</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03portering_distance; ?></label>
                                 	
  									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar" style="text-align: left;">Design Span(m):</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03design;?></label>
                                	
  									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">WW Deck Type:</label>
									<div class="col-lg-7 ">
                               <label><?php echo $objOldRec->wad01walkway_deck_type_name; ?></label>
  									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">TBSU Regional Office:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->tbis01name; ?></label>
 									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Work Category:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->wkc01work_category_name;?></label>
                          
 									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Topo Map No:</label>
									<div class="col-lg-7 ">
                                    <label><?php echo $objOldRec->bri03topo_map_no; ?></label>
                    
 									</div>
								</div>
								
								<div class="form-group clearfix">
									<label class="col-lg-5 ">Coordinate East:</label>
									<div class="col-lg-7 ">
                                     <label><?php echo $objOldRec->bri03coordinate_east; ?></label>
	
 									</div>
								</div>
								
							
						</div>
						<div class="col-lg-3">
							<div class="form-group clearfix">
								<label class="col-lg-5 ">Bridge No:</label>
								<div class="col-lg-7 ">
                                <label><?php echo $objOldRec->bri03bridge_no; ?></label>
	
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-lg-5">River Name:</label>
								<div class="col-lg-7 ">
                                <label><?php echo $objOldRec->bri03river_name; ?></label>

      								</div>
							</div>
						</div>						
					
					</div>	
				</div>
				<!--  /.row -->	
                
                     </div> 	<!-- end first Bridge -->	
                     <!----start second Bridge---->
                      <div class="tab-pane" id="Basic_Technical">
            <div class="row">
				<div class="col-lg-12">
				<h1 class="page-header font">
                       Basic Technical Data 
                    </h1>
				</div>
                <!-- /.row -->
				<div class="row clearfix">
					<div class="col-lg-12">
						<div class="col-lg-6">
                       
 	
								<div class="form-group clearfix">
										<label class="col-lg-5 ">Main Anchorage Foundation Left Bank:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->left_anc01maf_type_name; ?></label>
             
 										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Main Anchorage Foundation Right Bank:</label>
										<div class="col-lg-7 ">
                                     <label><?php echo $objOldRec->right_anc01maf_type_name; ?></label>   
              
										</div>
										<div class="clear"></div>
									</div>
								
								<div class="form-group clearfix">
										<label class="col-lg-5  ">Bank and Slope Protection Left Bank:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->bri04slope_protection_lb; ?></label>
                    	
										</div>
								</div>
								<div class="form-group clearfix">
										<label class="col-lg-5  ">Bank and Slope Protection Right Bank:</label>
										<div class="col-lg-7">
                                        <label><?php echo $objOldRec->bri04slope_protection_rb; ?></label>
				             	
							</div>
								</div>
								
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Rust Prevention Measures:</label>
										<div class="col-lg-7 ">
                                       <label><?php echo $objOldRec->rus01rpm_type_name; ?></label> 
  						          	</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Bridge Design Standard:</label>
										<div class="col-lg-7 ">
                                       <label> <?php echo $objOldRec->bri02bds_type_name; ?></label> 
              
                                        
										</div>
										<div class="clear"></div>
									</div>																			
						</div>
						<div class="col-lg-6">
								<div class="form-group clearfix">
									<label class="col-lg-5   col">Bridge Name:</label>
									<div class="col-lg-7 ">
				                  <label> <?php echo $objOldRec->bri03bridge_name; ?></label>                 
				             
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-5   col">Bridge Number:</label>
									<div class="col-lg-7 ">
                              <label> <?php echo $objOldRec->bri03bridge_no; ?></label>      
	             
							</div>
								</div>
								<div class="form-group clearfix">
										<label class="col-lg-5  ">Handrail Cable 2 nos. Dia(mm):</label>
										<div class="col-lg-7 ">
                                  <label><?php echo $objOldRec->hdc01hhcn_type_number; ?></label>      
             
 										
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Main(walkway) Cable Nos(mm):</label>
										<div class="col-lg-7 ">
                                       <label><?php echo $objOldRec->cab01mcnww_type_number; ?></label> 
            
 										
										</div>
										<div class="clear"></div>
									</div>
								
								
								
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Main(walkway) Cable Dia(mm):</label>
										<div class="col-lg-7 ">
                                       <label><?php echo $objOldRec->cad01mcdww_type_number; ?></label> 
                        
 											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5  ">Windguy Arrangement:</label>
										<div class="col-lg-7 ">
                                        <label><?php echo $objOldRec->bri04windguy_arrangement; ?></label>
											
										</div>
										<div class="clear"></div>
									</div>																			
						</div>		
					</div>	
				</div>
				<!-- /.row -->	
                

            </div> 
           </div>
                    <!----end second Bridge---->
                   <!----start third Bridge---->
   
             <div class="tab-pane" id="Implementation">
                <div class="row">
				<div class="col-lg-12">
					<u><h1 class="page-header font">
                        Bridge Implementation Process (Dates)
                    </h1></u>
				</div>
				</div>
                <!-- /.row -->
				<div class="row clearfix">
					<div class="col-lg-12">
						<div class="col-lg-4">
                        			
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Site Assessment and Survey:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad ">  
              				             	        <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05site_assessment_check == 1)? 'checked="checked"': ''?>/>
                                          	    </div> 
                                              <div class="col-lg-10  input-group ">    
                                               
                                                <label><?php echo $objOldRec->bri05site_assessment; ?></label>
                                                	
                                                 </div>
											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Bridge Design Estimate:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05bridge_design_estimate_check == 1)? 'checked="checked"': ''?>/>
                                      
              				             	        
                                          	    </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                 <label><?php echo $objOldRec->bri05bridge_design_estimate; ?></label>
	                                             
                                                
            		                          </div>
											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Material Supply Target:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled"  <?php echo ($objOldRec->bri05material_supply_target_check == 1)? 'checked="checked"': ''?>/>
                                      </div>
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05material_supply_target; ?></label>
 
                                              	    </div> 
           		                          
											
										</div>
									</div>
									
									
									
									
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">First Phase Constrution:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05first_phase_constrution_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05first_phase_constrution; ?></label>
  
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Anchorage Concreting:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled"  <?php echo ($objOldRec->bri05anchorage_concreting_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05anchorage_concreting; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Bridge Complete:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05bridge_complete_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05bridge_complete; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">BMC Formation:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled"  <?php echo ($objOldRec->bri05bmc_formation_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05bmc_formation; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
						</div>
						<div class="col-lg-4">
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">SOS Orentation:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05sos_orentation_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05sos_orentation; ?></label>
 
                                              	    </div>
											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Design Approval:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05design_approval_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05design_approval; ?></label>
 
                                              	    </div>
											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Bridge Completion Target:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05bridge_completion_target_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05bridge_completion_target; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									
									
									
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Material Supply to UC:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05material_supply_uc_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05material_supply_uc; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Cable Pulling:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05cable_pulling_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05cable_pulling; ?></label>
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Final Inspection:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disable" <?php echo ($objOldRec->bri05final_inspection_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05final_inspection; ?></label>
  
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Bridge Completion Fiscal Year:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disable"<?php echo ($objOldRec->bri05bridge_completion_fiscalyear_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $Completion_Fiscal_Year->fis01year; ?></label>
                        
 

                                              	    </div>
											
										</div>
									</div>
						</div>
						<div class="col-lg-4">
									<div class="form-group clearfix">
										<label class="col-lg-5 control-label col mar">Bridge Name:</label>
										<div class="col-lg-7 datebox-container ">
                                            <label><?php echo $objOldRec->bri03bridge_name; ?>"</label>                
            		        
                                               <!-- <input  type="text" class="  form-control " name="" id="" value=""/> -->
 										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 control-label col mar">Bridge Number:</label>
										<div class="col-lg-7 datebox-container ">
                                                
                                           <label><?php echo $objOldRec->bri03bridge_no; ?>"</label>      
                                               
                                                 
            		                         
											
										</div>
										<div class="clear"></div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Community Agreement:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled" <?php echo ($objOldRec->bri05community_agreement_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05community_agreement; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									
									
									
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">DMBT:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disabled"<?php echo ($objOldRec->bri05dmbt_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05dmbt; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Second Phase Construction:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disable" <?php // echo ($objOldRec->bri05second_phase_constructiont_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php // echo $objOldRec->bri05second_phase_constructiont; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Third Phase Construction:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control" disabled="disable" <?php echo ($objOldRec->bri05third_phase_construction_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05third_phase_construction; ?></label>
 
                                              	    </div>
											
										</div>
									</div>
									
									<div class="form-group clearfix">
										<label class="col-lg-5 nopad">Work Completion Certificate:</label>
										<div class="col-lg-7 datebox-container ">
                                               <div class="col-lg-2 checkPad "> 
                                               <input type="checkbox" class=" form-control " disabled="disable" <?php echo ($objOldRec->bri05work_completion_certificate_check == 1)? 'checked="checked"': ''?>/>
                                      </div> 
                                              <div class="col-lg-10 nopad  input-group  ">    
                                               
                                                <label><?php echo $objOldRec->bri05work_completion_certificate; ?></label>

                                              	    </div>
											
										</div>
									</div>
						</div>						
					
					</div>	
				</div>
             </div>
                  <!----ens third Bridge---->
                   <!----start forth Bridge---->
                      <div class="tab-pane" id="Personnel_Information">
<!--/.row-->
                <div class="row">
				<div class="col-lg-12">
					<u><h1 class="page-header font">
                        Personnel Information
                    </h1></u>
				</div>
				</div>
                <!-- /.row -->
				<div class="row clearfix">
					<div class="col-lg-12">
                                           				

						<div class="col-lg-4">
								<div class="form-group clearfix">
										<span class="col-lg-4 ">Site Surveyor(s):</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06site_surveyor; ?></label>
          	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">Design Approved By (Name/Position):</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06design_approved_by; ?></label>
          	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">UC Members:</span>
										<div class="col-lg-8 ">
         	  <label><?php echo $objOldRec->bri06uc_members; ?></label>
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">(I)NGO Personnel/consultants Trained:</span>
										<div class="col-lg-8 ">
                                                 	  <label><?php echo $objOldRec->bri06ngo_consultants_trained; ?></label>

         	  
										</div>
								</div>																								
						</div>
						<div class="col-lg-4">
								<div class="form-group clearfix">
										<span class="col-lg-4 ">Bridge Designer:</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06bridge_designer; ?></label>
        	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">Site Supervision(s):</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06site_supervision; ?></label>
      	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">Bridge Craftpersons Trained:</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06bridge_craftpersons_trained; ?></label>
      	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">BMC Chairperson Name/Address:</span>
										<div class="col-lg-8 ">
                                       <label><?php echo $objOldRec->bri06bmc_chairperson; ?></label> 
     	  
										</div>
								</div>																								
								
						</div>
						<div class="col-lg-4">
								<div class="form-group clearfix">
									<label class="col-lg-4  col">Bridge Name:</label>
									<div class="col-lg-8 ">
                                    <label><?php echo $objOldRec->bri03bridge_name; ?></label>
                                      
            		   									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-4  col">Bridge Number:</label>
									<div class="col-lg-8 ">
                                    <label><?php echo $objOldRec->bri03bridge_no; ?></label>
								             		   
									</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">UC Chairperson Name/Address:</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06uc_chairperson; ?></label>
     	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">DDC Technician Trained:</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06ddc_technician_trained; ?></label>
     	  
										</div>
								</div>
								<div class="form-group clearfix">
										<span class="col-lg-4 ">BMC Members:</span>
										<div class="col-lg-8 ">
                                        <label><?php echo $objOldRec->bri06bmc_members; ?></label>
     	  
										</div>
								</div>
							<!--	<div class="form-group clearfix">
										<span class="col-lg-4 ">Bridge Name</span>
										<div class="col-lg-8 ">
										  <textarea class="form-control" rows="2"></textarea>
										</div>
								</div> -->																							
								
						</div>				
					</div>	
				</div>
				<!-- /.row -->	
                                      
         </div>
                    
                 <!----end forth Bridge---->
     
                   <!----start fifth Bridge---->
 
                      <div class="tab-pane" id="Estimated_Cost">
				<!--/.row-->
                <div class="row form-group">
                    <div class="form-group" style="text-align: center;"><h3 class="">
                        Estimated Cost and Contribution Commitment
                    </h3></div>
				<div class="col-lg-12">
            <div class="col-lg-8 form-group">
           <!-- <h4 class=""style="text-align:center;">contribution of agencies</h4> -->
            </div>                
	
					<div class="col-lg-4">
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar col">Bridge Name:</label>
									<div class="col-lg-7 marB">
                                    <label><?php echo $objOldRec->bri03bridge_name; ?></label>
	                                      
            		   								</div>
								</div>								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar col">Bridge Number:</label>
									<div class="col-lg-7 marB">
                                    <label><?php echo $objOldRec->bri03bridge_no; ?></label>
				                               		   					</div>
								</div>
								
					</div>
				</div>
				</div>
                <!-- /.row -->
				<div class="row clearfix">
					<div class="col-lg-12">
						<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <!--
                                    <tr>
                                        <th class="cost width center" rowspan="2">Cost Components</th>
                                        <th class="LSA center" rowspan="2">DDC</th>
                                        <th class="LSA center" rowspan="2">VDC</th>
                                        <th class="LSA center" rowspan="2">Community</th>
										<th class="LSA center" rowspan="2">TBSU</th>
										<th class="GON center" colspan="4">Government of Nepal</th>                               
                                        <th class="others center" rowspan="2">(I)NGO</th>
                                        <th class="others center" rowspan="2">OTHERS</th>
                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>
										<th class="Tcost center" rowspan="2">Cost in %</th>
                                    </tr>
									<tr>
										<th class="GON center">RAIDP</th>
                                        <th class="GON center">DRILP</th>
                                        <th class="GON center">RRRSDP</th>
										<th class="GON center">SWAP</th>								
									</tr>
                                    -->
                                    <tr>
                                        <th class="cost width center" rowspan="2">Cost Components</th>
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr){
                                                echo '<th class="LSA center " rowspan="2">'.$dr->sup01sup_agency_code.'</th>';
                                            }?>
                                        <?php endif;?>
                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>
										<th class="Tcost center" rowspan="2">Cost in %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array( $arrCostCompList )): ?>
                                        <?php foreach( $arrCostCompList as $dr): ?>
                                            <?php // find the respective data of this cid and sid ?>
                                    <tr>
                                        <td class="align">
                                            <?php echo $dr->cmp01component_name;?>
                                        </td>
                                       
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr1){
                                                //query and find its data
                                                $blnFound = false;
                                                $selrec = null;
                                                if(isset($arrEstCost) && is_array( $arrEstCost)){
                                                    foreach( $arrEstCost as $k=>$v){
                                                        if( $v->bri07cmp01id == $dr->cmp01id && 
                                                            $v->bri07sup01id == $dr1->sup01id){
                                                            $selrec = $v;
                                                            $blnFound = true;
                                                            //var_dump( $selrec );
                                                            break;
                                                        }
                                                    }
                                                }
                                                $cName = 'est_cost[C_'.$dr->cmp01id.'][S_'.$dr1->sup01id.']';
                                                echo '<td>
                                                    <input class="form-control EstimatedAmt r_'.$dr->cmp01id.' s_'.$dr1->sup01id.'" 
                                                        data-row = "r_'.$dr->cmp01id.'"
                                                        data-col = "s_'.$dr1->sup01id.'"
                                                        name="'.$cName.'" 
                                                         readonly="readonly"
                                                        value="'.et_setFormVal( 'bri07amount', $selrec).'">
                                                    </td>';
                                            }?>
                                        <?php endif;?>
                                        	<td><span class="EstimatedTotal <?php echo 'r_'.$dr->cmp01id;?>">0</span></td>
										<td><input class="form-control color"></td>
                                    </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                 <tr>
                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr){
                                                echo '<th class="EstimatedTotal LSA center s_'.$dr->sup01id.'" rowspan="2" >0.00</th>';
                                            }?>
                                        <?php endif;?>
                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>
										<th class="Tcost center" rowspan="2">Cost in %</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>	
				</div>
				<!-- /.row -->	
                
				<!-- /.row -->		
                      
                      </div>
                    
                 <!----end fifth Bridge---->
     
                   <!----start six Bridge---->
 
                      <div class="tab-pane" id="Actual_Cost">
				<!--/.row-->
                <div class="row">
                <h3 class="form-group" style="text-align:center;">contribution of agencies</h3>
				<div class="col-lg-12 ">
              
					<div class="col-lg-4">
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar col">Total Estimated Cost</label>
									<div class="col-lg-7 marB">
									<input class="form-control height col">
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar">Actual Span</label>
									<div class="col-lg-7 marB">
									<input class="form-control height">
									</div>
								</div>
								
					</div>
					<div class="col-lg-4">
						
					</div>
					<div class="col-lg-4">
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar col">Bridge Name</label>
									<div class="col-lg-7 marB">
                                    <label><?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?></label>
		                                      
            		   							</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-5 control-label mar col">Bridge Number</label>
									<div class="col-lg-7 marB">
                                    <label><?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?></label>
						               
            		   			</div>
								</div>
								
					</div>
				</div>
				</div>
                <!-- /.row -->
<div class="row clearfix">
					<div class="col-lg-12">
						<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    
                                    <tr>
                                        <th class="cost width center" rowspan="2">Cost Components</th>
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr){
                                                echo '<th class="LSA center" rowspan="2">'.$dr->sup01sup_agency_code.'</th>';
                                            }?>
                                        <?php endif;?>
                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>
										<th class="Tcost center" rowspan="2">Cost in %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array( $arrCostCompList )): ?>
                                        <?php foreach( $arrCostCompList as $dr): ?>
                                            <?php // find the respective data of this cid and sid ?>
                                    <tr>
                                        <td class="align">
                                            <?php echo $dr->cmp01component_name;?>
                                        </td>
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr1){
                                                //query and find its data
                                                $blnFound = false;
                                                $selrec = null;
                                                if(isset($arrCstCost) && is_array( $arrCstCost)){
                                                    foreach( $arrCstCost as $k=>$v){
                                                        if( $v->bri08cmp01id == $dr->cmp01id && 
                                                            $v->bri08sup01id == $dr1->sup01id){
                                                            $selrec = $v;
                                                            $blnFound = true;
                                                          //var_dump( $selrec );
                                                            break;
                                                        }
                                                    }
                                                }
                                                $cName = 'cst_cost[C_'.$dr->cmp01id.'][S_'.$dr1->sup01id.']';
                                                echo '<td>
                                                    <input class="form-control ContributionAmt r_'.$dr->cmp01id.' s_'.$dr1->sup01id.'" 
                                                        data-row = "r_'.$dr->cmp01id.'"
                                                        data-col = "s_'.$dr1->sup01id.'"
                                                        name="'.$cName.'" 
                                                        readonly="readonly"
                                                        value="'.et_setFormVal( 'bri08amount', $selrec).'">
                                                    </td>';
                                            }?>
                                        <?php endif;?>
										<td><span class="ContributionTotal <?php echo 'r_'.$dr->cmp01id;?>">0</span></td>
										<td><input class="form-control color"></td>
                                    </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>

                                </tbody>
                                    <tr>
                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>
                                        <?php if(is_array( $arrSupList)): ?>
                                            <?php foreach( $arrSupList as $dr){
                                                echo '<th class="ContributionTotal LSA center s_'.$dr->sup01id.'" rowspan="2" >0.00</th>';
                                            }?>
                                        <?php endif;?>
                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>
										<th class="Tcost center" rowspan="2">Cost in %</th>
                                    </tr>
                            </table>
                        </div>
                    </div>	
				</div>				
				<!-- /.row -->	
                
				<!-- /.row -->		
                      
                      
                      </div>
                   
                 <!----end six Bridge---->
     
         </div>

        	</form>
    </div> <!-- /.container-fluid -->

</div> 
<style>
.col-lg-7 label {
font-weight: normal;}
</style>
  <script type="text/javascript">
$(document).ready(function()
	{
	$('.tabHeads li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
    })	
	});
</script>     
  <script type="text/javascript">
$(document).ready(function()
	{
	$('.tabHeads li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
    })	
	});
</script>    
  <script type="text/javascript">
$(document).ready(function()
	{
	$('.tabHeads li a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
    })	
	});
</script>    





<script>
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".EstimatedAmt").each(function() {
 
            $(this).keyup(function(){
                calculateSum1( $(this), 'Estimated' );
            });
        });
        $(".ContributionAmt").each(function() {
 
            $(this).keyup(function(){
                calculateSum1( $(this), 'Contribution' );
            });
        });
 
    });
    function sumNum($selector){
        sum = 0;
        $($selector).each(function() {
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
            }
        });
        return sum;

    } 
    function calculateSum1( $obj, $strRef ) {
        colId = $obj.data('col'); 
        rowId = $obj.data('row');
        x = sumNum('.'+ $strRef +'Amt.'+ colId).toFixed(2);
        y = sumNum('.'+ $strRef +'Amt.'+ rowId).toFixed(2);
        $('.'+ $strRef +'Total.'+colId).html(x);
        $('.'+ $strRef +'Total.'+rowId).html(y);
    }
    function calculateSum( ) {
        return;
    }
</script>
<script>
    $arrVDCList = <?php echo json_encode($arrVDCList);?>;
    function popCombo( $strTarget, $arrList, $strBind, $strDisp, $strSel ){
        $strRet = '';
        $.each($arrList, function(){
            $strRet += '<option value="'+this[ $strBind ] +'">' + this[$strDisp] + '</option>';
        });
        $( $strTarget ).append( $strRet );
    }
    function onChangeDistrict($targetObj, $srcSelDist){
        items = $arrVDCList.filter(function(item){
          return (item.dist01id == $srcSelDist);
        });
        $( $targetObj ).html('');
        popCombo( $targetObj, items, 'muni01id', 'muni01name');
    }
    $('.onChangeDist').on('change', function(){
        $target = $(this).data('targetvdc');
        onChangeDistrict( $target, $(this).val() );
    })
    //$arrDistList = <?php echo '';?>;
    $(document).ready(function(){
    //$("input").val(document.getElementById("bri03id").innerHTML);
        $('#bri03district_name_lb').on('change', function(){
            $('.bri03disp_name').val( $(this).val() );
        });
        $('.onChangeDist').trigger('change');
    });
    
    
</script>
