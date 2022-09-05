<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12 mainBoard">
						
							<div class="col-lg-12">
								<span class="reportHeader">Overview:Progress status of Bridge(s) during FY <?php echo $startyear['fis01year']."-".$endyear['fis01year'];?> as of <?php echo date("d F, Y");?></span>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="2" class="center">Districts</th>
												<th rowspan="2" class="center">C/over from previous FY</th>
												<th rowspan="2" class="center">YPO New</th>
												<th colspan="3" class="center">New Construction</th>												
												<!-- <th colspan="2" class="center">1st Phase of Construction</th> -->
												<th colspan="2" class="center">Excavation and Local Material Collection</th>
                                                <th colspan="2" class="center">Steel parts fabrication completed</th>
												<th colspan="2" class="center">Materials handover</th>
                                                <th colspan="2" class="center">Cable pulling</th>
												<th rowspan="2" class="center">Total underconst.(active) bridges</th>	
												<th colspan="3" class="center">Bridge Completion in the FY</th>
												<th rowspan="2" class="center">Anticipated Completion</th>	
												<th rowspan="2" class="center">Expected Carryover to next FY</th>
											</tr>
												<th>Site Assessment &amp; Survey</th>
												<th>Design &amp; Estimate</th>							
												<th>Community Aggrement</th>
												<th>C/Over</th>
												<th>New</th>
												<th>C/Over</th>
												<th>New</th>
												<th>C/Over</th>
												<th>New</th>
                                                <th>C/Over</th>
                                                <th>New</th>
                                                <th>C/Over</th>
                                                <th>New</th>
												<th>Total</th>
											<tr>
											</tr>
										</thead>
								
							
							
								
								
										<tbody>
                        <?php
                        // var_dump($arrPrintList);exit;

                         $previous_carry_grand = 0;
                        $new_commit_grand = 0;
                        $site_assess_grand = 0;
                        $design_estimate_grand = 0;
                        $community_agreement_grand = 0;
                        $first_constraction_new_grand = 0;
                        $first_constraction_carry_grand = 0;
                        $material_new_grand = 0;
                        $material_carry_grand = 0;
                        $total_under_constuction_brdg_grand = 0;
                        $bridge_complete_new_grand = 0;
                        $bridge_complete_carry_grand = 0;
                        $total_complete_grand = 0;
                        $fis02name2_grand = 0;
                        $fis02name3_grand = 0;
                        $fis02name4_grand = 0;
                        $ypo_total_grand = 0;
                        $steel_new_grand = 0;
                        $steel_carry_grand = 0;
                        $cable_new_grand = 0;
                        $cable_carry_grand = 0;
						$exp_co_fy_grand = 0;

                            if(is_array($arrPrintList)){
                            foreach($arrPrintList as $k=>$dataRow){
                            $sID = str_replace('sup_','',$k);
                           
                            if( !isset( $arrsupportList[ $k ])){
                                echo '<!-- dump: ';
                                var_dump( $k );
                                var_dump( $dataRow );
                                echo '-->';
                                continue;
                            }
                            $arrSupData = $arrsupportList[ $k ];
                            
                            // var_dump($sID);                            
                        ?>

                        <tr>
                            <td colspan="22">
                            Funded Through:<?php  echo $arrSupData['sup01sup_agency_name']; ?>
                            </td>
                        </tr>          
                    <?php
                    $previous_carry_tot = 0;
                    $new_commit_tot = 0;
                    $site_assess_tot = 0;
                    $design_estimate_tot = 0;
                    $community_agreement_tot = 0;
                	$first_constraction_new_tot = 0;
                	$first_constraction_carry_tot = 0;
                	$material_new_tot = 0;
                	$material_carry_tot = 0;
                	$total_under_constuction_brdg_tot = 0;
                	$bridge_complete_new_tot = 0;
                	$bridge_complete_carry_tot = 0;
                	$total_complete_tot = 0;
                	$fis02name2_tot = 0;
                	$fis02name3_tot = 0;
                	$fis02name4_tot = 0;
                	$ypo_total_tot = 0;
                    $steel_new_tot = 0;
                    $steel_carry_tot = 0;
                    $cable_new_tot = 0;
                    $cable_carry_tot = 0;
					$exp_co_fy_tot = 0;

                   

                    foreach($dataRow as $k2=>$dataRow1){ 
                    $DistId = str_replace('dist_','',$k2);
                    $arrDistInfo = '';                   
                    if(isset($arrDistrictList[$k2])) {
                    $arrDistInfo = $arrDistrictList[$k2];

                    /* get fiscal data */					
					//$startyear->fis01year."-".$endyear->fis01year
					
                    $fiscaldata = $procumOverall->getFiscalData($sID,$arrDistInfo['dist01id'],$startyear['fis01year'], $ctype);
                   
                   	if($fiscaldata) {
                   		$fis02name1 = $fiscaldata['fis02name1']; //new committed
                   		$fis02name2 = $fiscaldata['fis02name2']; // Anticipation Completed
                   		$fis02name3 = $fiscaldata['fis02name3']; //YPO C/Over
                   		$fis02name4 = $fiscaldata['fis02name4']; //YPO New 
                   		$ypo_total = $fis02name3 + $fis02name4;
                   		$fis02carryover = $fiscaldata['fis02carryover'];
                 	} else {
                 		$fis02name1 = 0;
                   		$fis02name2 = 0;
                   		$fis02name3 = 0;
                   		$fis02name4 = 0;
                   		$ypo_total = 0;
                   		$fis02carryover = 0;
                 	}
                 } else {
                    $fis02name1 = 0;
                        $fis02name2 = 0;
                        $fis02name3 = 0;
                        $fis02name4 = 0;
                        $ypo_total = 0;
                        $fis02carryover = 0;
                 }				 								 
				  
//
                 if($arrDistInfo != '') {
                    if( $arrDistInfo !== 'dist_'  ){
                    	//
                    	$site_assess = isset( $dataRow1['site_assessmen'])? $dataRow1['site_assessmen']: 0;
                    	$design_estimate = isset( $dataRow1['design_esstimate'])? $dataRow1['design_esstimate']: 0;
                    	
                    	/* if design estimate value is greater than site assessment
                    		replace by site assessment
                    		*/
                    	if($design_estimate > $site_assess) 
                    		$design_estimate = $site_assess;

                    	$community_agreement = isset( $dataRow1['community_agreement'])? $dataRow1['community_agreement']: 0;

                    	if($community_agreement > $design_estimate) 
                    		$community_agreement = $design_estimate;

                    	//previous carry
                    	//$previous_carry = isset( $dataRow1['Previous_carry'])? $dataRow1['Previous_carry']: 0;
						$previous_carry = $fis02carryover;
						
						//previous carrry for current fy
						/*if($currentfy == $dateStart) { //current fy
							$fis02name3 = $previous_carry;
						}
						*/
						
						//Expected C/Over to nex FY
						/*if($currentfy == $dateStart) { //current fy
							$exp_co_fy = ($previous_carry + $fis02name4) - $fis02name2;
						} else {
							$exp_co_fy = $fis02name3;	
						}*/
						//$exp_co_fy = ($previous_carry + $fis02name4) - $fis02name2;
						
						
						
                    	// total under construction bridges
                    	$total_under_constuction_brdg = $community_agreement + $previous_carry;
						
						//$total_under_constuction_brdg = isset( $dataRow1['total_under_Constr'])? $dataRow1['total_under_Constr']: 0;
						

                    	//
                    	$bridge_complete_new = isset( $dataRow1['bridges_complet_total_new'])? $dataRow1['bridges_complet_total_new']: 0;
                    	$bridge_complete_carry = isset( $dataRow1['bridges_complet_total_carry'])? $dataRow1['bridges_complet_total_carry']: 0;
						//deducted new complete bridges on carryover
						$bridge_complete_carry = $bridge_complete_carry - $bridge_complete_new;
                    	$total_complete = $bridge_complete_carry + $bridge_complete_new;
						
						$exp_co_fy = $total_under_constuction_brdg - $total_complete;
						
                    	$first_constraction_new = isset( $dataRow1['first_constraction_new'])? $dataRow1['first_constraction_new']: 0;
                    	$first_constraction_carry = isset( $dataRow1['first_constraction_carry'])? $dataRow1['first_constraction_carry']: 0;
                    	$material_new = isset( $dataRow1['material_new'])? $dataRow1['material_new']: 0;
                    	$material_carry = isset( $dataRow1['material_carry'])? $dataRow1['material_carry']: 0;

                        $steel_new = isset( $dataRow1['steel_new'])? $dataRow1['steel_new']: 0;
                        $steel_carry = isset( $dataRow1['steel_carry'])? $dataRow1['steel_carry']: 0;

                        $cable_pulling_new = isset( $dataRow1['cable_pulling_new'])? $dataRow1['cable_pulling_new']: 0;
                        $cable_pulling_carry = isset( $dataRow1['cable_pulling_carry'])? $dataRow1['cable_pulling_carry']: 0;

                    	//totals                   
                    	$previous_carry_tot = $previous_carry_tot + $previous_carry;
						//$previous_carry_tot = $previous_carry_tot + $fis02name3;
                    	//$new_commit_tot = $new_commit_tot + (isset( $dataRow1['pipeline'])? $dataRow1['pipeline']: 0);
						$new_commit_tot = $new_commit_tot + $fis02name1;
                    	$site_assess_tot = $site_assess_tot + $site_assess;
                    	$design_estimate_tot = $design_estimate_tot + $design_estimate;
                    	$community_agreement_tot = $community_agreement_tot + $community_agreement;
                    	$first_constraction_new_tot = $first_constraction_new_tot + $first_constraction_new;
                    	$first_constraction_carry_tot = $first_constraction_carry_tot + $first_constraction_carry;
                    	$material_new_tot = $material_new_tot + $material_new;
                    	$material_carry_tot = $material_carry_tot + $material_carry;
                    	$total_under_constuction_brdg_tot = $total_under_constuction_brdg_tot + $total_under_constuction_brdg;
                    	$bridge_complete_new_tot = $bridge_complete_new_tot + $bridge_complete_new;
                    	$bridge_complete_carry_tot = $bridge_complete_carry_tot + $bridge_complete_carry;
                    	$total_complete_tot = $total_complete_tot + $total_complete;
                    	$fis02name2_tot = $fis02name2_tot + $fis02name2;
                    	$fis02name3_tot = $fis02name3_tot + $fis02name3;
                    	$fis02name4_tot = $fis02name4_tot + $fis02name4;
                    	$ypo_total_tot = $ypo_total_tot + $ypo_total;      
                        $steel_new_tot = $steel_new_tot + $steel_new;
                        $steel_carry_tot = $steel_carry_tot + $steel_carry;
                        $cable_new_tot = $cable_new_tot + $cable_pulling_new;
                        $cable_carry_tot = $cable_carry_tot + $cable_pulling_carry;  
						$exp_co_fy_tot = $exp_co_fy_tot + $exp_co_fy;
						


                    ?> 

                                                      
                        						<tr class="center">
												<td><?php echo $arrDistInfo['dist01name']; ?></td>												
												<td><?php echo $previous_carry; ?></td>
												<!--<td><?php //echo $fis02name3;?>-->
												<!--<td><?php //echo isset( $dataRow1['pipeline'])? $dataRow1['pipeline']: 0; ?></td>-->
												<td><?php echo $fis02name4;?></td>
												<td><?php echo $site_assess; ?></td>
												<td><?php echo $design_estimate; ?></td>
												<td><?php echo $community_agreement; ?></td>												
												<td><?php echo $first_constraction_carry; ?></td>
                                                <td><?php echo $first_constraction_new; ?></td>
                                                <td><?php echo $steel_carry; ?></td>
                                                <td><?php echo $steel_new; ?></td>
                                                <td><?php echo $material_carry; ?></td>
												<td><?php echo $material_new; ?></td>
                                                <td><?php echo $cable_pulling_carry;?></td> 
                                                <td><?php echo $cable_pulling_new;?></td>
												<td><?php echo $total_under_constuction_brdg; //$site_assess." - pc - ".$previous_carry;//echo isset( $dataRow1['total_under_Constr'])? $dataRow1['total_under_Constr']: 0; ?></td>												
												<td><?php echo $bridge_complete_carry; ?></td>
                                                <td><?php echo $bridge_complete_new; ?></td>
												<td><?php echo $total_complete;?></td>
												<td><?php echo $fis02name2;?></td>
												<td><?php echo $exp_co_fy;?></td>
											</tr>
                                            
                    <?php
                         }
                         }
                     }
                         ?>
                         <tr class="center">
                         	<td>Total</td>
                         	<td><?php echo $previous_carry_tot;?></td>
                         	<td><?php echo $fis02name4_tot;?></td>
                         	<td><?php echo $site_assess_tot;?></td>
                         	<td><?php echo $design_estimate_tot;?></td>
                         	<td><?php echo $community_agreement_tot;?></td>
							<td><?php echo $first_constraction_carry_tot;?></td>
                         	<td><?php echo $first_constraction_new_tot;?></td>
							<td><?php echo $steel_carry_tot;?></td>
                            <td><?php echo $steel_new_tot;?></td>   
							<td><?php echo $material_carry_tot;?></td>							
                         	<td><?php echo $material_new_tot;?></td>                         	
							<td><?php echo $cable_carry_tot;?></td>
                            <td><?php echo $cable_new_tot;?></td>                            
                         	<td><?php echo $total_under_constuction_brdg_tot;?></td>
                         	<td><?php echo $bridge_complete_carry_tot;?></td>
                            <td><?php echo $bridge_complete_new_tot;?></td>
                         	<td><?php echo $total_complete_tot;?></td>
                         	<td><?php echo $fis02name2_tot;?></td>
                         	<td><?php echo $exp_co_fy_tot;?></td>
                         </tr>
                         <?php   

                          //grand total
                        $previous_carry_grand = $previous_carry_tot + $previous_carry_grand;
                        $new_commit_grand = $new_commit_tot + $new_commit_grand;
                        $site_assess_grand = $site_assess_tot + $site_assess_grand;
                        $design_estimate_grand = $design_estimate_tot + $design_estimate_grand;
                        $community_agreement_grand = $community_agreement_tot + $community_agreement_grand;
                        $first_constraction_new_grand = $first_constraction_new_tot + $first_constraction_new_grand;
                        $first_constraction_carry_grand = $first_constraction_carry_tot + $first_constraction_carry_grand;
                        $material_new_grand = $material_new_tot + $material_new_grand;
                        $material_carry_grand = $material_carry_tot + $material_carry_grand;
                        $total_under_constuction_brdg_grand = $total_under_constuction_brdg_tot + $total_under_constuction_brdg_grand;
                        $bridge_complete_new_grand = $bridge_complete_new_tot + $bridge_complete_new_grand;
                        $bridge_complete_carry_grand = $bridge_complete_carry_tot + $bridge_complete_carry_grand;
                        $total_complete_grand = $total_complete_tot + $total_complete_grand;
                        $fis02name2_grand = $fis02name2_tot + $fis02name2_grand;
                        $fis02name3_grand = $fis02name3_tot + $fis02name3_grand;
                        $fis02name4_grand = $fis02name4_tot + $fis02name4_grand;
                        $ypo_total_grand = $ypo_total_tot + $ypo_total_grand;
                        $steel_new_grand = $steel_new_tot + $steel_new_grand;
                        $steel_carry_grand = $steel_carry_tot + $steel_carry_grand;
                        $cable_new_grand = $cable_new_tot + $cable_new_grand;
                        $cable_carry_grand = $cable_carry_tot + $cable_carry_grand;
						$exp_co_fy_grand = $exp_co_fy_tot + $exp_co_fy_grand;
                                              
                         }                         
                         }
                        
                      ?>	   
                      <tr class="center">
                            <td>Grand Total</td>
                            <td><?php echo $previous_carry_grand;?></td>
                            <td><?php echo $fis02name4_grand;?></td>
                            <td><?php echo $site_assess_grand;?></td>
                            <td><?php echo $design_estimate_grand;?></td>
                            <td><?php echo $community_agreement_grand;?></td>
							<td><?php echo $first_constraction_carry_grand;?></td>
                            <td><?php echo $first_constraction_new_grand;?></td>                            
							<td><?php echo $steel_carry_grand;?></td>
                            <td><?php echo $steel_new_grand;?></td>   
							<td><?php echo $material_carry_grand;?></td>							
                            <td><?php echo $material_new_grand;?></td>                            
							<td><?php echo $cable_carry_grand;?></td>
                            <td><?php echo $cable_new_grand;?></td>                            
                            <td><?php echo $total_under_constuction_brdg_grand;?></td>
                            <td><?php echo $bridge_complete_carry_grand;?></td>
                            <td><?php echo $bridge_complete_new_grand;?></td>                            
                            <td><?php echo $total_complete_grand;?></td>
                            <td><?php echo $fis02name2_grand;?></td>
                            <td><?php echo $exp_co_fy_grand;?></td>
                         </tr>  
										
										</tbody>
									</table>         				                              
								</div>  
						<!---footer-->       
						<?php include('report_footer_fy.php');?>
						<div class="clear"></div>
					</div>
				<!--mainboard ends-->		
				</div>
                <!-- /.row -->               
            </div>
            <!-- /.container-fluid -->

        </div>
		<?= $this->endSection() ?>