<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Eng_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startdate->fis01id; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $enddate->fis01id; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->
				<div class="row">
							<div class="col-lg-12">
								<p class="reportHeader center">Design and Cost Estimate</p>
                                <p class="reportHeader center">Project Status:Commited Bridges</p>
								<div class=" table-responsive">
                               
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="width:40px;" class="center" rowspan="2" >SN</th>
												<th style="width:400px;" class="center" colspan="4">Bridge</th>
												<th style="width:72px;" class="center" rowspan="2" >River Name</th>
												<th style="width:108px;" class="center" colspan="2">Walk Way Deck</th>
												<th style="width:432px;" class="center" colspan="2">Site assessment And Survey</th>
                                                <th style="width:432px;" class="center" colspan="2">Design And Estimate</th>
                                                <th style="width:432px;" class="center" colspan="2">Design Approval</th>
                                                <th style="width:72px;" class="center" rowspan="2" >Estimated Bridge Cost(NRs.)</th>
                                                <th style="width:72px;" class="center" rowspan="2" >Estimated Cost per m span(NRs.)</th>
											</tr>
											<tr>
												<th width="100px" class="center ">Number</th>
												<th width="100px" class="center">Name</th>
												<th width="100px" class="center">Type</th>
												<th width="100px" class="center rotate">Span(m)</th>	
												<th  class="center">Type**</th>
												<th  class="center rotate">Width(cm)</th>	
												<th  class="center rotate">Date</th>
												<th  class="center rotate">By(Names)</th>
												<th  class="center rotate">Date</th>
												<th  class="center rotate">By (Names)</th>
                                                <th  class="center rotate">Date</th>
                                                <th  class="center rotate">By (Names)</th>
                                            </tr>
										</thead>
								
<!-- 2nd table----------------------------------------------------------------------------------------->  
                          <?php 
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                        //var_dump($dataRow['dist']);
                        
                        ?>
                        <tbody>
                        <tr>
                        <td colspan="25">
                               <div class="col-lg-6"><b><span>District:<?php echo $dataRow['dist']->dist01name; ?></span></b></div><div class="col-lg-6"><b><span style="float:right;" >Development Region:<?php echo $dataRow['dist']->dev01name; ?></span></b></div>
								<div class="col-lg-6"><b><span>TBSU Regional Office:<?php // echo $dataRow['dist']->tbis01name; ?></span></b></div><!--<div class="col-lg-6"><b><span style="float:right;">Development Region</span></b></div>-->                    
                 
                        </td>
                        </tr>
                                         
    											                    <?php 
                        foreach($dataRow['data'] as $dataRow1){
                       //var_dump($dataRow1);
                        
                        ?>

                                                <tr>
                        								<td class="center" style="width:40px;"><?php // echo $i; ?></td>
                                                    <td class="center"><?php echo $dataRow1->bri03bridge_no; ?></td>
                    								<td class="center"><?php echo $dataRow1->bri03bridge_name; ?></td>
                    								<td class="center"><?php echo $dataRow1->bri01bridge_type_name; ?></td>
                    								<td class="center spa_<?php echo $dataRow1->bri03id;?> spa"><?php echo $dataRow1->bri03design; ?></td>
                    								<td class="center"><?php echo $dataRow1->bri03river_name; ?></td>
                    								<td class="center"><?php echo $dataRow1->wad01walkway_deck_type_name; ?></td>
                    								<td class="center"><?php echo $dataRow1->wal01walkway_width; ?></td>                                       
                                                    <td class="center"><?php echo $dataRow1->bri05site_assessment; ?></td>
                                                    <td class="center"><?php echo $dataRow1->bri06site_surveyor; ?></td>
                                                    <td class="center"><?php echo $dataRow1->bri05bridge_design_estimate; ?></td></td>
                                                    <td class="center"><?php echo $dataRow1->bri06bridge_designer; ?></td></td>
                                                    <td class="center"><?php echo $dataRow1->bri05design_approval; ?></td></td></td>
                                                    <td class="center"><?php echo $dataRow1->bri06design_approved_by; ?></td>
                                                     <td class="center est_<?php echo $dataRow1->bri03id;?> Amt"  ><?php echo $dataRow1->bri07total_sum; ?></td>
                                                     <td class="center divCalc" data-numerator=".est_<?php echo $dataRow1->bri03id;?>.Amt" data-denominator=".spa_<?php echo $dataRow1->bri03id;?>.spa">0</td> 
                                                    
                                                </tr>
                                            <?php } ?>    
                                                </tbody>
                                            
                                              <?php }}  ?>   
                                              </table>  
<!---------------------------------table3 starts-------------------------------------------------------->

                                    
 <!---footer-->  
         <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period: <?php echo $startdate->fis01year; ?> To <?php echo $enddate->fis01year; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer--> 
								</div><!--this div is in width defined below row up-->
							</div>

								</div>
						<div class="clear"></div>
				</div>
                <!-- /.row -->               
                </div>
                <?=$this->endSection();?>