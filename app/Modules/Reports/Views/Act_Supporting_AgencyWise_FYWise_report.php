<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Act_Supporting_AgencyWise_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
       <input type="hidden" name="selAgency" value="<?php echo $selAgency;?>">
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>


        <div class="container-fluid">
            <div class="row">
				<div class="col-lg-12 mainBoard">
				<p class="reportHeader center">Actual Bridge Cost (Between <?php echo $startyear->fis01code." - ".$endyear->fis01code;?>)</p>
                <p><h4>Filter by Supporting Agency</h4>
                    <form name="frmAgencyFilter" method="post" action="<?php echo site_url();?>/reports/Act_Supporting_AgencyWise_FYWise_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>">      
                        <select name="selAgency" onchange="document.frmAgencyFilter.submit();">
                            <option value="">--Select--</option>
                            <?php                         
                            foreach($arrsupportList as $sagency) {                                              
                                ?>                            
                            <option value="<?php echo $sagency->sup01id;?>" <?php echo ($selAgency != '' && $selAgency == $sagency->sup01id)?'selected="selected"':'';?>><?php echo $sagency->sup01sup_agency_name;?></option>
                            <?php } ?>
                            <option value="all">All</option>
                        </select>    
                        <input type="hidden" name="start_year" value="<?php echo $dataStart;?>">
                        <input type="hidden" name="end_year" value="<?php echo $dateEnd;?>">                 
                    </form>
                </p>
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
                                <th class="center" style="width:100px">Width</th>
                                <?php foreach( $arrCostCompList as $dataRow){ ?>	
								<th class="center rotate"><?php echo $dataRow->cmp01component_name;?></th>
                                <?php }?>
                            </tr>
                        </thead>
                        <!-- 2nd table-->
            <?php 
            if(is_array($arrPrintList)){
                foreach($arrPrintList as $k=>$dataRow){
                    if($k == 'sup_'){
                        //print_r($dataRow);
                    }else{

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
                                $j=1;
                                foreach($dataRow['arrChildList'] as $k2=>$dataRow2){
                                    if(isset($arrDistrictList[ $k2 ])){
                                        $arrDistInfo = $arrDistrictList[ $k2 ];
                                    }else{
                                        echo '<!-- Key: '.$k2.' -->';
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
                                            <b><span style="float:right;" >TBSU Regional Office:<?php  echo  $arrDistInfo->province_name; ?></span></b>  <!--echo  $arrDistInfo->tbis01name; -->
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        <?php 
                                    $i=1; 
                                    foreach($dataRow2['arrChildList'] as $dataRow1){
                        
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
                                        foreach($arrCostCompList as $dataRow5){ 
                                ?>
                                <td class="center bri_<?php echo $dataRow1['info']->bri03id; ?> costAmt col<?php echo $dataRow5->cmp01id;?>">
                                    <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ]->totalAmt: 0; ?>
                                    
                                    </td>
                                    
                                <?php 
                                        }   //end for each costCompList
                                ?>
                                <td class="center est">
                                    <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                                </td>
                                <td class="center est_per divCalc" data-numerator=".row<?php echo $i;?> .colSumCostAmt" data-denominator=".row<?php echo $i;?> .spw_bri_<?php echo $dataRow1['info']->bri03id; ?>"><label>0.00</label></td>
							
							</tr>
                            <?php 
                                        $i++;$j++;
                                    }//end foreach childlist
                                    ?>
                                    <tr><td colspan="22" class="est">Total Bridge: <?php echo $i-1; ?></td></tr>  
                                    <?php
                                }//dist for each childlist 
                            }//dist if close
                            ?>
                            <tr>
                                <td colspan="4" class="center">Total span and cost per </td>
                                <td class="center sumCalc summeryspan" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .spw">0</td>
                                <td colspan="3" class="center"></td>
                                
                                <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center sumCalc total_<?php echo $dataRow5->cmp01id;?> totalspan" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .col<?php echo $dataRow5->cmp01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .colSumCostAmt"></td> 
                                <td class="center divCalc avgsummerytotal" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summerytotal" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summeryspan">0</td> 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".distRegion_<?php echo $arrSupData->sup01id; ?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per span</td>
                                <td class="center divCalc grsspan" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summeryspan" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .totalcnt" >0</td>
                                <td colspan="3" class="center"></td>
                                <?php foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center divCalc grstotal" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .totalspan.total_<?php echo $dataRow5->cmp01id;?>" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summeryspan">0</td>
                                <?php } ?>
                                <td class="center sumCalc " data-sum=".distRegion_<?php echo $arrSupData->sup01id; ?> .grstotal"></td> 
                                <!--td class="center divCalc avgsummerytotal" data-numerator=".distRegion_<?php echo $arrSupData->sup01id; ?> .summerytotal" data-denominator=".distRegion_<?php echo $arrSupData->sup01id; ?> .grsspan">0</td--> 
                                <td class="center" data-numerator="" data-denominator="">&nbsp;</td> 
                            </tr>  	
                        </tbody>
                        <?php
                        }//if isset close supporting
                    } //if is blank 
                    ?>
                    <tr><td colspan="22" class="est">Total Overall Bridge funded through <?php echo $arrSupData->sup01sup_agency_name;?>: <?php echo $j-1; ?></td></tr> 
                    <?php  
                }//printlist for each close
            }//printlist if close
                        ?> 
                    </table> 
                    <!---footer-->  
                    <div class="clear"></div>
                    <div class="footer_border1">
                        <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
                        <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period: <?php echo $startyear->fis01year; ?> To <?php echo $endyear->fis01year; ?></b></span></div>  
                    </div>  
                    <div class="clear"></div>                                
                	<div class="col-lg-4 right"></div>   
                    <div class="footer_border2">
                 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
                    </div>                           
                </div><!--mainBoard Ends-->													
                <div class="clear"></div>
            </div>
            <!-- /.row -->               
        </div>
        <!-- /.container-fluid -->
    </div>
    <?=$this->endSection();?>