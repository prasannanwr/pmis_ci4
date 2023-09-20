<div id="page-wrapper" class="largeRpt">   
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mainBoard ">
                <p class="center">नेपाल सरकार</p>
                <p class="center">संघिय मामिला तथा स्थानीय विकास मन्त्रालय</p>
                <p class="center">स्थानीय पुर्वाधार बिकास तथा कृषि सडक विभाग</p>
                <p class="center">झुलुङे पूल क्षेत्रगत कार्यक्रम </p>                  
                <h2 class="center">Reel number wise stock of Cable</h2>
            </div>
            <div class="col-lg-10 mainBoard">
                <div class=" table-responsive" >
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>

                            <th class="center c3">Reel No.</th>

                            <th class="center c3">Diameter</th>

                            <th class="center c4">Total Length</th>

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
                                ?>
                                <tr class="sum">
                                    <td class="center"><?php echo $item["lot"]; ?></td>
                                    <td class="center"><?php echo $item["diameter"]; ?></td>
                                    <td class="center"><?php echo $item["stock"]; ?></td>
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