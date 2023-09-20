<div id="page-wrapper" class="largeRpt">
    <div class="alignRight">
        <form method="post" target="_blank" action="<?php echo site_url();?>reports/overall_cable_stock_print">
            <input type="submit" target="_blank" class="btn btn-md btn-success" name="submit" value="Print" />
        </form>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mainBoard ">

                <!--                <img src="--><?php //echo base_url();?><!--images/final_tbssp.gif" class="pull-right img-responsive">-->
                <h2 class="center">Overall stock of Cable</h2>
            </div>
            <div class="col-lg-10 mainBoard">
                <div class=" table-responsive" >
                    <?php if($is_admin == 1) { ?>
                        <table class="table table-bordered table-hover" style="width:1000px" align="center">
                        <thead>
                        <tr>

                            <th class="center c3">Diameter</th>
                            <?php foreach ($regions as $key => $reg) { ?>
                                <th class="center c4"><?php echo $reg->region_name;?></th>
                            <?php } ?>
                            <th class="center c5">Total Balance (mtr.)</th>

                        </tr>

                        </thead>

                        <!-- 2nd table-->

                        <?php
                        if ($arrOverallList)
                        {
                            ?>
                            <tbody>
                            <?php
                            foreach ($arrOverallList as $item) { ?>
                                <?php
                                $total = 0; 
                                $diameter = $item['diameter'];
                                $regionWiseStock = $item['regionWiseStock'];
                                ?>
                                    <tr class="sum">
                                    <td class="center"><?php echo $item['diameter']; ?></td>
                                    <?php foreach ($regionWiseStock as $region) { 
                                        $total = $total + $region['stock'];?>
                                        <td class="center"><?php echo $region['stock']; ?> </td>
                                    <?php } ?>
                                   <!--use $item->totalunits-->
                                    <td class="center"><?php echo $total; ?> </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <?php
                            }
                            ?>
                        
                    </table>
                    <?php } else { ?>
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>

                            <th class="center c3">Diameter</th>
                            <th class="center c4">Total Balance (mtr.)</th>

                        </tr>

                        </thead>

                        <!-- 2nd table-->

                        <?php
                        if ($arrOverallList)
                        {
                            ?>
                            <tbody>
                            <?php
                            foreach ($arrOverallList as $item) { ?>
                                    <tr class="sum">
                                    <td class="center"><?php echo $item['diameter']; ?></td>
                                   <td class="center"><?php echo $item['stock']; ?> </td><!--use $item->totalunits-->
                                    
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <?php
                            }
                            ?>
                    </table>
                <?php } ?>
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