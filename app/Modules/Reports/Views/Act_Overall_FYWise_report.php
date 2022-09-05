<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php //echo site_url();?>reports/Act_Overall_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />       
	   <input type="button"  class="btn btn-md btn-success no-print" name="submit" value="Print" onClick="window.print();return false;" />
       </form>
   </div>

  
        <div class="container-fluid">
            <div class="row">
				<div class="col-lg-12 mainBoard">
					<p class="reportHeader center">Actual Bridge Cost (Between <?php echo $startyear['fis01code']." - ".$endyear['fis01code']; ?>) as of <?php echo date("d F, Y");?></p>
                   <!-- <p class="reportHeader center" >Project Status:Commited Bridges</p>-->
					<div class=" table-responsive">                                
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="center" style="width:36px;">SN</th>
                                    <th colspan="4" class="center" style="width:200px;">Bridge</th>
                                    <th rowspan="2" class="center" style="width: 100px;">River Name</th>
                                    <th colspan="2" class="center" style="width:100px;">Walk Way Deck</th>
                                    <th colspan="<?php echo count($arrCostCompList);?>" class="center" style="width:350px;">ComponentWise Cost in NRs.</th>
                                    <th class="center" style="width:70px;" rowspan="2">Total Actual Cost(NRs.)</th>
                                    <th class="center" style="width:70px;" rowspan="2">Actual Cost per m span(NRs.)</th>
                                </tr>
                                <tr>
                                    <th class="center " style="width:100px">Number</th>
                                    <th class="center" style="width:100px">Name</th>
                                    <th class="center" style="width:40px">Type</th>
                                     <th style="width:40px"><div class="vertical-text"><div class="vertical-text__inner">Span(m)</div></div></th>
                                        
                                    <th class="center" style="width:40px">Type</th>
                                    <th class="center" style="width:40px">Width(cm)</th>
                                     
                                     <?php foreach( $arrCostCompList as $dataRow){ ?>	
										<th class="center rotate"><?php echo $dataRow['cmp01component_name'];?></th>
                                        <?php }?>
                                                                                                                                           
                                </tr>
                            </thead>
                       
                    
                        <!-- 2nd table-->
                        <?php 
                        //print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
							$i=1;
                        foreach($arrPrintList as $k=>$dataRow){
                        //$sID = str_replace('sup_','',$k);
                       //$arrSupData = $arrsupportList[ $k ];
                       // if( isset($arrsupportList[ $k ]) ){
                        ?>
                       
               
                 	 
                    <?php
                    //if( true ){
                        //}is_array($dataRow['arrChildList'])){
                 
                        $arrDistInfo = $arrDistrictList[ $k ];
                    ?>
                    <tbody class="dist_<?php echo $arrDistInfo['dist01id']; ?>">
                <tr>
                	<td colspan="22">
                        <div class="row">
                        <div class="col-lg-6">
                                <b><span>District:<?php   echo $arrDistInfo['dist01name']; ?></span></b>
                            </div>
                            <div class="col-lg-6">
                                <b><span style="float:right;" >TBSU Regional Office:<?php  echo  $arrDistInfo['tbis01name']; ?></span></b>
                            </div>
                        </div>     
                        </td>
                    </tr>                    

					    
                    	

                       <?php 
                       //aa
                       //echo 'aaa';
                       //$i=1; 
					   foreach($dataRow as $dataRow1){
                        //var_dump($dataRow1);
                        
                        ?>

							<tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php  echo $i; ?></td>
                                <td class="center"><?php echo $dataRow1['info']['bri03bridge_no']; ?></td>
								<td class="center"><?php echo $dataRow1['info']['bri03bridge_name']; ?></td>
								<td class="center"><?php echo $dataRow1['info']['bri01bridge_type_code']; ?></td>
								<td class="center spw_bri_<?php echo $dataRow1['info']['bri03id']; ?> spw"><?php echo $dataRow1['info']['bri03e_span']; ?></td>
								<td class="center"><?php echo $dataRow1['info']['bri03river_name']; ?></td>
								<td class="center"><?php echo $dataRow1['info']['wad01walkway_deck_type_name']; ?></td>
								<td class="center"><?php echo $dataRow1['info']['wal01walkway_width']; ?></td>
                                
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostCompList as $dataRow5){ 
                            //  print_r($dataRow5);?>
                            <td class="center bri_<?php echo $dataRow1['info']['bri03id']; ?> costAmt col<?php echo $dataRow5['cmp01id'];?>">
    
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']['bri03bridge_no']][ 'id_' . $dataRow5['cmp01id'] ])? round($arrCostList['bri_'.$dataRow1['info']['bri03bridge_no']][ 'id_' . $dataRow5['cmp01id'] ]['totalAmt'],2): 0; ?>
                                </td>
                                
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']['bri03id']; ?>.costAmt">0.00</label>
                             </td>
                            <td class="center est_per divCalc" data-numerator=".row<?php echo $i;?> .colSumCostAmt" data-denominator=".row<?php echo $i;?> .spw_bri_<?php echo $dataRow1['info']['bri03id']; ?>"><label>0.00</label></td>
							
							</tr>
                         
                              
						
                        <?php 
                        
                        $i++; }
                        
                        
                        ?>
                         <tr>
                                <td colspan="4" class="center">Total span and cost</td>
                                <td class="center sumCalc summeryspan ss<?php echo $arrDistInfo['dist01id']; ?>" data-sum=".dist_<?php echo $arrDistInfo['dist01id']; ?> .spw" id="totalspancost">0</td>
                                <td colspan="3" class="center"></td>
                                
                                <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center sumCalc totalspan ts<?php echo $dataRow5['cmp01id'];?> col<?php echo $dataRow5['cmp01id'];?>" data-sum=".dist_<?php echo $arrDistInfo['dist01id']; ?> .col<?php echo $dataRow5['cmp01id'];?>" id="">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal st<?php echo $arrDistInfo['dist01id'];?>" data-sum=".dist_<?php echo $arrDistInfo['dist01id']; ?> .colSumCostAmt"></td> 
                                <td>&nbsp;</td> 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".dist_<?php echo $arrDistInfo['dist01id']; ?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per span</td>
                                <td class="center divCalc grsspan" data-numerator=".dist_<?php echo $arrDistInfo['dist01id']; ?> .summeryspan" data-denominator=".dist_<?php echo $arrDistInfo['dist01id']; ?> .totalcnt" id="averagespancost">0</td>
                                <td colspan="3" class="center"></td>
                                                            <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center divCalc av<?php echo $dataRow5['cmp01id'];?> grstotal<?php echo $dataRow5['cmp01id'];?>" data-numerator=".dist_<?php echo $arrDistInfo['dist01id']; ?> .totalspan.col<?php echo $dataRow5['cmp01id'];?>" data-denominator=".dist_<?php echo $arrDistInfo['dist01id']; ?> .summeryspan">0</td>
                                <?php } ?>
                              
                                <td>&nbsp;</td>
                                  <td class="center sumCalc sc<?php echo $dataRow5['cmp01id']; ?>" data-sum=".dist_<?php echo $arrDistInfo['dist01id']; ?> .grstotal" id="<?php echo $arrDistInfo['dist01id']; ?>"></td> 
                                                                                  
                            </tr> 	
							
                      </tbody> 
                         <?php
                        
                        }//dist for each close
                        //}//dist if close
                        
                        //}//if isset close
                        
                        }//printlist if close
                        
                        ?> 
                         <!--table3 starts-->
						 <tr>
						 <td colspan="22"><input type="hidden" name="totbridges" id="totbridges" value="<?php echo $i-1;?>" /><input type="hidden" name="actype" id="actype" value="ac" /></td>
						 </tr>
						 <!-- grand total -->
						 <tr>
                                <td colspan="4" class="center"><b>Grand Total span and cost</b> </td>
                                <td class="center sumCalc gsummeryspan boldtext">0</td>
                                <td colspan="3" class="center"></td>
                                <td class="center sumCalc totalspan gcol13 boldtext">0</td>                                
								<td class="center sumCalc totalspan gcol14 boldtext">0</td>
								<td class="center sumCalc totalspan gcol15 boldtext">0</td>
								<td class="center sumCalc totalspan gcol16 boldtext">0</td>
								<td class="center sumCalc totalspan gcol17 boldtext">0</td>
								<td class="center sumCalc totalspan gcol18 boldtext">0</td>
								<td class="center sumCalc totalspan gcol19 boldtext">0</td>
								<td class="center sumCalc totalspan gcol20 boldtext">0</td>
								<td class="center sumCalc totalspan gcol21 boldtext">0</td>
								<td class="center sumCalc totalspan gcol22 boldtext">0</td>
								<td class="center sumCalc totalspan gcol23 boldtext">0</td>
								<td class="center sumCalc totalspan gcol24 boldtext">0</td>
                                <td class="center sumCalc gsummerytotal boldtext"></td> 
                                <td>&nbsp;</td> 
                                <input type="hidden" class="cntCalc totalcnt"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center"><b>Grand Average span and cost per span</b></td>
                                <td class="center divCalc g_grsspan boldtext">0</td>
                                <td colspan="3" class="center"></td>
                                <td class="center divCalc ggrstotal13 boldtext">0</td>
								<td class="center divCalc ggrstotal14 boldtext">0</td>
								<td class="center divCalc ggrstotal15 boldtext">0</td>
								<td class="center divCalc ggrstotal16 boldtext">0</td>
								<td class="center divCalc ggrstotal17 boldtext">0</td>
								<td class="center divCalc ggrstotal18 boldtext">0</td>
								<td class="center divCalc ggrstotal19 boldtext">0</td>
								<td class="center divCalc ggrstotal20 boldtext">0</td>
								<td class="center divCalc ggrstotal21 boldtext">0</td>
								<td class="center divCalc ggrstotal22 boldtext">0</td>
								<td class="center divCalc ggrstotal23 boldtext">0</td>
								<td class="center divCalc ggrstotal24 boldtext">0</td>
								<td class="center">&nbsp;</td>                                
                                  <td class="center sumCalc gsc boldtext"></td> 
                                                                                  
                            </tr> 	
                        
                         </table> 
                        
                        <!--table4starts-->
                         
                        
                        
                 
                              
                     <!---footer-->  
         <!--<div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period: <?php //echo $startyear->fis01year; ?> To <?php //echo $endyear->fis01year; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php //echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --><!--</div>-->
               <!--</div>   -->       			   
        <!---footer-->   
				</div><!--mainBoard Ends-->													
			        <div class="clear"></div>
	        </div>
            <!-- /.row -->               
        </div>
        <!-- /.container-fluid -->
    </div>
    <?= $this->endSection() ?>