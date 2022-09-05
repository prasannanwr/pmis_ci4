<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Act_Con_Munc_datewise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">           
           <input type="submit"  class="btn btn-md btn-success no-print" name="submit" value="Print" onClick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid">           
                <div class="row">
                    <div class="col-lg-12">
                        <p class="reportHeader center">Actual Cost Contribution (Between <?php echo $startyear->fis01code." - ".$endyear->fis01code;?>) as of <?php echo date("d F, Y");?></p>
                        <div class=" table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center" rowspan="2">SN</th>
                                        <th class="center" colspan="5">Bridge</th>
                                        <th class="center" colspan="<?php echo count($arrCostCompList); ?>">Actual Contribution Commitement in NRs.</th>
                                        <th class="center" colspan="2" rowspan="2" >Total Contribution(NRs.)</th>
                                    </tr>
                                    <tr>
                                        <th  class="center" >Number</th>
                                        <th  class="center" >Name</th>
                                        <th  class="center" >Type</th>
                                        <th  class="center rotate" >Span(m)</th>    
                                        <th  class="center" >Width(cm)</th>
                                      <?php foreach( $arrCostCompList as $dataRow){ ?>  
                                        <th class="center rotate"><?php echo $dataRow->sup01sup_agency_name;?></th>
                                        <?php }?>
               
                                    </tr>
                                <!--    <tr>
                                        <th class="center">RAIDP</th>
                                        <th class="center">DRILP</th>
                                        <th class="center">RRRSDP</th>
                                        <th class="center">SWAP</th>
                                    </tr>   --> 
                                </thead>
                            
                         <?php 
                          
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                            //echo "<pre>";
                        //var_dump($dataRow);exit;
                        if( isset($dataRow['info']) ){
                        ?>
                       <tbody class="dist_<?php echo $dataRow['info']->dev01id; ?>">
                    <tr>
                     <td colspan="22">
                     <div class="row">
                        <div class="col-lg-6">
                                <b><span>Palika:<?php echo $municipality[0]->muni01name; ?></span></b><br>
                                <b><span>District:<?php echo $dataRow['info']->dist01name; ?></span></b>
                            </div>
                            <div class="col-lg-6">
                                <b><span style="float:right;" >TBSU Regional Office: <?php  echo   $dataRow['info']->tbis01name; ?></span></b>
                            </div>
                        </div>
                     </td>
                    </tr>
                         
                        
                    

                       <?php 
                       //aa
                       //echo 'aaa';
                       $i=1; foreach($dataRow['arrChildList'] as $dataRow1){
                       // var_dump($dataRow1);
                        
                        ?>

                            <tr class="row<?php echo $i;?>">
                                <td class="center" style="width:40px;"><?php  echo $i; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_no; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_name; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri01bridge_type_code; ?></td>
                                <td class="center spw"><?php echo $dataRow1['info']->bri03e_span; ?></td>
                                <td class="center"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                   <?php 
                        //$dataRow['arrCostData']; 
                        foreach($arrCostCompList as $dataRow5){ 
                            //  print_r($dataRow5);?>
                                
                              <td class="center bri_<?php echo $dataRow1['info']->bri03id; ?> costAmt col<?php echo $dataRow5->sup01id; ?> dev_<?php echo $dataRow['info']->dist01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->sup01id ]->totalAmt: 0; ?>
                                
                                </td>
                                
                            <?php }?>
                            <td class="center est">
                                <label class="sumCalc dev_<?php echo $dataRow['info']->dist01id;?> colSumCostAmt" data-sum=".bri_<?php echo $dataRow1['info']->bri03id; ?>.costAmt">0.00</label>
                             </td>
                            </tr>
                         
                              
                        
                        <?php 
                        
                        $i++; }
                        
                        
                        ?>
                         

                           <tr>
                                <td colspan="6" class="center">Total span and cost per District </td>
                                
                                 <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center dev_<?php echo $dataRow['info']->dist01id; ?> sumCalc totalspan  Total_<?php echo $dataRow5->sup01id;?>" data-sum=".dev_<?php echo $dataRow['info']->dist01id; ?>.col<?php echo $dataRow5->sup01id;?>">0</td>
                                <?php } ?>
                                <td class="center sumCalc dev_<?php echo $dataRow['info']->dist01id; ?> summerytotal" data-sum=".dev_<?php echo $dataRow['info']->dist01id; ?>.colSumCostAmt"></td> 
                                 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".dev_<?php echo $dataRow['info']->dist01id; ?>.spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="6" class="center">Percentage per District</td>
                                
                                
                                                            <?php
                                foreach($arrCostCompList as $dataRow5){ ?>
                                <td class="center calcPerc dist_<?php echo $dataRow['info']->dist01id; ?> grstotal" data-numerator=".dev_<?php echo $dataRow['info']->dist01id; ?>.totalspan.Total_<?php echo $dataRow5->sup01id;?>" data-denominator=".dev_<?php echo $dataRow['info']->dist01id; ?>.summerytotal">0</td>
                                <?php } ?>
                                <td class="center sumCalc " data-sum=".dist_<?php echo $dataRow['info']->dist01id; ?>.grstotal"></td> 
                                 
 
                                                                                  
                            </tr>   
                            
                        </tbody>
                         <?php
                        
                       
                        }//if isset close
                        
                        }//printlist if close
                        }
                        ?> 
                         <!--table3 starts-->
                        
                        
                        
                        <!-- 3rd table-->
                        </table>
                      
                         
                        
                        
                    </div>                        
                        <div class="clear"></div>            
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <?=$this->endSection();?>