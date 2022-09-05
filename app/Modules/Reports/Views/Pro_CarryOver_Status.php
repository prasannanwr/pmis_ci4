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
						
							<div class="col-lg-12">
								<span class="reportHeader">Overview:Progress status of Carry-Over Bridge(s) during FY</span>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="150px" class="center">Districts</th>
												<th width="150px" class="center">C/over from previous</th>
												<th width="150px" class="center">1st Phase of Construction</th>
												<th width="150px" class="center">Materials handover</th>
												<th width="150px" class="center">Bridge Completion in the FY</th>			
												<th width="150px" class="center">YPO C/Over</th>
											</tr>																		
										</thead>
									</table>
								</div>
							</div>
      
							
								
								<div class="table-responsive col-lg-12">
									<table class="table table-bordered table-hover">	
						
                        
                        				<tbody>
                        <?php
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $k=>$dataRow){
                        $sID = str_replace('sup_','',$k);
                        $arrSupData = $arrsupportList[ $k ];
                        
                        // var_dump($dataRow);
                        ?>

                        <tr  >
                        <td colspan="22" class="center">Funded Through: <?php  echo $arrSupData->sup01sup_agency_name; ?></td>
                       </tr>    
                            <?php
                      
                        
                      foreach($dataRow as $k2=>$dataRow1){ 
                       $DistId = str_replace('dist_','',$k2);
                        $arrDistInfo = $arrDistrictList[$k2];
                       if( $arrDistInfo !== 'dist_'  ){
                    ?>
											<tr>
												<td width="150px"><?php  echo $arrDistInfo->dist01name; ?></td>												
												<td width="150px"><?php  echo isset( $dataRow1['carry_from'])? $dataRow1['carry_from']: 0; ?></td>
												<td width="150px"><?php  echo isset( $dataRow1['first_Phase'])? $dataRow1['first_Phase']: 0; ?></td>
												<td width="150px"><?php  echo isset( $dataRow1['material'])? $dataRow1['material']: 0; ?></td>
												<td width="150px"><?php  echo isset( $dataRow1['complet'])? $dataRow1['complet']: 0; ?></td>
												<td width="150px">0</td>
                                                </tr>
									<?php
                                     }
                                     }
                                     }
                                     }
                                     ?>		
																					
										</tbody>
									</table>         				                              
								</div>
								<div class="table-responsive col-lg-12">
									<table class="table table-bordered table-hover">
										<tr>
											<td width="150px"><b>Grand Total</b></td>
											<td width="150px">0</td>
											<td width="150px">0</td>
											<td width="150px">0</td>
											<td width="150px">0</td>
											<td width="150px">0</td>
										</tr>
									</table>
								</div>
								<!---footer-->                                    
	         					<div class="">	
								<div class="row">					
									<div class="col-lg-3">
										<span>02-September-2014</span>
									</div>
									<div class="col-lg-6 ">
										<span class="center"> Programme Monitoring and Information System(PMIS)</span>
									</div>
									<div class="col-lg-3 right">
										<span>Page 1 of 1</span>
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