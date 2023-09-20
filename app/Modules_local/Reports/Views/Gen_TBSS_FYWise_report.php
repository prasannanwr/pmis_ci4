<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Gen_TBSS_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
       <input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid">

                <div class="row">
                  
                        
                            
                                <h2 class="reportHeader center">List of Completed Bridges (Between <?php echo $startyear->fis01code." - ".$endyear->fis01code; ?>) as of <?php echo date("j F, Y");?></h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th colspan="4" class="center">Bridge</th>
                                                <th style="width:150px;" rowspan="2" class="center">River Name</th>
                                                <th colspan="2" class="center">Walk Way Deck</th>
                                                <th rowspan="2">Topo Map sheet Number</th>
                                                <th colspan="2" class="center">Co-ordinate</th>
                                                <th colspan="2" class="center">VCD/Municipality</th>
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
                                        <tbody>

                                                 <?php 
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                    //print_r($dataRow);
                        
                        ?>
                        <tr>
                            <td colspan="22">
                                 <div class="center" style="font-size: 12px;"><b><span>TBSU Region:<?php echo $dataRow['info']->tbis01name; ?></span></div>
                   
                            </td>
                        </tr>       
           <?php
                    if(is_array($dataRow['arrChildList'])){
                    foreach($dataRow['arrChildList'] as $dataRow2){
                  //var_dump($dataRow2);
                    
                    
                    ?>
                    <tr>
                            <td colspan="22">
                                 <div class="col-lg-12" style="line-height: 18px;"><b><span>District:<?php  echo $dataRow2['info']->dist01name; ?></span></b></div>
                                <div class="col-lg-6" style="line-height: 18px;"><b><span>TBSU Region:<?php  echo $dataRow2['info']->tbis01name; ?></span></b></div><div class="col-lg-6"><b><span style="float:right;">Development Region:<?php   echo $dataRow2['info']->dev01name; ?></span></b></div>
                       </td>
                    </tr>                               
   
            <?php 
                       $i=1; foreach($dataRow2['arrChildList'] as $dataRow1){
                       ?>    
                                                           


                                            <tr>
                                                <td style="width:55px;"><?php echo $i; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1['info']->bri03bridge_no; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1['info']->bri03bridge_name; ?></td>
                                                <td style="width:60px;"><?php echo $dataRow1['info']->bri01bridge_type_name; ?></td>
                                                <td style="width:75px;"><?php echo $dataRow1['info']->bri03design; ?></td>
                                                <td style="width:150px;"><?php echo $dataRow1['info']->bri03river_name; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1['info']->wad01walkway_deck_type_name; ?></td>
                                                <td style="width:100px;"><?php echo $dataRow1['info']->wal01walkway_width; ?></td>
                                                <td><?php echo $dataRow1['info']->bri03topo_map_no; ?></td>
                                                <td><?php echo $dataRow1['info']->bri03coordinate_north; ?></td>
                                                <td><?php echo $dataRow1['info']->bri03coordinate_east; ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1['info']->left_muni01name; ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1['info']->right_muni01name; ?></td>
                                                <td><?php echo $dataRow1['info']->bri05bridge_complete; ?></td>
                                            </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                                    
                                   <?php
                      
                       } //end of dist
                        }
                        }
                        }
                        ?> 
                          </table>
                                </div>
                               
                             <!---footer-->  
         <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span>&nbsp;<span> SN=Suspension-SSTB </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;<span> RCC=Rainforced Cement Concrete</span></div>
             <div class="col-lg-4 right" style="padding-right: 10px;"><span><b>Reporting Period(Fiscal Year): <?php echo $startyear->fis01year; ?> To<?php echo $startyear->fis01year; ?></b></span></div>  
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->                                     
                                                      
                        <div class="clear"></div>
                    </div>                           
                            
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?=$this->endSection();?>