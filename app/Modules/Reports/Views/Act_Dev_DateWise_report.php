<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <style type="text/css">
div.c10 {padding-right: 10px;}
    th.c9 {width:100px}
    th.c8 {width:45px}
    th.c7 {width:150px}
    th.c6 {width:80px;}
    th.c5 {width:480px;}
    th.c4 {width:150px;}
    th.c3 {width: 120px;}
    th.c2 {width:390px;}
    th.c1 {width:36px;}
    </style>
    <div id="page-wrapper" class="largeRpt">
        <div class="alignRight">
            <form method="post" target="_blank" action="<?php echo site_url();?>/reports/Act_Dev_DateWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>">
                <input type="hidden" name="start_date" value="<?php echo $startdate; ?>"> <input type="hidden" name="end_date" value="<?php echo $enddate; ?>"> 
                <!-- <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print"> -->
                <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" onClick="window.print();return false;" />
            </form>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mainBoard">
                   <p class="reportHeader center">Actual Bridge Cost (Between <?php echo $startdate." - ".$enddate;?>)</p>
                   <!-- <p class="reportHeader center" >Project Status:Commited Bridges</p>-->

                    <div class=" table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="center c1">SN</th>

                                    <th colspan="4" class="center c2">Bridge</th>

                                    <th rowspan="2" class="center c3">River Name</th>

                                    <th colspan="2" class="center c4">Walk Way Deck</th>

                                    <th colspan="<?php echo count($arrCostCompList); ?>" class="center c5">ComponentWise Cost in NRs.</th>

                                    <th class="center c6" rowspan="2">Total Actual Cost(NRs.)</th>

                                    <th class="center c6" rowspan="2">Actual Cost per m span(NRs.)</th>
                                </tr>

                                <tr>
                                    <th class="center c7">Number</th>

                                    <th class="center c7">Name</th>

                                    <th class="center c8">Type</th>

                                    <th class="c8">
                                        <div class="vertical-text vertical-text__inner">
                                            Span(m)
                                        </div>
                                    </th>

                                    <th class="center c9">Type</th>
                                    <th class="center c9">width(cm)</th>
                                    
                                    <?php foreach( $arrCostCompList as $dataRow){ ?>

                                    <th class="center rotate"><?php echo $dataRow->cmp01component_name;?></th><?php }?>
                                </tr>
                            </thead>
                            
        <!-- 2nd table-->
        <?php 
        if(is_array($arrPrintList)){
            foreach($arrPrintList as $dataRow){
                if( isset($dataRow['info']) ){
        ?>
            <tr>
                <td colspan="22">
                    <div class="row">
                        <div class="col-lg-6">
                            <b><span>State:<?php echo $dataRow['info']->province_name; ?></span></b>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                if (is_array($dataRow['arrChildList']))
                {
                    foreach ($dataRow['arrChildList'] as $dataRow2)
                    {
?>
                <tbody class="distRegion_<?php echo $dataRow2['info']->dist01id; ?>">
                    <tr>
                        <td colspan="22">
                            <div class="row">
                            <div class="col-lg-6">
                                    <b><span>District:<?php echo $dataRow2['info']->dist01name;?></span></b>
                                </div>
                                <div class="col-lg-6">
                                    <b><span style="float:right;" >TBSU Regional Office:<?php  echo  $dataRow2['info']->tbis01name;?></span></b>
                                </div>
                            </div>    
                        </td>
                    </tr>
                        <?php
                        $i = 1;
                        foreach ($dataRow2['arrChildList'] as $dataRow1)
                        {
                        ?>
                            <tr class="row<?php echo $i;?>">
								<td class="center" style="width:40px;"><?php echo $i;?></td>
                                <td class="center"><?php echo $dataRow1['info']->bri03bridge_no;?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03bridge_name;?></td>
								<td class="center"><?php echo $dataRow1['info']->bri01bridge_type_code;?></td>
								<td class="center spw_bri_<?php echo $dataRow1['info']->bri03id;?> spw"><?php echo $dataRow1['info']->bri03e_span;?></td>
								<td class="center"><?php echo $dataRow1['info']->bri03river_name;?></td>
								<td class="center"><?php echo $dataRow1['info']->wad01walkway_deck_type_name;?></td>
								<td class="center"><?php  echo $dataRow1['info']->wal01walkway_width;?></td>
                            <?php
                                foreach ($arrCostCompList as $dataRow5)
                                {
                            ?>
                                <td class="center costAmt bri_<?php echo $dataRow1['info']->bri03id; ?> col<?php echo $dataRow5->cmp01id;?>">
                                <?php echo isset($arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ])? $arrCostList['bri_'.$dataRow1['info']->bri03bridge_no][ 'id_' . $dataRow5->cmp01id ]->totalAmt: 0; ?>
                                
                                </td>
                            <?php
                                }
                            ?>
                            <td class="center est">
                                <label class="sumCalc colSumCostAmt" data-sum=".row<?php echo $i;?> .bri_<?php echo $dataRow1['info']->bri03id;?>.costAmt">0.00</label>
                             </td>
                            <td class="center est_per divCalc" data-numerator=".row<?php echo $i;?> .colSumCostAmt" data-denominator=".row<?php echo $i;?> .spw_bri_<?php echo $dataRow1['info']->bri03id;?>"><label>0.00</label></td>
							</tr>
                        <?php 
                        $i++;
                        }
                        ?>
                         <tr>
                                <td colspan="4" class="center">Total span and cost per </td>
                                <td class="center sumCalc summeryspan" data-sum=".distRegion_<?php

        echo $dataRow2['info']->dist01id;

?> .spw">0</td>
                                <td colspan="3" class="center"></td>
                                
                                <?php

        foreach ($arrCostCompList as $dataRow5)
        {

?>
                                <td class="center sumCalc total_<?php echo $dataRow5->cmp01id;?> totalspan" data-sum=".distRegion_<?php

            echo $dataRow2['info']->dist01id;

?> .col<?php

            echo $dataRow5->cmp01id;

?>">0</td>
                                <?php

        }

?>
                                <td class="center sumCalc summerytotal" data-sum=".distRegion_<?php

        echo $dataRow2['info']->dist01id;

?> .colSumCostAmt"></td> 
                                <td>&nbsp;</td> 
                                <input type="hidden" class="cntCalc totalcnt" data-cnt=".distRegion_<?php echo $dataRow2['info']->dist01id;?> .spw"/>
                                                                                          
                            </tr>
                            <tr>
                                <td colspan="4" class="center">Average span and cost per span</td>
                                <td class="center divCalc grsspan" data-numerator=".distRegion_<?php

        echo $dataRow2['info']->dist01id;

?> .summeryspan" data-denominator=".distRegion_<?php

        echo $dataRow2['info']->dist01id;

?> .totalcnt" >0</td>
                                <td colspan="3" class="center"></td>
                                                            <?php

        foreach ($arrCostCompList as $dataRow5)
        {

?>
                                <td class="center divCalc grstotal" data-numerator=".distRegion_<?php

            echo $dataRow2['info']->dist01id;

?> .totalspan.total_<?php echo $dataRow5->cmp01id;?>" data-denominator=".distRegion_<?php

            echo $dataRow2['info']->dist01id;

?> .summeryspan">0</td>
                                <?php

        }

?>
                               <td>&nbsp;</td>
                                <td class="center sumCalc " data-sum=".distRegion_<?php

        echo $dataRow2['info']->dist01id;

?> .grstotal"></td> 
                                 
 
                                                                                  
                            </tr> 
                </tbody>
                          <?php

    } //dist for each close

} //dist if close


                        }//if isset close
                        
                        }//printlist for each close
                        }//printlist if close
                        
                        ?> 

                            
                        </table>
                    </div>
                </div><!---main board-->
            </div><!--mainBoard Ends-->

            <div class="clear"></div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
<?=$this->endSection();?>