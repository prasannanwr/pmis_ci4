<div id="page-wrapper" class="largeRpt">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 mainBoard ">

                <img src="<?php echo base_url();?>images/final_tbssp.gif" class="pull-right img-responsive">
                <h2 class="alignLeft">Summary of cable[s] issued to: <?php echo $organization_name;?></h2>
            </div>
            <div class="col-lg-10 mainBoard">
                <div class="col-lg-7 table-responsive" >
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>
                            <th class="center c1">Date of Issue</th>

                            <th class="center c3">Diameter</th>

                            <th class="center c4">Total Length</th>

                        </tr>

                        </thead>

                        <!-- 2nd table-->

                        <?php
                        if ($orgInfo)
                        {
                            ?>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($orgInfo as $value) {
                            ?>
                            <tr class="row<?php echo $i;?>">                                
                                <td class="center"><?php echo $value->issued_date;?></td>
                                <td class="center"><?php echo $value->diametername;?></td>
                                <td class="center"><?php echo $value->units;?></td>
                            </tr>
                            <?php
                                $i++;
                            }

                            ?>
                            </tbody>
                        <?php } ?>
                    </table>

                </div>

                <div class="col-lg-3 table-responsive" >
                    <table class="table table-bordered table-hover" style="width:700px" align="center">
                        <thead>
                        <tr>
                            <th class="center c1">Diameter</th>

                            <th class="center c3">Total Length</th>

                        </tr>

                        </thead>

                        <!-- 2nd table-->

                        <?php
                        if ($diameterTotal)
                        {
                            ?>
                            <tbody>
                            <?php
                            $i = 1;
                            $units = 0;
                            $diameter = '';
                            foreach ($diameterTotal as $value) {
                            ?>
                            <tr class="sum sumorg_<?php echo $value->diametername;?>">
                                <td class="center"><?php echo $value->diametername;?></td>
                                <td class="center"><?php echo $value->totalunits;?></td>
                            </tr>
                            <?php
                                $i++;
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

