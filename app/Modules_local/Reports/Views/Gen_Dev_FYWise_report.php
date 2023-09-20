<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">

<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Gen_Dev_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />
       <!-- <input type="submit"  class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" /> -->
       <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid" id="printArea">

                <div class="row">
                    <div class="col-lg-12 mainBoard">
                        
                         
                                <h2 class="reportHeader center">List of Completed Bridges (Between <?php echo $startyear['fis01code']." - ".$endyear['fis01code']; ?>) as of <?php echo date("j F, Y");?></h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th colspan="4" class="center">Bridge</th>
                                                <th style="width:150px;" rowspan="2" class="center">River Name</th>
                                                <!-- <th style="width:80px;" rowspan="2" class="center">Palika</th> -->
                                                <th colspan="2" class="center">Walk Way Deck</th>
                                                <th rowspan="2">Topo Map sheet Number</th>
                                                <th colspan="2" class="center">Co-ordinate</th>
                                                <th rowspan="2" class="center">Major Palika</th>
                                                <th colspan="2" class="center">RM/UM</th>
                                                <th rowspan="2">Completion Date</th>
                                            </tr>
                                            <tr>
                                                <th style="width:120px;" class="center">Number</th>
                                                <th style="width:120px;" class="center">Name</th>
                                                <th style="width: 60px;" class="center">Type*</th>
                                                <th style="width:75px;" class="center">Span(m)</th> 
                                                <th style="width:120px;" class="center">Type</th>
                                                <th style="width:100px;" class="center">Width(cm)</th>
                                                <th style="width: 120px;" class="center">North</th>
                                                <th style="width: 120px;" class="center">East</th>
                                                <th style="width: 120px;" class="center">Left Bank</th>
                                                <th style="width: 120px;" class="center">Right Bank</th>    
                                            </tr>
                                        </thead>
                                   
                                                 <?php 
                        if(is_array($arrPrintList)){
                            $sum1 = 0;
                        foreach($arrPrintList as $dataRow){
                    //print_r($dataRow);
                        
                        ?>
                           <tr>
                            <td colspan="22">
                            <div class="col-lg-12" style="text-align: center; font-size: 12px;"><b><span>Province:<?php echo $dataRow['info']['province_name']; ?></span></div>
                            </td>
                           </tr>
                                 
                   
           <?php
                    if(is_array($dataRow['arrChildList'])){
                        $sum2 = 0;
                    foreach($dataRow['arrChildList'] as $dataRow2){
                  //var_dump($dataRow2);
                    
                    
                    ?>
                            <tr>
                             <td colspan="20">
                                 <div class=""><b><span>District:<?php   echo $dataRow2['info']['dist01name']; ?></span></b></div>
                             
                                 <!-- <div class=""style="float: right;"><b><span>TBSU Regional Office: <?php // echo $dataRow2['info']->tbis01name; ?></span></b></div> -->
                             </td>
                            </tr>
                                
                                
                                
                                        <tbody>
   
            <?php 
                       $i=0; foreach($dataRow2['arrChildList'] as $dataRow1){
                        if($dataRow1['info']['bri03major_vdc'] == 0)
                            $major_palika = $dataRow1['info']['left_muni01name'];
                        else
                            $major_palika = $dataRow1['info']['right_muni01name'];
                       ?>

                                            <tr>
                                                <td style="width:55px;"><?php echo $i + 1; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1['info']['bri03bridge_no']; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1['info']['bri03bridge_name']; ?></td>
                                                <td style="width:60px;"><?php echo $dataRow1['info']['bri01bridge_type_name']; ?></td>
                                                <td style="width:75px;"><?php echo $dataRow1['info']['bri03design']; ?></td>
                                                <td style="width:150px;"><?php echo $dataRow1['info']['bri03river_name']; ?></td>
                                               <!--  <td><?php //echo $major_palika; ?></td> -->
                                                <td style="width:120px;"><?php echo $dataRow1['info']['wad01walkway_deck_type_name']; ?></td>
                                                <td style="width:100px;"><?php echo $dataRow1['info']['wal01walkway_width']; ?></td>
                                                <td><?php echo $dataRow1['info']['bri03topo_map_no']; ?></td>
                                                <td><?php echo $dataRow1['info']['bri03coordinate_north']; ?></td>
                                                <td><?php echo $dataRow1['info']['bri03coordinate_east']; ?></td>
                                                <td><?php echo ($dataRow1['info']['bri03major_vdc'] == 0? $dataRow1['info']['left_muni01name']:$dataRow1['info']['right_muni01name']); ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1['info']['left_muni01name']; ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1['info']['right_muni01name']; ?></td>
                                                <td><?php echo $dataRow1['info']['bri05bridge_complete']; ?></td>
                                            </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                        <tr>
                            <td colspan="14">Total Bridge in District: <?php echo $i;?></td>
                        </tr>
                                    
                                   <?php
                        $sum2 += $i;
                      
                       } //end of dist
                        }
                        ?>
                        <tr>
                            <td colspan="14">Total Bridge in State: <?php echo $sum2;?></td>
                        </tr>
                        <?php
                        $sum1 += $sum2;
                        }
                        }
                        ?> 
                        <tr>
                            <td colspan="14">Total Bridge in All Region: <?php echo $sum1;?></td>
                        </tr>
                        </table>
                                </div>
                               
                        <div class="clear"></div>
                    </div>                           
                            
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?= $this->endSection() ?>