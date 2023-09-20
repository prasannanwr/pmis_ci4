<div id="page-wrapper" class="largeRpt">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mainBoard ">

                <!--                <img src="--><?php //echo base_url();?><!--images/final_tbssp.gif" class="pull-right img-responsive">-->
                <h2 class="alignLeft">Overall summary of Bulldog grips dispatch</h2>
            </div>
            <div class="col-lg-10 mainBoard">
                <div class=" table-responsive" >
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>
                            <th class="center c1">Name of Organization</th>

                            <th class="center c3">Diameter</th>

                            <th class="center c4">Total Piece</th>

                            <th class="center c5">Total Receipt</th>

                            <th class="center c6">Total Stock</th>

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
                                $remaining_stock = $item->total_receipt - $item->total_issue;
                                    ?>
                                    <tr class="sum">
                                        <td class="center"><?php echo $item->organization_name; ?></td>
                                        <td class="center"><?php echo $item->diametername; ?></td>
                                        <td class="center"><?php echo $item->total_issue; ?></td>
                                        <td class="center"><?php echo $item->total_receipt;?></td>
                                        <td class="center"><?php echo $remaining_stock; ?></td>
                                    </tr>
                                    <?php
                            }
                            ?>
                            </tbody>
                        <?php } ?>
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