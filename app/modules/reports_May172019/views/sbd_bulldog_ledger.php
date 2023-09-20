<div id="page-wrapper" class="largeRpt">
    <div class="alignRight">
        <form method="post" action="<?php echo site_url();?>reports/sbd_bulldog_ledger_print">
            <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" />
        </form>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mainBoard">
<!--                <p class="center">नेपाल सरकार</p>-->
<!--                <p class="center">संघिय मामिला तथा स्थानीय विकास मन्त्रालय</p>-->
<!--                <p class="center">स्थानीय पुर्वाधार बिकास तथा कृषि सडक विभाग</p>-->
<!--                <p class="center">झुलुङे पूल क्षेत्रगत कार्यक्रम </p>-->
<!--                <h2 class="center">बुलडग ग्रिपको  आम्दानी खर्छ विवरण </h2>-->

                <?php
                if($arrCableList) {
                    $j = 1;
                    $total_purchased = 0;
                    $total_release = 0;
                    $total_existing = 0;
                    foreach ($arrCableList as $list) {
                        //var_dump($list[0]['data']->diametername);exit;
                        $i=1;
                        $receiptInfo = $list[0]['data'];                                            

                        ?>
                        <div class=" table-responsive">                        
                            <div class="col-lg-3"><b>बुलडग ग्रिपको मोटाइ :</b> <?php echo $receiptInfo->diametername; ?>mm</div><br>
                            <?php foreach($list as $lot) {
                                //var_dump($lot);exit;
                                $lotinfo = $lot['data'];
                                $purchased_units = $lotinfo->units;
                                $existing_units = $purchased_units; 
                            ?>
                            <div class="col-lg-3"><b>बुलडग ग्रिपको रील नम्बर :</b><?php echo $lotinfo->lot; ?></div>
                            <table class="table table-bordered table-hover" style="" align="center">
                                <thead>
                                <tr>
                                    <th class="center c1">क्र स</th>
                                    <th class="center c2">मिती</th>
                                    <th class="center c4">प्राप्त गरेको</th>
                                    <th class="center c4">हस्तान्तारन नम्बर</th>
                                    <th class="center c3">इकाइ</th>
                                    <th class="center c4">आम्दानी</th>
                                    <th class="center c4">खर्च</th>
                                    <th class="center c4">बाँकी</th>
                                </tr>
                                </thead>

                                <!-- 2nd table-->
                                <tbody>
                                <tr>
                                    <td class="center" style="width:40px;"><?php echo $i; ?></td>
                                    <td class="center"><?php echo($lotinfo->receipt_date); ?></td>
                                    <td class="center"><?php echo($lotinfo->s_name); ?></td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">meter</td>
                                    <td class="center"><?php echo($lotinfo->units); ?></td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center"><?php echo($lotinfo->units); ?></td>
                                </tr>
                        <?php
                        $release_units = '';
                        if ($lot['listing']) {
                            $i++;
                            foreach ($lot['listing'] as $item) {
                                $release_units = $release_units + $item->units;
                                $existing_units = $existing_units - $item->units;
                                ?>
                                <tr>
                                    <td class="center" style="width:40px;"><?php echo $i; ?></td>
                                    <td class="center"><?php echo($item->issued_date); ?></td>
                                    <td class="center"><?php //echo($receiptInfo->s_name); ?></td>
                                    <td class="center"><?php echo($item->req_id); ?></td>
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
                            <td colspan="5" class="text-right c1"><b>जम्मा:</b></td>
                            <td class="center c1"><?php echo $purchased_units; ?></td>
                            <td class="center c1"><?php echo $release_units; ?></td>
                            <td class="center c1"><?php echo $existing_units; ?></td>
                        </tr>
                                </tbody>
                            </table>

                        </div>
                        <?php
                            $total_purchased = $total_purchased + $purchased_units;
                            $total_release = $total_release = $release_units;
                            $total_existing = $total_existing + $existing_units;
                        ?>
                        <?php } ?>
                        <div class="col-lg-12 mainBoard">
                            <div class=" table-responsive">
                                <table class="table table-bordered table-hover" style="" align="center">
                                    <tr>
                                        <td colspan="5" class="text-right c1"><b><?php echo $receiptInfo->diametername;?>mm जम्मा:</b></td>                                        
                                        <td class="center c1"><?php echo $total_purchased;?></td>
                                        <td class="center c1"><?php echo $total_release;?></td>
                                        <td class="center c1"><?php echo $total_existing;?></td>
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

