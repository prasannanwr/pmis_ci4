<div id="page-wrapper" class="largeRpt">
    <div class="alignRight">
        <form method="post" target="_blank" action="<?php echo site_url();?>reports/region_wise_summary_bulldog_print/<?=$agency;?>">
            <input type="hidden" name="region" value="<?php echo $region;?>">
            <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" />
        </form>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mainBoard ">
                <p class="center">नेपाल सरकार</p>
                <p class="center">संघीय मामिला तथा सामान्य प्रशासन मन्त्रालय</p>
                <p class="center">स्थानीय पूर्वाधार विभाग</p>
                <p class="center">झुलुङे पूल क्षेत्रगत कार्यक्रम </p>     
                <h2 class="center">Store wise Stock of Bulldog grips purchased through <?php echo ($agency == 1 ? 'GoN':'SDC');?> fund</h2>
            </div>
            <?php if($this->session->userdata('type') == ENUM_ADMINISTRATOR) { ?>
            <div class="col-lg-2">
                <form method="post" name="frmRegion" action="<?php echo site_url();?>reports/region_wise_summary_bulldog/<?=$agency;?>">
                    <?php echo et_form_dropdown_db('region', 'regional_office', 'region_name', 'id', et_setFormVal('region', $region), '', 'class="form-control" onChange="frmRegion.submit()"') ?>
                </form>
            </div>
            <?php } ?>
            <div class="col-lg-10 mainBoard">
                <div class=" table-responsive" >
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>

                            <th class="center c3">लठ्ठाको मोटाइ</th>

                            <th class="center c4">बाँकी Length (सङ्ख्या मा )</th>

                        </tr>
                        <tr>

                            <th class="center c3" colspan="2"><?php echo $region_name;?></th>
                        </tr>

                        </thead>

                        <!-- 2nd table-->

                        <?php
                        if ($arrOverallList)
                        {
                            ?>
                            <tbody>
                            <?php
                            foreach ($arrOverallList as $item) {
                                //$in_stock = $item->total_receipt - $item->totalunits;
                                ?>
                                <tr class="sum">
                                    <td class="center"><?php echo $item["diameter"]; ?></td>
                                    <td class="center"><?php echo $item["stock"]; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        <?php } else { echo "<tr class='sum'><td colspan='2'>No records</td></tr>";} ?>
                    </table>

                </div>

            </div><!---main board-->
            <div class="clear"></div>

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