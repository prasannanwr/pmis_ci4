<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">


<?php 
 // $this->load->model('bridge_model');

 //echo $this->bridge_model->generate_bridge_code(6);
?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12 mainBoard">
						
						
								<span class="reportHeader">Overview:Progress status of Bridge(s) during FY</span>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="2" class="center">Districts</th>
												<th rowspan="2" class="center">C/over from previous Fy</th>
												<th rowspan="2" class="center">New Commitment(Pipeline Bridges)</th>
												<th rowspan="2" class="center">Site Assessment & Survey</th>
												<th rowspan="2" class="center">Design & Estimate</th>							
												<th rowspan="2" class="center">Community Aggrement</th>
												<th colspan="2" class="center">1st Phase of Construction</th>
												<th colspan="2" class="center">Materials handover</th>
												<th rowspan="2" class="center">Total underconst.(active) bridges</th>	
												<th colspan="3" class="center">Bridge Completion in the FY</th>
												<th rowspan="2" class="center">Anticipated Completion</th>	
												<th colspan="3" class="center">YPO</th>
											</tr>
												<th>C/Over</th>
												<th>New</th>
												<th>C/Over</th>
												<th>New</th>
												<th>C/Over</th>
												<th>New</th>
												<th>Total</th>
												<th>C/Over</th>
												<th>New</th>
												<th>Total</th>
											<tr>
											</tr>
										</thead>
								
						
							
                         
	  
                             <?php 
                     // print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $k=>$dataRow){
                            $sID = str_replace('sup_','',$k);
                        if( $k !== 'sup_' && $k !== 'sup_0' ){
                            $arrSupData = $arrsupportList[ $k ];
                            //var_dump($arrSupData);
                        ?>
                        
                            
                        <tr >
                        <td colspan="22" class="center">Funded Through:<?php  echo $arrSupData->sup01sup_agency_name;  ?></td>
                       </tr>
      
                            <?php
                      
                        
                      foreach($dataRow as $k2=>$dataRow1){ 
                         //print_r($dataRow);
                       $DistId = str_replace('dist_','',$k2);
                       
                       if( $k2 !== 'dist_'  ){
                         $arrDistInfo = $arrDistrictList[$k2];
                  ?>
   
                        <tr class="dist_<?php  echo $arrDistInfo->dist01id; ?>">
												<td><?php  echo $arrDistInfo->dist01name; ?></td>												
												<td class="Pre_carry For_total_contr  "><?php  echo isset( $dataRow1['Previous_carry'])? $dataRow1['Previous_carry']: 0; ?></td>
												<td><?php  echo isset( $dataRow1['pipe_line'])? $dataRow1['pipe_line']: 0; ?></td>
												<td><?php  echo isset( $dataRow1['site_assessmen'])? $dataRow1['site_assessmen']: 0; ?></td>
												<td><?php  echo isset( $dataRow1['design_esstimate'])? $dataRow1['design_esstimate']: 0; ?></td>
												<td class="Comm_agree For_total_contr "><?php  echo isset( $dataRow1['community_agreement'])? $dataRow1['community_agreement']: 0; ?></td>
                                                <td><?php  echo isset( $dataRow1['first_constraction_new'])? $dataRow1['first_constraction_new']: 0; ?></td>
    					                         <td><?php  echo isset( $dataRow1['first_constraction_carry'])? $dataRow1['first_constraction_carry']: 0; ?></td>
    					                         <td><?php  echo isset( $dataRow1['material_new'])? $dataRow1['material_new']: 0; ?></td>
    						                     <td><?php  echo isset( $dataRow1['material_carry'])? $dataRow1['material_carry']: 0; ?></td>
    						                     <td class="sumCalc_dig " data-sum=".dist_<?php  echo $arrDistInfo->dist01id; ?> .For_total_contr">0 </td>
    						                     <td class="for_total_Bri_Compl  "><?php  echo isset( $dataRow1['bridges_complet_total_new'])? $dataRow1['bridges_complet_total_new']: 0; ?></td>
    						                    <td class="for_total_Bri_Compl "><?php  echo isset( $dataRow1['bridges_complet_total_carry'])? $dataRow1['bridges_complet_total_carry']: 0; ?></td>
    											<td class="sumCalc_dig " data-sum=".dist_<?php  echo $arrDistInfo->dist01id; ?> .for_total_Bri_Compl">0</td>
						                       <td><?php  echo isset( $dataRow1['Anticipated_Completion'])? $dataRow1['Anticipated_Completion']: 0; ?></td>
    					                       <td class="For_total_ypo"><?php  echo isset( $dataRow1['YOP_carry'])? $dataRow1['YOP_carry']: 0; ?></td>
    					                       <td class="For_total_ypo"><?php  echo isset( $dataRow1['YOP_new'])? $dataRow1['YOP_new']: 0; ?></td>
    											<td class="sumCalc_dig" data-sum=".dist_<?php  echo $arrDistInfo->dist01id; ?> .For_total_ypo">0</td>
											</tr>
                        
                        
                        <?php 
                      }else{
                            continue;
                        }//i  
                     } // $data2
                     }else{
                            continue;
                        }//i
                        } // end of foreach district
                        } // end of array arrPrintList
                        
                        
                        ?>
                </tbody>
                </table>   
                </div>      				                              
                 
                        
											
											
											
											
											
											
										
								<!---footer-->                                    
	         					<div class="pro_footer">	
								<div class="row">					
									<div class="col-lg-3">
										<span><?php echo _day(); ?></span>
									</div>
									<div class="col-lg-6 ">
										<span class="center"> Programme Monitoring and Information System(PMIS)</span>
									</div>
									<div class="col-lg-3 right">
										
									</div>
								</div>
								</div>
	        					<!---footer-->     
						
						<div class="clear"></div>
					</div>
				<!--mainboard ends-->		
				</div>
                <!-- /.row -->               
            </div>
            <!-- /.container-fluid -->

        </div>
		<?=$this->endSection();?>