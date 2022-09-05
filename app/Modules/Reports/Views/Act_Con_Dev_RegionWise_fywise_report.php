<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Act_Con_Dev_RegionWise_fywise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
       <!-- <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" /> -->
       <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" onClick="window.print();return false;" />
       </form>
   </div>
        <div class="container-fluid">
            <div class="row">
				<div class="col-lg-12 mainBoard ">
					<p class="reportHeader center">Actual Cost Contribution (Between <?php echo $startyear->fis01code." - ".$endyear->fis01code;?>)</p>
                  
					<div class=" table-responsive">                                
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="center" style="width:36px;">SN</th>
                                    <th colspan="5" class="center" style="width:390px;">Bridge</th>
                                   <th colspan="<?php echo count($arrCostCompList) ?>" class="center" style="width:480px;">Actual Contribution Commitement in NRs.</th>
                                    <th class="center" style="width:80px;" rowspan="2">Total Contribution(NRs.)</th>
                                    
                                </tr>
                                <tr>
                                    <th class="center " style="width:150px">Number</th>
                                    <th class="center" style="width:150px">Name</th>
                                    <th class="center" style="width:45px">Type</th>
                                    <th class="center" style="width:45px">Span(m)</th>
                                    <th  class="center">Width(cm)</th>
                                        
                                   
                                     <?php foreach( $arrCostCompList as $dataRow){ ?>	
										<th class="center rotate"><?php echo $dataRow->sup01sup_agency_name;?></th>
                                        <?php }?>
                                                                                                                                           
                                </tr>
                            </thead>
                    
                        <!-- 2nd table-->
                        <?php 
                        //print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                        //var_dump($dataRow);
                        if( isset($dataRow['info']) ){
                        ?>
                        <tbody class="dev_<?php echo $dataRow['info']->dev01id; ?>">
                       <tr>
                        	<td colspan="22">
   
                 	    <div class="row">
                            <div class="col-lg-6">
                               <!--  <b><span>Development Region:<?php //echo $dataRow['info']->dev01name; ?></span></b> -->
                                <b><span>State Region:<?php echo $dataRow['info']->province_name; ?></span></b>

                            </div>
                        </div>
                       </td>
                       </tr> 
                    <?php
                    if(is_array($dataRow['arrChildList'])){
                    foreach($dataRow['arrChildList'] as $dataRow2){
                  //var_dump($dataRow2);
                    
                    
                    ?>
                    <tr>
                      <td colspan="22">
                        <div class="row">
                        <div class="col-lg-6">
                                <b><span>District:<?php   echo $dataRow2['info']->dist01name; ?></span></b>
                            </div>
                            <div class="col-lg-6">
                                <b><span style="float:right;" >TBSU Regional Office:<?php echo  $dataRow2['info']->tbis01name; ?></span></b>
                            </div>
                        </div>     
                    </td>
                </tr>

					    


                       <?php 
                       //aa
                       //echo 'aaa';
                       $i=1; foreach($dataRow2['arrChildList'] as $dataRow1){
                        //var_dump($dataRow1);
                        
                        ?>

							<tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php  echo $i; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_no; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03bridge_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri01bridge_type_code; ?></td>
								<td class="center dist<?php echo $dataRow2['info']->dist01name; ?> spw"><?php echo $dataRow1['info']->bri03e_span; ?></td>
									<td class="center"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                                
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostCompList as $dataRow5){ 
                            //  print_r($dataRow5);?>
                            <td class="center bri_<?php echo $dataRow1['info']->bri03id; ?> costAmt col<?php echo $dataRow5->sup01id; ?> dev_<?php echo $dataRow['info']->dev01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ]->totalAmt: 0; ?>
                                
                                </td>
                                
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc dev_<?php echo $dataRow['info']->dev01id;?> colSumCostAmt" data-sum=".bri_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                             </td>
                            
							
							</tr>
                         
                              
						
                        <?php 
                        
                        $i++; }
                        
                        }//dist for each close
                         }//dist if close
   
                        ?>
 
                        

                           <tr>
                                <td colspan="6" class="center">Total span and cost per State </td>
                                
                                 <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center dev_<?php echo $dataRow['info']->dev01id; ?> sumCalc totalspan  Total_<?php echo $dataRow5->sup01id;?>" data-sum=".dev_<?php echo $dataRow['info']->dev01id; ?>.col<?php echo $dataRow5->sup01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc dev_<?php echo $dataRow['info']->dev01id; ?> summerytotal" data-sum=".dev_<?php echo $dataRow['info']->dev01id; ?>.colSumCostAmt"></td> 
                                 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".dev_<?php echo $dataRow['info']->dev01id; ?>.spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="6" class="center">Percentage per State</td>
                                
                                
                                                            <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center calcPerc grstotal" data-numerator=".dev_<?php echo $dataRow['info']->dev01id; ?> .totalspan.Total_<?php echo $dataRow5->sup01id;?>" data-denominator=".dev_<?php echo $dataRow['info']->dev01id; ?>.summerytotal">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".dev_<?php echo $dataRow['info']->dev01id; ?>.grstotal"></td> 
                                 
 
                                                                                  
                            </tr>
                            
                            </tbody>
                            <?php
                        
                        
                        }//if isset close
                        
                        }//printlist for each close
                        }//printlist if close
                        
                        ?>  	
								
							
                        </table> 
                         <!--table3 starts-->
                        
                        
                        
                        <!--table4starts-->
                         
                        
                  
                              
                               
                   <!---footer-->  
         <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> 

SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement 

Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period (Fiscal Year): <?php echo 

$startyear->fis01year; ?> To <?php echo $endyear->fis01year; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU 

Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 

3<span> --></div>
               </div>                           
        <!---footer-->  
				</div><!--mainBoard Ends-->													
			        <div class="clear"></div>
	        </div>
            <!-- /.row -->               
        </div>
        <!-- /.container-fluid -->
    </div>
    <?=$this->endSection();?>