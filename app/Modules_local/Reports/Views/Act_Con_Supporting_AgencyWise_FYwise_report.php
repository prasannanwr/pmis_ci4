<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt" >

    <div class="alignRight">        
        <form method="post" action="<?php echo site_url();?>/reports/Act_Con_Supporting_AgencyWise_FYwise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">            
            <input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
            <input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
            <input type="hidden" name="selAgency" value="<?php echo (isset($selAgency)?$selAgency:'');?>">
            <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12 mainBoard">
				<p class="reportHeader center">Actual Cost Contribution (Between <?php echo $startyear->fis01code." - ".$endyear->fis01code;?>)</p>
                <p>
                    <form method="post" name="frmSelect" id="frmSelect" action="<?php echo site_url();?>/reports/Act_Con_Supporting_AgencyWise_FYwise_report<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>">            
                    <h4>Filter by Supporting Agency</h4>
                        <select name="selAgency" onChange="frmSelect.submit()">
                            <option value="">--Select--</option>
                            <?php foreach( $arrCostCompList as $dataRow){ ?>
                            <option value="<?php echo $dataRow->sup01id;?>" <?php echo ($selAgency != '' && $selAgency == $dataRow->sup01id)?'selected="selected"':'';?>><?php echo $dataRow->sup01sup_agency_name;?></option>                            
                            <?php }?>   
                            <option value="all">All</option>
                        </select>
                        <input type="hidden" name="start_year" value="<?php echo (isset($dataStart)?$dataStart:'');?>">
                        <input type="hidden" name="end_year" value="<?php echo (isset($dateEnd)?$dateEnd:'');?>"> 
                    </form>
                </p>
				<div class=" table-responsive">                                
					<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="center" style="width:36px;">SN</th>
                                <th colspan="5" class="center" style="width:390px;">Bridge</th>
                                <th colspan="<?php echo count($arrCostCompList)+1 ?>" class="center" style="width:480px;">Actual Contribution Commitement in NRs.</th>
                                <th class="center" style="width:80px;" rowspan="2">Total Contribution(NRs.)</th>                                
                            </tr>
                            <tr>
                                <th class="center " style="width:150px">Number</th>
                                <th class="center" style="width:150px">Name</th>
                                <th class="center" style="width:45px">Type</th>
                                <th class="center">Span(m)</th>
                                <th class="center">Width(cm)</th>  
                                <th class="center">Walk Width(cm)</th>  
                                <?php foreach( $arrCostCompList as $dataRow){ ?>	
                                    <th class="center rotate"><?php echo $dataRow->sup01sup_agency_name;?></th>
                                <?php }?>                                                                                                      
                            </tr>
                        </thead>
                    
                        <!-- 2nd table-->
                        <?php 
                        if(is_array($arrPrintList)){
                            $t=1;
                            foreach($arrPrintList as $k=>$dataRow){
                          
                            if( isset($arrsupportList[ $k ]) ){
                              $arrSupData = $arrsupportList[ $k ];
                        ?>
                        <tbody class="sup_<?php echo $arrSupData->sup01id; ?>">
                        <tr>
                            <td colspan="22">
                                <div class="center" style="font-size: 12px;">
                                    <b><span>Funded Through:<?php echo $arrSupData->sup01sup_agency_name; ?></span></b>
                                </div>
                            </td>
                        </tr>
                    <?php
                    if( true ){
                        $j=1;
                        foreach($dataRow['arrChildList'] as $k2=>$dataRow2){
                            $arrDistInfo = $arrDistrictList[ $k2 ];
                    ?>
                        <tr>
                            <td colspan="22">
                                <div class="col-lg-6">
                                    <b><span>District:<?php   echo $arrDistInfo->dist01name; ?></span></b>
                                </div>
                                <div class="col-lg-6">
                                    <b><span style="float:right;" >TBSU Regional Office:<?php echo  $arrDistInfo->province_name; ?></span></b>
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
								<td class="center spw"><?php echo $dataRow1['info']->bri03e_span; ?></td>
                                <td class="center">0</td>
								<td class="center"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                            <?php 
                                foreach($arrCostCompList as $dataRow5){ 
                            ?>
                                <td class="center bri_<?php echo $dataRow1['info']->bri03id; ?> costAmt col<?php echo $dataRow5->sup01id;?>">
                                    <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ]->totalAmt: 0; ?>
                                </td>
                                
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                             </td>
                            
							
							</tr>
                         
                              
						
                        <?php 
                        
                        $i++;$j++;$t++; }
                        
                        ?>
                         <tr><td colspan="20">Total Bridge: <?php echo $i-1;?></td></tr>
                        
                         <?php
                        
                        }//dist for each close
                        }//dist if close
                        ?>
                        <tr><td colspan="20">Total Bridge funded through <?php echo $arrSupData->sup01sup_agency_name; ?>: <?php echo $j-1;?></td></tr>                        
                         <tr>
                                <td colspan="7" class="center">Total span and cost per supporting </td>
                                 <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center sumCalc total_<?php echo $dataRow5->sup01id;?> totalspan" data-sum=".sup_<?php echo $arrSupData->sup01id; ?> .col<?php echo $dataRow5->sup01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc summerytotal" data-sum=".sup_<?php echo $arrSupData->sup01id; ?> .colSumCostAmt"></td> 
                                 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".sup_<?php echo $arrSupData->sup01id; ?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="7" class="center">Average span and cost per m</td>
                                                             <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center calcPerc sup_<?php echo $arrSupData->sup01id; ?> grstotal" data-numerator=".sup_<?php echo $arrSupData->sup01id; ?> .totalspan.total_<?php echo $dataRow5->sup01id;?>" data-denominator=".sup_<?php echo $arrSupData->sup01id; ?> .summerytotal">0</td>
                                <?php } ?>
                                <td class="center sumCalc " data-sum=".sup_<?php echo $arrSupData->sup01id; ?>.grstotal"></td> 
                                 
 
                                                                                  
                            </tr> 
                        </tbody>

                        <?php
                        
                        }//if isset close
                        ?>
                        
                        
                       <?php
                        }//printlist for each close
                        }//printlist if close
                        
                        ?> 
                         <!--table3 starts-->
                        <tr><td colspan="20">Total Overall Bridge: <?php echo $t-1;?></td></tr>
                         	
							
                 </table>
                        
                        <!--table4starts-->
                         
                        
                        
                 
                              
                    <!---footer-->  
         <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period(Fiscal Year): <?php echo $startyear->fis01year; ?> To <?php echo $endyear->fis01year; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information System (PMIS)</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
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