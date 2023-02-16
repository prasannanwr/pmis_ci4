<?= $this->extend("\Modules\Reports\Views\layouts\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
    <div>
        <div class="alignRight noPrint" style="float:right">
            <form method="post" action="<?php //echo site_url();
                                        ?>reports/Gen_Overall_FYWise_print<?php //echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; 
                                                                            ?>" target="_blank">
                <input type="hidden" name="start_year" value="<?php echo $startyear['fis01id']; ?>" />
                <input type="hidden" name="end_year" value="<?php echo $endyear['fis01id']; ?>" />
                <input type="button" class="btn btn-md btn-success no-print" name="submit" value="Print" id="cmdPrint" onClick="window.print();return false;" />
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mainBoard">


                <h2 class="reportHeader center">List of Completed Bridges (Between <?php echo $startyear['fis01code'] . " - " . $endyear['fis01code']; ?>) as of <?php echo date("j F, Y"); ?></h2>
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
                        $i = 1;
                        //if(is_array($arrPrintList)){
                        foreach ($arrPrintList as $dataRow) {
                            //echo "<pre>";
                            //var_dump($dataRow);
                            //exit;
                        ?>
                            <tr>
                                <td colspan="22" style="line-height: 18px;">
                                    <div class="col-lg-12"><b><span>District:<?php echo $dataRow['dist']['dist01name']; ?></span></b></div>
                                    <div class="col-lg-6"><b><span><!--TBSU Region:<?php  //echo $dataRow['dist']->tbis01name;  
                                                                                ?>-->&nbsp;</span></b></div>
                                    <div class="col-lg-6"><b><span style="float:right;">State:<?php //echo $dataRow['dist'];  ?></span></b></div>

                                </td>
                            </tr>

                            <tbody>
                                <?php
                                $j = 1;
                                //echo "<pre>";
                                //var_dump($dataRow['data']);
                                //exit;
                                foreach ($dataRow['data'] as $dataRow1) {
                                    //                                     var_dump($dataRow1);
                                    // exit;
                                ?>

                                    <tr>
                                        <td style="width:55px;"><?php echo $i; ?></td>
                                        <td style="width:120px;"><?php echo $dataRow1['bri03bridge_no'] ?></td>
                                        <td style="width:120px;"><?php echo $dataRow1['bri03bridge_name'] ?></td>
                                        <td style="width:60px;"><?php echo $dataRow1['bri01bridge_type_name'] ?></td>
                                        <td style="width:75px;"><?php echo $dataRow1['bri03design'] ?></td>
                                        <td style="width:150px;"><?php echo $dataRow1['bri03river_name'] ?></td>
                                        <td style="width:120px;"><?php echo $dataRow1['wad01walkway_deck_type_name'] ?></td>
                                        <td style="width:100px;"><?php echo $dataRow1['wal01walkway_width'] ?></td>
                                        <td><?php echo $dataRow1['bri03topo_map_no'] ?></td>
                                        <td><?php echo $dataRow1['bri03coordinate_north'] ?></td>
                                        <td><?php echo $dataRow1['bri03coordinate_east'] ?></td>
                                        <td><?php echo ($dataRow1['bri03major_vdc'] == 0? $dataRow1['left_muni01name']:$dataRow1['right_muni01name']); ?></td>
                                        <td style="width: 120px;"><?php echo $dataRow1['left_muni01name'] ?></td>
                                        <td style="width: 120px;"><?php echo $dataRow1['right_muni01name'] ?></td>
                                        <td><?php echo $dataRow1['bri05bridge_complete'] ?></td>
                                    </tr>
                                <?php $i++;
                                    $j++;
                                } ?>
                            </tbody>
                            <tr>
                                <td colspan="15"><strong>Total bridge in district: <?php echo $j - 1; ?></strong></td>
                            </tr>

                        <?php } //}
                        ?>
                        <tr>
                            <td colspan="15"><strong>Total overall completed: <?php echo $i - 1; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </div>

</div>


<script>
    $(document).ready(function() {
        $('#cmdPrint').on('click', function(e) {
            e.preventDefault();
            window.print();return false;
        })

    });
</script>
<?= $this->endSection() ?>