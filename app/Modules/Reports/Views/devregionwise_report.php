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
                                <div class="col-lg-6">
								<span class="reportHeader right">General bridge list</span>
                                </div>
                             <div class="col-lg-6 alignRight" style="margin-bottom: 5px;">
                             <a target="_blank" class="btn btn-md btn-success" href="<?php echo site_url();?>/reports/devregionwise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>?id=<?php echo $arrDevInfo;?>"><span>Print</span></a>
                              </div>                                
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="width:55px;" rowspan="2" class="center">SN</th>
												<th colspan="4" class="center">Bridge</th>
												<th style="width:150px;" rowspan="2" class="center">River Name</th>
												<th colspan="2" class="center">Walk Way Deck</th>
												<th colspan="2" class="center">VCD/Municipality</th>
											</tr>
											<tr>
												<th style="width:120px;" class="center">Number</th>
												<th style="width:120px;" class="center">Name</th>
												<th style="width: 60px;" class="center">Type*</th>
												<th style="width:75px;" class="center">Span(m)</th>	
												<th style="width:120px;" class="center">Type</th>
												<th style="width:100px;" class="center">Width(cm)</th>	
												<th style="width: 120px;" class="center">Left Bank</th>
												<th style="width: 120px;" class="center">Right Bank</th>	
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<?php if(is_array($arrPrintList)){  
							         foreach($arrPrintList as $dataRow){
                                        reset($dataRow);$first_key = key($dataRow);
                           ?>
                               	<div class="col-lg-12"><b><span>Development Region:<?php echo $dataRow[$first_key][0]->dev01name ;?></span></b></div>
							<?php foreach($dataRow as $dataRow1){ //var_dump($dataRow1); ?>   
                            
   								 <div class="col-lg-6"><b><span>District:<?php echo $dataRow1[0]->dist01name ;?></span></b></div><div class="col-lg-6"><b><span style="float:right;">TBSU Region:<?php // echo $dataRow1['info']->tbis01name ;?></span></b></div>
                         
                            <div class="table-responsive col-lg-12">
									<table class="table table-bordered table-hover">	
										<tbody>
                               <?php $i=1; foreach($dataRow1 as $dataRow2){ //var_dump($dataRow); ?>
                               
                                       	<tr>
												<td style="width:55px;"><?php echo $i;?></td>
												<td style="width:120px;"><?php echo $dataRow2->bri03bridge_no; ?></td>
												<td style="width:120px;"><?php echo $dataRow2->bri03bridge_name; ?></td>
												<td style="width:60px;"><?php echo $dataRow2->bri01bridge_type_code; ?></td>
												<td style="width:75px;"><?php echo $dataRow2->bri03design; ?></td>
												<td style="width:150px;"><?php echo $dataRow2->bri03river_name; ?></td>
												<td style="width:120px;"><?php echo $dataRow2->wad01walkway_deck_type_name; ?></td>
												<td style="width:100px;"><?php echo $dataRow2->wal01walkway_width; ?></td>
												<td style="width: 120px;"><?php echo $dataRow2->left_muni01name; ?></td>
												<td style="width: 120px;"><?php echo $dataRow2->right_muni01name; ?></td>
											</tr>
			
										<!--	<tr>
												<td style="width:55px;">11</td>
												<td style="width:120px;">61.69.01.01</td>
												<td style="width:120px;">Hadesera</td>
												<td style="width:60px;">SD</td>
												<td style="width:75px;">86</td>
												<td style="width:150px;">Lungreli Gaad</td>
												<td style="width:120px;">Steel Deck</td>
												<td style="width:100px;">70</td>
												<td style="width: 120px;">Lungra</td>
												<td>Lungra</td>
											</tr> -->
                                             <?php  $i++;} ?>
										</tbody>
									</table>
                                    
								</div>
                         
                         
                         
                             <?php } } }  ?>
                          	
							
						
						<div class="clear"></div>
                             <!---footer-->  
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->                                    

					</div>
							
				</div>
                <!-- /.row -->               
                </div>
                <!-- /.row -->

            </div>
			<?=$this->endSection();?>