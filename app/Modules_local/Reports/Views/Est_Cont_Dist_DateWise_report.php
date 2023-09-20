<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Est_Cont_Dist_DateWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
       <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid">           
				<div class="row">
					<div class="col-lg-12">
						<p class="reportHeader center">Estimated Contribution Commitment</p>
                        <p class="reportHeader center">Project Status:Commited Bridges</p>
								<div class=" table-responsive">
                                	<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="width:36px;" class="center" rowspan="3">SN</th>
												<th style="width:288px;" class="center" colspan="5">Bridge</th>
												<th style="width:108px;" class="center" colspan="<?php echo count($arrCostSuppList); ?>">Estimated Contribution Commitement in NRs.</th>
												<th style="width:72px;" class="center" rowspan="3" >Total Contribution(NRs.)</th>
                                            </tr>
											<tr>
												<th  class="center" rowspan="2">Number</th>
												<th  class="center" rowspan="2">Name</th>
												<th  class="center" rowspan="2">Type</th>
												<th  class="center rotate" rowspan="2">Span(m)</th>	
												<th  class="center" rowspan="2">Width(cm)</th>
										 <?php foreach( $arrCostSuppList as $dataRow){ ?>	
										<th class="center rotate"><?php echo $dataRow->sup01sup_agency_name;?></th>
                                        <?php }?>
                                   
                                            </tr>
                                          <!--  <tr>
                                                <th class="center">RAIDP</th>
                                                <th class="center">DRILP</th>
                                                <th class="center">RRRSDP</th>
                                                <th class="center">SWAP</th>
                                            </tr>    -->
										</thead>
									
                                <!-- 2nd table-->
                                       <?php 
                        //print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                        //var_dump($dataRow);
                        if( isset($dataRow['info']) ){
                        ?>
                    
                     <tbody class="dist_<?php echo $dataRow['info']->dist01id; ?>">
               <tr>
               <td colspan="18">
               <div class="col-lg-12"><b><span>District:<?php   echo $dataRow['info']->dist01name; ?></span></b></div>
               </td>
               </tr>
               <tr>
               <td colspan="18">
               <div class="col-lg-6"><b><span>TBSU Regional Office:<?php   echo $dataRow['info']->tbis01name; ?></span></b></div>
               <div class="col-lg-6"><b><span style="float:right;" >Development Region:<?php   echo $dataRow['info']->dev01name; ?></span></b></div>
               </td>
               </tr>
                                
                               
                                
                                <!-- 3rd table-->
                            

                       <?php 
                       //aa
                       //echo 'aaa';                       
                       $i=1; foreach($dataRow['arrChildList'] as $dataRow1){
                        //var_dump($dataRow1);
                        
                        ?>

						
                                <tr class="row<?php echo $i;?>">
                                <td class="center " style="width:40px;"><?php echo $i;?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_no; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03bridge_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri01bridge_type_code; ?></td>
								<td class="center spw"><?php echo $dataRow1['info']->bri03design; ?></td>
								<td class="center"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>   
							
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostSuppList as $dataRow5){ 
                              //print_r($dataRow1);?>
                              <td class="center costAmt  bri_<?php echo $dataRow1['info']->bri03id; ?> col<?php echo $dataRow5->sup01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ]->totalAmt: 0; ?>
                                
                                </td>
                              
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']->bri03id;?>.costAmt">0.00</label>
                             </td>
							</tr>
                         
                              
						
                        <?php 
                        
                        $i++; }
                        
                        
                        ?>
                          
                          
                           <tr>
                                <td colspan="6" class="center">Total Contribution per District </td>
                                
                                <?php
                                foreach($arrCostSuppList as $dataRow5){ ?>
                                <td class="center sumCalc total_<?php echo $dataRow5->sup01id;?> totalspan" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?>  .col<?php echo $dataRow5->sup01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?>  .colSumCostAmt"></td> 
                                    <input type="hidden" class="cntCalc totalcnt" data-cnt=".dist_<?php echo $dataRow['info']->dist01id; ?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="6" class="center">Percentage per District</td>
                                         <?php
                                foreach($arrCostSuppList as $dataRow5){ ?>
                                <td class="center calcPerc grstotal" data-numerator=".dist_<?php echo $dataRow['info']->dist01id; ?> .totalspan.total_<?php echo $dataRow5->sup01id;?>" data-denominator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summerytotal">0</td>
                                <?php } ?>
                                <td class="center sumCalc " data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?>  .grstotal"></td> 
                
                                                                                  
                            </tr>
                              	
						</tbody>	
                       
                                
                     <?php
                        
                        }//dist for each close
                        }//dist if close
                        
                      
                        }//printlist if close
                        
                        ?>            
                                 
                         </table>  
                         </div>                           
                                
                    </div>        
     <!---footer-->  
      <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period: <?php echo $startdate; ?> To <?php echo $enddate; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->     
				    <div class="clear"></div>            
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <?=$this->endSection();?>