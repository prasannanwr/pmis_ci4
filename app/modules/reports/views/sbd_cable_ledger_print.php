<div id="page-wrapper" class="largeRpt">    
    <div class="container-fluid">
        <div class="row">
        
            <div class="col-lg-12 mainBoard">
            
                <p class="center">नेपाल सरकार</p>
                <p class="center">संघीय मामिला तथा सामान्य प्रशासन मन्त्रालय</p>
                <p class="center">स्थानीय पूर्वाधार विभाग</p>
                <p class="center">झोलुङ्गे पुल क्षेत्रगत कार्यक्रम </p>
                <h3 class="center">लठ्ठाको आम्दानी खर्च विवरण </h3>

                <?php
                if($arrCableList) {
                    $j = 1;
                    // $total_purchased = 0;
                    // $total_release = 0;
                    // $total_existing = 0;
                    // echo "<pre>";
                    // var_dump($arrCableList);exit;
                    foreach ($arrCableList as $list) {
                        //var_dump($list[0]['data']->diametername);exit;
                        $i=1;
                        $receiptInfo = $list[0]['data'];   
                        $total_purchased = 0;
                        $total_release = 0;
                        $total_existing = 0;                                         

                        ?>
                        <div class=" table-responsive">                        
                            <div class="col-lg-3"><b>लठ्ठाको मोटाइ :</b> <?php echo $receiptInfo->diametername; ?>mm</div><br>
                            <?php foreach($list as $lot) {
                                //var_dump($lot);exit;
                                $lotinfo = $lot['data'];
                                $purchased_units = $lotinfo->units;
                                $existing_units = $purchased_units; 
                            ?>
                          <div class="col-lg-12 alignRight"><p class="right"><b>लठ्ठाको रील नम्बर :</b><?php echo $lotinfo->lot; ?></p></div>
                            <table class="table table-bordered table-hover" style="" align="center">
                                <thead>
                                <tr>
                                    <th class="center c1">क्र.सं</th>
                                    <th class="center c2">मिति</th>
                                    <th class="center c4">प्राप्त गरेको</th>
                                    <th class="center c4">हस्तान्तरण नम्बर</th>
                                    <th class="center c5">पुल</th>
                                    <th class="center c3">इकाई</th>
                                    <th class="center c4">आम्दानी</th>
                                    <th class="center c4">खर्च</th>
                                    <th class="center c4">बाँकी</th>
                                </tr>
                                </thead>

                                <!-- 2nd table-->
                                <tbody>
                                <tr>
                                    <td class="center" style="width:40px;"><?php echo $i; ?></td>
                                    <td class="center" style="width:100px;"><?php echo($lotinfo->receipt_date); ?></td>
                                    <td class="center" style="width:260px;"><?php echo($lotinfo->s_name); ?></td>
                                    <td class="center" style="width: 150px">&nbsp;</td>
                                    <td class="center" style="width: 250px">&nbsp;</td>
                                    <td class="center" style="width: 150px">meter</td>
                                    <td class="center"><?php echo($lotinfo->units); ?></td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center"><?php echo($lotinfo->units); ?></td>
                                </tr>
                        <?php
                        $release_units = 0;
                        if ($lot['listing']) {
                            $i++;
                            foreach ($lot['listing'] as $item) {
                                $release_units = $release_units + $item->units;
                                $existing_units = $existing_units - $item->units;
                                ?>
                                <tr>
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center" style="width:100px;"><?php echo($item->issued_date); ?></td>
                                    <td class="center" style="width:260px;"><?php //echo($receiptInfo->s_name); ?></td>
                                    <td class="center" style="width: 150px"><?php echo($item->req_id); ?></td>
                                    <td class="center" style="width: 250px"><?php echo($item->bridge_name); ?></td>
                                    <td class="center">meter</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center"><?php echo($item->units); ?></td>
                                    <td class="center"><?php echo($existing_units); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="6" class="text-right c1"><b>जम्मा:</b></td>
                            <td class="center c1"><?php echo $purchased_units; ?></td>
                            <td class="center c1" style="width: 150px"><?php echo $release_units; ?></td>
                            <td class="center c1"><?php echo $existing_units; ?></td>
                        </tr>
                                </tbody>
                            </table>
                            <?php
                            $total_purchased = $total_purchased + $purchased_units;
                            $total_release = $total_release + $release_units;
                            $total_existing = $total_existing + $existing_units;
                        ?>
                        <?php } ?>
                        </div>
                        <?php //} ?>
                        <div class="col-lg-14 mainBoard">
                            <div class=" table-responsive">
                                <table class="table table-bordered table-hover" style="" align="center">
                                    <tr>
                                        <td colspan="6" class="text-right c1" style="width: 202px;"><b><?php echo $receiptInfo->diametername;?>mm जम्मा:</b></td>
                                        <td class="center c1" style="width: 186px"><?php echo $total_purchased;?></td>
                                        <td class="center c1" style="width: 155px"><?php echo $total_release;?></td>
                                        <td class="center c1" style="width: 155px"><?php echo $total_existing;?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                        $i++;
                        $j++;
                            }
                            ?>                            
                            <?php
                        }
                        ?>
            </div><!---main board-->

            <!---footer-->
            <div class="clear"></div>
            <div class="col-lg-4 right"></div>
            <div class="footer_border2">
                <div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">Store Management System</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
            </div>
            <!---footer-->
        </div><!--mainBoard Ends-->

        <div class="clear"></div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

