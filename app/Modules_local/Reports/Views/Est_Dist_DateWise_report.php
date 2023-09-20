<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Est_Dist_DateWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
       <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>
        <div class="container-fluid">
            <div class="row">
				<div class="col-lg-12 mainBoard">
					<p class="reportHeader center">Estimated Bridge Cost Details</p>
                    <p class="reportHeader center" >Project Status:Commited Bridges</p>
					<div class=" table-responsive">                                
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="center" style="width:36px;">SN</th>
                                    <th colspan="4" class="center" style="width:390px;">Bridge</th>
                                    <th rowspan="2" class="center" style="width: 120px;">River Name</th>
                                    <th colspan="2" class="center" style="width:150px;">Walk Way Deck</th>
                                    <th colspan="<?php echo count($arrCostCompList); ?>" class="center" style="width:480px;">ComponentWise Cost in NRs.</th>
                                    <th class="center" style="width:80px;" rowspan="2">Total Estimated Cost (NRs.)</th>
                                    <th class="center" style="width:80px;" rowspan="2">Estimated Cost Per m Span(NRs.)</th>
                                </tr>
                                <tr>
                                    <th class="center " style="width:150px">Number</th>
                                    <th class="center" style="width:150px">Name</th>
                                    <th class="center" style="width:45px">Type</th>
                                    <th style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Span(m)</div></div></th>
                                        
                                    <th class="center" style="width:100px">Type</th>
                                    <th class="center" style="width:100px">Width (cm) </th>
                                     <?php foreach( $arrCostCompList as $dataRow){ ?>	
										<th class="center rotate"><?php echo $dataRow->cmp01component_name;?></th>
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
                <tbody class="dist_<?php echo $dataRow['info']->dist01id; ?>"> 
              <tr>
              <td colspan="22">
              <div class="row">
                            <div class="col-lg-6">
                                <b><span>District:<?php echo $dataRow['info']->dist01name; ?></span></b>
                            </div>
                        </div>
              </td>
              </tr> 
                 	    
                    <?php
                   //if(is_array($dataRow['arrChildList'])){
                   // foreach($dataRow['arrChildList'] as $dataRow2){
                  //var_dump($dataRow2);
                     ?>
                    <tr>
                    <td colspan="22">
                    <div class="row">
                        <div class="col-lg-6">
                                <b><span>Development:<?php echo $dataRow['info']->dev01name; ?></span></b>
                            </div>
                            <div class="col-lg-6">
                                <b><span style="float:right;" >TBSU Regional Office:<?php  echo  $dataRow['info']->tbis01name; ?></span></b>
                            </div>
                        </div>
                    </td>
                    </tr>
                         
					    
                    

                       <?php 
                       //aa
                       //echo 'aaa';
                       $i=1; foreach($dataRow['arrChildList'] as $dataRow1){
                        //var_dump($dataRow1);
                        
                        ?>

							<tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php  echo $i; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_no; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03bridge_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri01bridge_type_code; ?></td>
								<td class="center spw"><?php echo $dataRow1['info']->bri03design; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03river_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->wad01walkway_deck_type_name; ?></td>
								<td class="center "><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                                
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostCompList as $dataRow5){ 
                              //print_r($dataRow1);?>
                                <td class="center costAmt dist_<?php echo $dataRow1['info']->bri03id; ?> col<?php echo $dataRow5->cmp01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ]->totalAmt: 0; ?>
                                
                                </td>
                            <?php }?>
                             <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .dist_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                             </td>
                            <td class="center est_per calcPerc" data-numerator=".row<?php echo $i;?> .colSumCostAmt" data-denominator=".row<?php echo $i;?> .spw"><label>0.00</label></td>
							</tr>
                        <?php 
                        $i++; }
                        ?>
                          	
							
                        
                         <?php
                        
                       // }//dist for each close
                        //}//dist if close
                      ?>
                      <tr>
                                <td colspan="4" class="center">Total span and cost per district</td>
                                <td class="center sumCalc summeryspan" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?> .spw">0</td>
                                <td colspan="3" class="center"></td>
                                
                                <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center sumCalc total_col<?php echo $dataRow5->cmp01id;?> totalspan" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?> .col<?php echo $dataRow5->cmp01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?> .colSumCostAmt"></td> 
                                <td class="center divCalc avgsummerytotal" data-numerator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summerytotal" data-denominator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summeryspan">0</td> 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".dist_<?php echo $dataRow['info']->dist01id; ?>  .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per span</td>
                                <td class="center divCalc grsspan" data-numerator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summeryspan" data-denominator=".dist_<?php echo $dataRow['info']->dist01id; ?> .totalcnt" >0</td>
                                <td colspan="3" class="center"></td>
                                                            <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center divCalc grstotal" data-numerator=".dist_<?php echo $dataRow['info']->dist01id; ?> .total_col<?php echo $dataRow5->cmp01id;?>.totalspan" data-denominator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summeryspan">0</td>
                                <?php } ?>
                                 <td class="center sumCalc summerytotal" data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?> .grstotal"></td> 
                                <td class="center divCalc avgsummerytotal" data-numerator=".dist_<?php echo $dataRow['info']->dist01id; ?> .summerytotal" data-denominator=".dist_<?php echo $dataRow['info']->dist01id; ?> .grsspan">0</td> 
 
                                                                                  
                            </tr> 
                        </tbody>
                          <?php
                        }//if isset close
                        
                        }//printlist for each close
                        }//printlist if close
                        
                        ?> 
                        </table> 
                         
                        
                        
                  
                              

                         
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
                    
				</div><!--mainBoard Ends-->													
			        <div class="clear"></div>
	        </div>
            <!-- /.row -->               
        </div>
        <!-- /.container-fluid -->
    </div>
    </div>
    <?=$this->endSection();?>