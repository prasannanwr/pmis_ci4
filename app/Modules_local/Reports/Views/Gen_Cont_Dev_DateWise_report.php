<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">
<div class="alignRight"> 
        <form method="post" action="<?php echo site_url();?>/reports/Gen_Cont_Dev_DateWise_print" target="_blank">
       <input type="hidden" name="start_date" value="<?php echo $startdate; ?>" />
       <input type="hidden" name="end_date" value="<?php echo $enddate; ?>" />
       <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
       </form>
   </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 mainBoard">
                        
                            <div class="col-lg-12">
                                <span class="reportHeader center">General bridge list</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:55px;" rowspan="2" class="center">SN</th>
                                                <th colspan="4" class="center">Government of Nepal</th>
                                                <th style="width:150px;" rowspan="2" class="center">River Name</th>
                                                <th colspan="2" class="center">Walk Way Deck</th>
                                                <th rowspan="2">Topo Map sheet Number</th>
                                                <th colspan="2" class="center">Coordinate</th>
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
                                    </table>
                                </div>
                            </div>
                                                    <?php 
                        //print_r( $arrPrintList );
                        
                        
                        if(is_array($arrPrintList)){
                        foreach($arrPrintList as $dataRow){
                        //var_dump($dataRow);
                        if( isset($dataRow['dist']) ){
                        ?>
                       <div class="col-lg-6"><b><span style="float:right;"><?php echo $dataRow['dev']->dev01name; ?></span></b></div> 
                                          <?php
                    if(is_array($dataRow['dist'])){
                    foreach($dataRow['dist'] as $dataRow2){
                   // var_dump($dataRow2);
                    
                    
                    ?>


                                <div class="col-lg-12"><b><span>District:<?php echo $dataRow2['info']->dist01name; ?></span></b></div>
                                <div class="col-lg-6"><b><span>TBSU Region:<?php // echo $dataRow2['info']->tbis01name; ?></span></b></div>
                                <div class="table-responsive col-lg-12">
                                    <table class="table table-bordered table-hover">    
                                        <tbody>
                        <?php 
                        //aa
                        
                        $i=1; foreach($dataRow2['data'] as $dataRow1){
                        //var_dump($dataRow1);
                        
                        ?>

                                            <tr>
                                                <td style="width:55px;"><?php echo $i; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1->bri03bridge_no; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1->bri03bridge_name; ?></td>
                                                <td style="width:60px;"><?php echo $dataRow1->bri01bridge_type_name; ?></td>
                                                <td style="width:75px;"><?php echo $dataRow1->bri03design; ?></td>
                                                <td style="width:150px;"><?php echo $dataRow1->bri03river_name; ?></td>
                                                <td style="width:120px;"><?php echo $dataRow1->wad01walkway_deck_type_name; ?></td>
                                                <td style="width:100px;"><?php echo $dataRow1->wal01walkway_width; ?></td>
                                                <td><?php echo $dataRow1->bri03topo_map_no; ?></td>
                                                <td><?php echo $dataRow1->bri03coordinate_north; ?></td>
                                                <td><?php echo $dataRow1->bri03coordinate_east; ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1->left_muni01name; ?></td>
                                                <td style="width: 120px;"><?php echo $dataRow1->right_muni01name; ?></td>
                                                <td><?php echo $dataRow1->bri05bridge_complete; ?></td>
                                            </tr>
                                            
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }}}}} ?>
                            <!---footer-->                                    
                               <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended-SSTB</span><span> SN=Steel Truss RCC=Rainforced Cement Concrete</span></div>
                                <div class="col-lg-4 right"><span >Reporting Period: 2/9/2010 To 2/9/2014</span></div>                                 
                                <div class="col-lg-3">2-September-2014</div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information Systerm PMIS</span></div><div class="col-lg-3 right"><span>Page 1 of 3<span></div>
                            <!---footer-->                                    
                        <div class="clear"></div>
                    </div>                           
                            
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?=$this->endSection();?>