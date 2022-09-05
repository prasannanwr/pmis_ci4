<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12 mainBoard">
						<!--<p class="reportHeader center">Bridge</p>-->
                        		<p class="reportHeader center">Under Construction Bridges</p>
                  
                    <?php
                    //var_dump($municipality);exit;
                    if(is_array($arrPrintList)){
                    foreach($arrPrintList as $dataRow){
                     //   echo "<pre>";
                   // var_dump($dataRow);exit;
                    
                    ?>

								<div class="col-lg-6"><b><span>District: <?php echo $dataRow['dist']->dist01name;  ?></span></b></div><div class="col-lg-6"><b><span style="float:right;" >Status as of <?php echo _day(); ?></span></b></div>
                        		<div class="col-lg-6"><b><span>Palika:&nbsp;</span><span class="bold "> <?php echo $municipality[0]->muni01name;  ?></span></b></div>

								
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="2" class="center">SN</th>
												<th colspan="4" class="center">Bridge</th>
												<th colspan="2" class="center">Walk Way</th>
                                                <th colspan="11" class="center">Implementation Dates</th>
                                                <th rowspan="2" style="width:45px">
                                                <div class="vertical-text"></div>
                                                <div class="vertical-text__inner">Deviation in Construction Period</div></th>
											</tr>
												<th>Number</th>
												<th>Name</th>
												<th>Type</th>
												<th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Span(m)</div></div></th>
												<th>Type**</th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Width(Cm)</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Site Assessment And Survey</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Community Agrement</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">DMBT</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">1st phase of construction</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Material Supplied to UC</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">2nd Phase of Construction</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Anchorage Concreating</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Cable Pulling</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Bridge Completion</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">BMC Formation</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Target Completion</div></div></th>
                                                
											<tr>
											</tr>
										</thead>
                                       </div>
							         
                              <tr>
                              <td colspan="22" class=" reportSubHeader mrgBtm "><span class="col-lg-12 border backColor center">Completed Bridges </span> </td>
                              </tr>
					
    
									
							
							
								
										<tbody>
                         <?php 
                        $i= 1; foreach($dataRow['data'] as $dataRow1){
                      // print_r($dataRow1);
					//  if(isset($tbsu_regional_off->tbis01name)) {
                        
                        ?>
     
											<tr class="dist_<?php echo $dataRow1->bri03bridge_name;  ?>">
                                               <td><?php echo $i; ?></td>
												<td><?php echo $dataRow1->bri03bridge_no; ?></td>												
												<td><?php echo $dataRow1->bri03bridge_name; ?></td>
												<td><?php echo $dataRow1->bri01bridge_type_code; ?></td>
												<td><?php echo $dataRow1->bri03design; ?></td>
												<td><?php echo $dataRow1->wad01walkway_deck_type_name; ?></td>
												<td><?php echo $dataRow1->wal01walkway_width; ?></td>
												<td><?php echo ($dataRow1->bri05site_assessment != '0000-00-00')?$dataRow1->bri05site_assessment:''; ?></td>
												<td><?php echo ($dataRow1->bri05community_agreement != '0000-00-00')?$dataRow1->bri05community_agreement:''; ?></td>
												<td><?php echo ($dataRow1->bri05dmbt != '0000-00-00')?$dataRow1->bri05dmbt:''; ?></td>
												<td><?php echo ($dataRow1->bri05first_phase_constrution != '0000-00-00')?$dataRow1->bri05first_phase_constrution:''; ?></td>												
												<td><?php echo ($dataRow1->bri05material_supply_uc != '0000-00-00')?$dataRow1->bri05material_supply_uc:''; ?></td>
												<td><?php echo ($dataRow1->bri05second_phase_construction != '0000-00-00')?$dataRow1->bri05second_phase_construction:''; ?></td>
												<td><?php echo ($dataRow1->bri05anchorage_concreting != '0000-00-00')?$dataRow1->bri05anchorage_concreting:''; ?></td>
												<td><?php echo ($dataRow1->bri05cable_pulling != '0000-00-00')?$dataRow1->bri05cable_pulling:''; ?></td>
												<td class="Compl_date"><?php echo ($dataRow1->bri05bridge_complete != '0000-00-00')?$dataRow1->bri05bridge_complete:''; ?></td>
												<td><?php echo ($dataRow1->bri05bmc_formation != '0000-00-00')?$dataRow1->bri05bmc_formation:''; ?></td>
												<td class="Target_date"><?php echo ($dataRow1->bri05bridge_completion_target != '0000-00-00')?$dataRow1->bri05bridge_completion_target:''; ?></td>
											
                                                <td class="subStraCalc_dig" data-subt_first= ".dist_<?php echo $dataRow1->bri03bridge_name;  ?> .Target_date" data-subt_second=".dist_<?php echo $dataRow1->bri03bridge_name;  ?> .Compl_date" >0</td>
											</tr>
						<?php $i++; } //} ?>
                                               <tr>
                                                <td colspan="14"><strong>Total completed: <?php echo $i-1; ?></strong></td>                                               
                                            </tr>                                                         
										</tbody>
									</table>         				                              
							<?php  }} else {  ?>        
							 
							 <div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="2" class="center">SN</th>
												<th colspan="4" class="center">Bridge</th>
												<th colspan="2" class="center">Walk Way</th>
                                                <th colspan="11" class="center">Implementation Dates</th>
                                                <th rowspan="2" style="width:45px">
                                                <div class="vertical-text"></div>
                                                <div class="vertical-text__inner">Deviation in Construction Period</div></th>
											</tr>
												<th>Number</th>
												<th>Name</th>
												<th>Type</th>
												<th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Span(m)</div></div></th>
												<th>Type**</th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Width(Cm)</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Site Assessment And Survey</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Community Agrement</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">DMBT</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">1st phase of construction</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Material Supplied to UC</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">2nd Phase of Construction</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Anchorage Concreating</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Cable Pulling</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Bridge Completion</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">BMC Formation</div></div></th>
                                                <th  style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Target Completion</div></div></th>
                                                
											<tr>
											</tr>
										</thead>
                                       </div>
							         
                              <tr>
                              <td colspan="22" class=" reportSubHeader mrgBtm "><span class="col-lg-12 border backColor center">Completed Bridges </span> </td>
                              </tr>
								
										<tbody>   
											<tr>
                                               <td>&nbsp;</td>
												<td>&nbsp;</td>												
												<td colspan="17">No records found.</td>                                    											
											</tr>
											</tbody>
											</table>
											
							<?php } ?>
                            <!--last foot-->                                
						 </div>
								</div>
						<div class="clear"></div>
					</div>
				<!--mainboard ends-->	
                	
				</div>
                <!-- /.row --> 
                              
                <div class="pro_footer" style="width: 100%;">
                <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended</span><span> <span>SN=Suspension</span> ST=Steel Truss </span></div>
                <!--<div class="col-lg-4 right"><span>Bridge Completion During:2/9/2010 To 2/9/2014</span></div>     -->                       	
                <div class="row">					
                
                <div class="col-lg-4 ">
                
                <span class="center"> Programme Monitoring and Information System (PMIS)</span>
                </div>
                <div class="col-lg-4 right">
                <span>Page 1 of 1</span>
                </div>
                </div>
                </div>
				<?=$this->endSection();?>