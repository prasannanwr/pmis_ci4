<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<!-- <div id="page-wrapper" class="largeRpt"> -->
<div id="page-wrapper" class="">	
<?php // var_dump($arrsdistrictwise) ; ?>
            <div class="container-fluid" >

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12 mainBoard">
						
							<div class="col-lg-12">
                              <div class="col-lg-10">
                              <h4 class="reportHeader center">List of Commited Bridges</h4>
                              </div>
                             <div class="col-lg-2 alignRight">
                             <a target="_blank" class="btn btn-md btn-success" href="<?php echo site_url();?>/reports/districtwise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>?id=<?php echo $arrDevInfo->dist01id;?>"><span>Print</span></a>
                              </div>
                              </div>
								
                                
								<div class="col-lg-12 table-responsive footer_border11">
									<table class="table table-bordered table-hover tblWid" >
										<thead>
											<tr>
												<th style="width:30px;" rowspan="2" class="center">SN</th>
												<th colspan="4" class="center">Bridge</th>
												<th style="width:175px;" rowspan="2" class="center">River Name</th>
												<th colspan="2" class="center">Walk Way Deck</th>
												<th colspan="2" class="center">VCD/Municipality</th>
											</tr>
											<tr>
												<th style="width:100px;" class="center">Number</th>
												<th style="width:250px;" class="center">Name</th>
												<th style="width: 30px;" class="center">Type*</th>
												<th style="width:30px;" class="center">Span(m)</th>	
												<th style="width:60px;" class="center">Type</th>
												<th style="width:30px;" class="center">Width(cm)</th>	
												<th style="width: 140px;" class="center">Left Bank</th>
												<th style="width: 140px;" class="center">Right Bank</th>	
											</tr>
										</thead>
								<tr>
                                	<td colspan="22">
								<div class="col-lg-12"><b><span>District: <?php echo $arrDevInfo->dist01name;?></span></b></div>
								<div class="col-lg-6"><b><span>TBSU Region:<?php // echo $arrDevInfo->tbis01name;?></span></b></div><div class="col-lg-6"><b><span style="float:right;">Development Region: <?php  echo $arrDevInfo->dev01name;?></span></b></div>                                    
                                    </td>
                                </tr>
                            

								
									
							<?php $i=1; if(is_array($arrsDataList)){ ?>
                               <?php foreach($arrsDataList as $dataRow){ //print_r($dataRow); ?>
											<tr>
												<td style="width:30px;"><?php echo $i;?></td>
												<td style="width:100px;"><?php echo $dataRow->bri03bridge_no; ?></td>
												<td style="width:250px;"><?php echo $dataRow->bri03bridge_name; ?></td>
												<td style="width:30px;"><?php echo $dataRow->bri01bridge_type_code; ?></td>
												<td style="width:30px;"><?php echo $dataRow->bri03design; ?></td>
												<td style="width:175px;"><?php echo $dataRow->bri03river_name; ?></td>
												<td style="width:60px;"><?php echo $dataRow->wad01walkway_deck_type_name; ?></td>
												<td style="width:30px;"><?php echo $dataRow->wal01walkway_width; ?></td>
												<td style="width: 140px;"><?php echo $dataRow->left_muni01name; ?></td>
												<td style="width: 140px;"><?php echo $dataRow->right_muni01name; ?></td>
											</tr>
                              <?php $i++;}  } ?>
                              <tr><td colspan="10">Total bridges: <?php echo $i-1;?></td></tr>
										
										
									</table>
                                    </div> 
         <!---footer-->  
         <div class="">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->                                     
								</div>
							
						
						<div class="clear"></div>
					</div>
							
				</div>
                <!-- /.row -->               
                </div>
                <!-- /.row -->

            </div>
			<?=$this->endSection();?>