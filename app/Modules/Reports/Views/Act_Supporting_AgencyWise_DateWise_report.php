<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Act_Supporting_AgencyWise_DateWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
       <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
       <input type="hidden" name="selAgency" value="<?php echo $selAgency;?>">
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>


        <div class="container-fluid">
            <div class="row">
				<div class="col-lg-12 mainBoard">
					<p class="reportHeader center">Actual Bridge Cost (Between <?php echo $startdate." - ".$enddate;?>)</p>
                    <p><h4>Filter by Supporting Agency</h4>
                    <form name="frmAgencyFilter" method="post" action="<?php echo site_url();?>/reports/Act_Supporting_AgencyWise_DateWise_report">      
                        <select name="selAgency" onchange="document.frmAgencyFilter.submit();">
                            <option value="">--Select--</option>
                            <?php                         
                            foreach($arrsupportList as $sagency) {                                              
                                ?>                            
                            <option value="<?php echo $sagency->sup01id;?>" <?php echo ($selAgency != '' && $selAgency == $sagency->sup01id)?'selected="selected"':'';?>><?php echo $sagency->sup01sup_agency_name;?></option>
                            <?php } ?>
                            <option value="all">All</option>
                        </select>    
                        <input type="hidden" name="start_date" value="<?php echo $dataStart;?>">
                        <input type="hidden" name="end_date" value="<?php echo $dateEnd;?>">                 
                    </form>
                </p>
                  <!--  <p class="reportHeader center" >Project Status:Commited Bridges</p>-->
					<div class=" table-responsive">                                
						<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="center" style="width:36px;">SN</th>
                                    <th colspan="4" class="center" style="width:390px;">Bridge</th>
                                    <th rowspan="2" class="center" style="width: 120px;">River Name</th>
                                    <th colspan="2" class="center" style="width:150px;">Walk Way Deck</th>
                                    <th colspan="<?php echo count($arrCostCompList); ?>" class="center" style="width:480px;">ComponentWise Cost in NRs.</th>
                                    <th class="center" style="width:80px;" rowspan="2">Total Actual Cost(NRs.)</th>
                                    <th class="center" style="width:80px;" rowspan="2">Actual Cost per m span(NRs.)</th>
                                </tr>
                                <tr>
                                    <th class="center " style="width:150px">Number</th>
                                    <th class="center" style="width:150px">Name</th>
                                    <th class="center" style="width:45px">Type</th>
                                    <th style="width:45px"><div class="vertical-text"><div class="vertical-text__inner">Span(m)</div></div></th>
                                        
                                    <th class="center" style="width:100px">Type</th>
                                    <th class="center" style="width:100px">Width(cm)</th>
                                     <?php foreach( $arrCostCompList as $dataRow){ ?>	
										<th class="center rotate"><?php echo $dataRow->cmp01component_name;?></th>
                                        <?php }?>
                                                                                                                                           
                                </tr>
                            </thead>
                      
                    

					    
                        <!-- 2nd table-->
                        <?php 
                        //print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $k=>$dataRow){
                        //$sID = str_replace('sup_','',$k);
                        //var_dump($k);
                        $arrSupData = $arrsupportList[ $k ];
                        if( isset($arrsupportList[ $k ]) ){
                        ?>
                         <tbody class="distRegion_<?php echo $arrSupData->sup01id; ?>">
                    <tr>
                	<td colspan="22">
                                   
                 	    <div class="row">
                            <div class="center" style="font-size: 12px;">
                                <b><span>Funded through :<?php echo $arrSupData->sup01sup_agency_name; ?></span></b>
                            </div>
                        </div>
                </td>
                </tr>                     	
                 
                    <?php
                    if( true ){
                        //}is_array($dataRow['arrChildList'])){
                        $j=1;
                    foreach($dataRow['arrChildList'] as $k2=>$dataRow2){
                        if(isset($arrDistrictList[ $k2 ])){
                           $arrDistInfo = $arrDistrictList[ $k2 ]; 
                        }else{
                            continue;
                        }
                        
                    ?>
                     <tr>
                	<td colspan="22">
 
                        <div class="row">
                        <div class="col-lg-6">
                                <b><span>District:<?php   echo $arrDistInfo->dist01name; ?></span></b>
                            </div>
                            <div class="col-lg-6">
                                <b><span style="float:right;" >TBSU Regional Office:<?php  echo  $arrDistInfo->tbis01name; ?></span></b>
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
								<td class="center spw_bri_<?php echo $dataRow1['info']->bri03id; ?> spw"><?php echo $dataRow1['info']->bri03e_span; ?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03river_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->wad01walkway_deck_type_name; ?></td>
								<td class="center"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                                
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostCompList as $dataRow5){ 
                            //  print_r($dataRow5);?>
                            <td class="center bri_<?php echo $dataRow1['info']->bri03id; ?> costAmt col<?php echo $dataRow5->cmp01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ]->totalAmt: 0; ?>
                                
                                </td>
                                
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                             </td>
                            <td class="center est_per divCalc" data-numerator=".row<?php echo $i;?> .colSumCostAmt" data-denominator=".row<?php echo $i;?> .spw_bri_<?php echo $dataRow1['info']->bri03id; ?>"><label>0.00</label></td>
							
							</tr>
                         
                              
						
                        <?php 
                        
                        $i++;$j++; }
                        
                        
                        ?>
                       <tr><td colspan="22" class="est">Total Bridge: <?php echo $i-1; ?></td></tr>                      
                         <?php
                        
                        }//dist for each close
                        }//dist if close ?>
                          <tr>
                                <td colspan="4" class="center">Total span and cost per Supporting </td>
                                <td class="center sumCalc summeryspan" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .spw">0</td>
                                <td colspan="3" class="center"></td>
                                
                                <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center sumCalc total_<?php echo $dataRow5->cmp01id;?> totalspan" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .col<?php echo $dataRow5->cmp01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .colSumCostAmt"></td> 
                                
                                <td>&nbsp;</td>
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".distRegion_<?php echo $arrSupData->sup01id; ?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per m</td>
                                <td class="center divCalc grsspan" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summeryspan" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .totalcnt" >0</td>
                                <td colspan="3" class="center"></td>
                                                            <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center divCalc distRegion_<?php echo $arrSupData->sup01id; ?> grstotal" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .totalspan.total_<?php echo $dataRow5->cmp01id;?>" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summeryspan">0</td>
                                <?php } ?>
                                <td>&nbsp;</td>
                                <td class="center sumCalc " data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?>.grstotal"></td> 
                                 
 
                                                                                  
                            </tr>  	
							
                        </tbody>
                        <?php
                        }else{
                            continue;
                        }//if isset close
                        ?>
                        <tr><td colspan="22" class="est">Total Overall Bridge funded through <?php echo $arrSupData->sup01sup_agency_name;?>: <?php echo $j-1; ?></td></tr>  
                        <?php
                        }//printlist for each close

                        }//printlist if close
                        
                        ?> 
                         <!--table3 starts-->
                          </table> 
                        
                        
                        <!--table4starts-->
                           
				</div><!--mainBoard Ends-->													
			        <div class="clear"></div>
	        </div>
            <!-- /.row -->               
        </div>
        <!-- /.container-fluid -->
    </div>
    <?=$this->endSection();?>