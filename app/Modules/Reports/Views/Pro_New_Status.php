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
						
							
								<span class="reportHeader">Overview:Progress status of New Bridge(s) during FY</span>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="120px" class="center">Districts</th>
												<th width="130px" class="center">New Commit.Pipeline Bridges</th>
												<th width="130px" class="center">Site Assessment & Survey</th>
												<th width="100px" class="center">Design & Estimate</th>
												<th width="100px" class="center">Community Aggrement</th>
												<th width="100px" class="center">1st Phase of Construction</th>
												<th width="100px" class="center">Materials handover</th>
												<th width="130px" class="center">Bridge Completion in the FY</th>				
												<th width="100px" class="center">YPO New</th>
											</tr>																		
										</thead>
									
							
							
								
                                    
                           <tbody>
                        <?php
                            if(is_array($arrPrintList)){
                            foreach($arrPrintList as $k=>$dataRow){
                            $sID = str_replace('sup_','',$k);
                            $arrSupData = $arrsupportList[ $k ];
                            
                            // var_dump($dataRow);
                        ?>

                            <tr>
                                 <td colspan="22" class="center">Funded Through: <?php  echo $arrSupData->sup01sup_agency_name; ?></td>
                            </tr>    
                    <?php
                    foreach($dataRow as $k2=>$dataRow1){ 
                    $DistId = str_replace('dist_','',$k2);
                    $arrDistInfo = $arrDistrictList[$k2];
                    if( $arrDistInfo !== 'dist_'  ){
                    ?> 
											<tr>
												<td width="120px"><?php  echo $arrDistInfo->dist01name; ?></td>												
												<td width="130px" class="pipeline"><?php  echo isset( $dataRow1['pipeline'])? $dataRow1['pipeline']: 0; ?></td>
												<td width="130px" class="site_assessmen"><?php  echo isset( $dataRow1['site_assessmen'])? $dataRow1['site_assessmen']: 0; ?></td>
												<td width="100px" class="design_esstimate"><?php  echo isset( $dataRow1['design_esstimate'])? $dataRow1['design_esstimate']: 0; ?></td>
												<td width="100px" class="community_agreement"><?php  echo isset( $dataRow1['community_agreement'])? $dataRow1['community_agreement']: 0; ?></td>
												<td width="100px" class="first_constraction"><?php  echo isset( $dataRow1['first_constraction'])? $dataRow1['first_constraction']: 0; ?></td>
												<td width="100px" class="material"><?php  echo isset( $dataRow1['material'])? $dataRow1['material']: 0; ?></td>
												<td width="130px" class="complet"><?php  echo isset( $dataRow1['complet'])? $dataRow1['complet']: 0; ?></td>
												<td width="100px" class="ypo">0</td>
											</tr>
					<?php
                         }
                         }
                         }
                         }
                      ?>																	
									
									
										<tr>																	
											<td width="120px"><b>Grand Total</b></td>
											<td width="130px" class=" sumCalc" data-sum=".pipeline" >0</td>
											<td width="130px" class=" sumCalc" data-sum=".site_assessmen">0</td>
											<td width="100px" class=" sumCalc" data-sum=".design_esstimate">0</td>
											<td width="100px" class=" sumCalc" data-sum=".community_agreement">0</td>
											<td width="100px" class=" sumCalc" data-sum=".first_constraction">0</td>
											<td width="100px" class=" sumCalc" data-sum=".material">0</td>
											<td width="130px" class=" sumCalc" data-sum=".complet">0</td>
											<td width="100px" class=" sumCalc" data-sum=".ypo">0</td>
										</tr>
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