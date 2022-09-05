<!-- Navigation -->
<nav class="navbar navbar-fixed-top noPrint" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">
                        Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
                <img src="<?php echo  base_url("images/0349198001423239216.jpg"); ?> " style="max-height: 100px;" />
                <!--    <img src="<?php // echo base_url(); 
                                    ?>images/final_tbssp.gif" /> -->
                <a href="<?php echo  base_url() ?>" class="navbar-brand"><?php //echo $logoimg['log01name']; ?></a>
                <?php // echo anchor( '', 'Trail Bridge Support Unit', array( 'class'=>
                //'navbar-brand')); 
                ?>
                <div class="clear">
                </div>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav clearfix">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo session()->get('name'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo anchor('user/profile', '<i class="fa fa-fw fa-user"></i> Profile') ?>
                        </li>
                        <li>
                            <?php echo anchor('user/change_password', '<i class="fa fa-fw fa-key"></i> Change Password') ?>

                            <!--    <a href="#"><i class="fa fa-fw fa-envelope"></i> Change Password</a> -->
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <?php echo anchor('user/logout', '<i class="fa fa-fw fa-power-off"></i> Logout') ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clear clearfix">
                    <div class="navbar-inverse">
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <!--a href="<?php echo site_url(); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a-->
                                </li>
                                <?php if (session()->get('user_rights') != 6) { ?>
                                    <li>
                                        <?php echo anchor('bridge/lists', 'All Bridges'); ?>
                                    </li>
                                <?php  } ?>

                                <!--- start new Report list-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Reports <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                New Construction Report<b class="caret"></b>
                                            </a>


                                            <ul class="dropdown-menu1">
                                                <li class="dropdown" style="display:none">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Commited Bridges Reports <b class="caret"></b>
                                                    </a>

                                                    <ul class="dropdown-menu2">

                                                        <!--All Bridge List Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                All Bridge List <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <?php echo anchor('reports/districtwise', 'District Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <?php echo anchor('reports/devregionwise', 'Dev. Region Wise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>

                                                                <!--   <li class="child-menu">
                                                    <?php // echo anchor('reports/tbss_regionwise', 'region Wise Report ');
                                                    ?>
                                                    
                                                    </li>
                                                    <div class="clear"></div> -->
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--All Bridge List End--->

                                                        <!--Basic Record Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Basic Records <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Bridge Wise <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4 ">
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Bridgewise', '
                                                            Bridge Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Over All <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4 ">
                                                                        <li>
                                                                            <?php echo anchor('reports/Overall_DateWise', '
                                                            Overall DateWise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Overall_FYWise', '
                                                            Overall FY Wise Report '); ?>

                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Estimated Bridge Cost<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Overall_DateWise', 'Over All Date Wise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Overall_FYWise', 'FY Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Dist_DateWise', 'District Date Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Dist_FYWise', 'District FY Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Dev_DateWise', 'Dev.Region Date Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Dev_FYWise', 'Dev.Region FY Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_TBSS_DateWise', 'TBSS region d Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_TBSS_FYWise', 'TBSS region FY Wise Report '); ?>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Estimated Contribution Commitment<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Overall_DateWise', ' Overall DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Overall_FYWise', 'Overall Fiscal Year Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Dist_DateWise', 'District DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Dist_FYWise', 'District Fiscal Year Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Dev_DateWise', 'Dev. Region Date Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_Dev_FYWise', 'Dev. Region Fiscal Year Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_TBSS_DateWise', 'Contribution TBSU Date Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Est_Cont_TBSS_FYWise', 'Contribution TBSU Fiscal Year Wise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>

                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--Basic Record End--->
                                                        <!--Work Progress Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Work Progress <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Fiscal Year <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Work_Carryover_Bridges', 'New and Carryover Bridges Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Work_Cancelled_Bridges', 'Cancelled Bridges Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Work_Completed_Bridges', 'Completed Bridges Report '); ?>
                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>

                                                                </li>
                                                                <li class="divider"> </li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Date Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Work_Datewise_Completed', 'Datewise Completed Report'); ?>
                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--Work Progress End--->
                                                        <!--Engineering Work Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Engineering Work <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                    <?php echo anchor('reports/Eng_SiteAssesment_Survey', 'Site Assesment and Survey DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Eng_Desing_Cost_Estimate', 'Design and Cost Estimate DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Eng_Design_Approval', 'Design and CostDesign Approval DateWise Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Eng_FYWise', 'Fiscal Years Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!-- Engineering Work End -->

                                                    </ul>

                                                </li>
                                                <!-- start Completed Bridges Report -->
                                                <li class="divider" style="display:none"></li>

                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Completed Bridges Report <b class="caret"></b>
                                                    </a>

                                                    <ul class="dropdown-menu2">

                                                        <!--General Bridge List Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Completed Bridge List <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">

                                                                <!--<li class="child-menu">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
															District Wise<b class="caret"></b>
															</a>
															<ul class="dropdown-menu4">
																<li>
																<?php echo anchor('reports/Gen_Dist_DateWise', 'Date Wise Report'); ?>
																
																</li>
																<li class="divider"></li>
																<li>
																<?php echo anchor('reports/Gen_Dist_FYWise', 'FY Wise Report '); ?>
																</li>
																
																<li class="divider"></li>
																
															</ul>
														</li>
														<li class="divider"></li>   -->

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Over All <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4 ">
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Overall_DateWise', '
                                                            DateWise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Overall_FYWise', '
                                                           FY Wise Report '); ?>

                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        State Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Dev_DateWise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Dev_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Palika Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Munc_DateWise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Gen_Munc_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>

                                                                <li class="divider"></li>
                                                                <!--<li class="child-menu">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    TBSU Wise<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu4">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_TBSS_DateWise', 'DateWise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li> 
                                                        <li>
                                                        <?php echo anchor('reports/Gen_TBSS_FYWise', 'Fiscal Year Wise Report'); ?>
                                                        </li>
                                                        
                                                        <li class="divider"></li>                                            
                                                    </ul>
                                                </li>
                                                   <li class="divider"></li>   -->
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--General Bridge List End--->

                                                        <!--Actual Brigde Cost Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Actual Bridge Cost <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Over All <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4 ">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Overall_DateWise', '
                                                            DateWise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Overall_FYWise', '
                                                           FY Wise Report '); ?>

                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        District Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Dist_DateWise', 'Date Wise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Dist_FYWise', 'FY Wise Report '); ?>
                                                                        </li>

                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        State Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Dev_DateWise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Dev_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>

                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        TBSU Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_TBSS_DateWise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_TBSS_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Supporting Agency Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Supporting_AgencyWise_DateWise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Supporting_AgencyWise_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Palika Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Munc_DateWise', 'Date Wise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Munc_FYWise', 'FY Wise Report '); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--Actual Brigde Cost End--->
                                                        <!--Actual Bridge Contribution Commitment Start--->
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Actual Cost Contribution <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Over All <b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4 ">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Overall_datewise', '
                                                            DateWise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Overall_Fywise', '
                                                           FY Wise Report '); ?>

                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>

                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        District Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Districtwise_datewise', 'Date Wise Report'); ?>

                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Districtwise_FYwise', 'FY Wise Report '); ?>
                                                                        </li>

                                                                        <li class="divider"></li>

                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        State Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Dev_RegionWise_datewise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Dev_RegionWise_fywise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>

                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        TBSU Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_TBSSPRegionWise_datewise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_TBSSPRegionWise_FYwise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Supporting Agency Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Supporting_AgencyWise_datewise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Supporting_AgencyWise_FYwise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="child-menu">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        Palika Wise<b class="caret"></b>
                                                                    </a>
                                                                    <ul class="dropdown-menu4">
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Munc_datewise', 'DateWise Report'); ?>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li>
                                                                            <?php echo anchor('reports/Act_Con_Munc_FYWise', 'Fiscal Year Wise Report'); ?>
                                                                        </li>

                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <!--Actual Bridge Contribution Commitment End--->


                                                    </ul>

                                                </li>
                                                <li class="divider"></li>
                                                <!----end of complted bridge--->

                                                <!--- start of progress report----->
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Progress Status Report <b class="caret"></b>
                                                    </a>

                                                    <ul class="dropdown-menu2">
                                                        <!--
                                            <li> 
                                            <?php //echo anchor('reports/Pro_Overall_Status', 'Overall Status Report');
                                            ?>
                                            </li>
                                             <li class="divider"></li>
                                            <li> 
                                            <?php //echo anchor('reports/Pro_CarryOver_Status', 'Carry Over Status Report');
                                            ?>
                                            </li>
                                             <li class="divider"></li>
                                            <li> 
                                            <?php //echo anchor('reports/Pro_New_Status', 'New Status Report');
                                            ?>
                                            </li>
                                             <li class="divider"></li>
                                             -->
                                                        <li>
                                                            <?php //echo anchor('reports/Pro_Physical_Progress', 'Physical Progress Report');
                                                            ?>

                                                        <li>
                                                            <?php echo anchor('reports/Pro_Physical_Progress', 'Bridge Wise Progress Report'); ?>
                                                        </li>

                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Summary Progress Report<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <!--  <li class="child-menu">
                                                        <?php //echo anchor('reports/Act_Con_Supporting_AgencyWise_datewise', 'DateWise Report');
                                                        ?>                                                         
                                                         <?php //echo anchor('reports/Pro_Cumulative_Overall_datewise', 'DateWise Report');
                                                            ?>
                                                        </li> -->
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <?php //echo anchor('reports/Act_Con_Supporting_AgencyWise_FYwise', 'Fiscal Year Wise Report');
                                                            ?>
                                                            <?php echo anchor('reports/Pro_Cumulative_Overall', 'Fiscal Year Wise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <?php //echo anchor('reports/Act_Con_Supporting_AgencyWise_FYwise', 'Fiscal Year Wise Report');
                                                            ?>
                                                            <?php echo anchor('reports/Pro_Cumulative_Overall_agencywise', 'Agency Wise Report'); ?>
                                                        </li>

                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>

                                                <li class="divider"></li>
                                            </ul>

                                        </li>
                                        <li class="divider"></li>
                                        <!--- end of progress report---->
                                        <!--- start R7----->

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                R7 Report<b class="caret"></b>
                                            </a>

                                            <ul class="dropdown-menu2">
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Under Construction Report<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction', 'District Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction_Regional', 'TBSU Regional Office Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction_Palika', 'Palika Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <li>

                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Completed Report<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed', 'District Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed_Regional', 'TBSU Regional Office Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed_Palika', 'Palika Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>

                                                <li class="divider"></li>

                                            </ul>
                                        </li>
                                        <li class="divider"></li>
                                        <!--Basic Record Start--->
                                        <li class="dropdown">
                                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Basic Records <b class="caret"></b>
                                        </a>-->
                                            <?php echo anchor('reports/Bridgewise', '
                                                            Bridge Wise Basic Report'); ?>
                                        </li>
                                        <li class="divider"></li>
                                        <!--- end of R7--->
                                    </ul>
                                    <!--end  Committed bridege -->
                                </li>
                                <!----Start major mantain daya---->
                                <li class="divider"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Major Maintenance Report<b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu1">
                                        <li class="dropdown" style="display:none">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Commited Bridges Reports <b class="caret"></b>
                                            </a>

                                            <ul class="dropdown-menu2">

                                                <!--All Bridge List Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        All Bridge List <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <?php echo anchor('reports/districtwise/Major_Maintenance', 'District Wise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <?php echo anchor('reports/devregionwise/Major_Maintenance', 'Dev. Region Wise Report'); ?>

                                                        </li>
                                                        <li class="divider"></li>

                                                        <!--  <li class="child-menu">
                                                    <?php // echo anchor('reports/tbss_regionwise/Major_Maintenance', 'region Wise Report ');
                                                    ?>
                                                    
                                                    </li>
                                                    <div class="clear"></div>-->
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--All Bridge List End--->

                                                <!--Basic Record Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Basic Records <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Bridge Wise <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4 ">
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Bridgewise/Major_Maintenance', '
                                                            Bridge Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Over All <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3 ">
                                                                <li>
                                                                    <?php echo anchor('reports/Overall_DateWise/Major_Maintenance', '
                                                            Overall DateWise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Overall_FYWise/Major_Maintenance', '
                                                            Overall FY Wise Report '); ?>

                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Estimated Bridge Cost<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Overall_DateWise/' . MM_CODE, 'Over All Date Wise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Overall_FYWise/' . MM_CODE, 'FY Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Dist_DateWise/' . MM_CODE, 'District Date Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Dist_FYWise/' . MM_CODE, 'District FY Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Dev_DateWise/' . MM_CODE, 'Dev.Region Date Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Dev_FYWise/' . MM_CODE, 'Dev.Region FY Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_TBSS_DateWise/' . MM_CODE, 'TBSU region data Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_TBSS_FYWise/' . MM_CODE, 'TBSU region FY Wise Report '); ?>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Estimated Contribution Commitment<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Overall_DateWise/' . MM_CODE, ' Overall DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Overall_FYWise/' . MM_CODE, 'Overall Fiscal Year Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Dist_DateWise/' . MM_CODE, 'District DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Dist_FYWise/' . MM_CODE, 'District Fiscal Year Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Dev_DateWise/' . MM_CODE, 'Dev. Region Date Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_Dev_FYWise/' . MM_CODE, 'Dev. Region Fiscal Year Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_TBSS_DateWise/' . MM_CODE, 'Contribution TBSU Date Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Est_Cont_TBSS_FYWise/' . MM_CODE, 'Contribution TBSU Fiscal Year Wise Report'); ?>
                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>

                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--Basic Record End--->
                                                <!--Work Progress Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Work Progress <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Fiscal Year <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>


                                                                    <?php echo anchor('reports/Work_Carryover_Bridges/' . MM_CODE, 'New and Carryover Bridges Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Work_Cancelled_Bridges/' . MM_CODE, 'Cancelled Bridges Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Work_Completed_Bridges/' . MM_CODE, 'Completed Bridges Report '); ?>
                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>

                                                        </li>
                                                        <li class="divider"> </li>

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Date Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu3">
                                                                <li>
                                                                    <?php echo anchor('reports/Work_Datewise_Completed/' . MM_CODE, 'Datewise Completed Report'); ?>
                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"> </li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--Work Progress End--->
                                                <!--Engineering Work Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Engineering Work <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu2">
                                                        <li>

                                                            <?php echo anchor('reports/Eng_SiteAssesment_Survey/MM', 'Site Assesment and Survey DateWise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/Eng_Desing_Cost_Estimate/MM', 'Desing and Cost  Estimate DateWise Wise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/Eng_Design_Approval/MM', 'Desing and CostDesign Approval DateWise Wise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/Eng_FYWise/MM', 'Fiscal Years Wise Report'); ?>
                                                        </li>
                                                        <li class="divider"> </li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--Engineering Work End--->

                                            </ul>

                                        </li>
                                        <!---start Completed Bridges Report--->
                                        <li class="divider" style="display:none"></li>

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Completed Bridges Report <b class="caret"></b>
                                            </a>

                                            <ul class="dropdown-menu2">

                                                <!--General Bridge List Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Completed Bridge List <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Over All <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4 ">
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Overall_DateWise/' . MM_CODE, '
                                                            DateWise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Overall_FYWise/' . MM_CODE, '
                                                           FY Wise Report '); ?>

                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <!--<li class="child-menu">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    District Wise<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu4">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_DateWise/' . MM_CODE, 'Date Wise Report'); ?>
                                                        
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                        <?php echo anchor('reports/Gen_Dist_FYWise/' . MM_CODE, 'FY Wise Report '); ?>
                                                        </li>
                                                        
                                                        <li class="divider"></li>
                                                        
                                                    </ul>
                                                </li>-->
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                State Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Dev_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Dev_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>

                                                        <li class="divider"></li>
                                                        <!--<li class="child-menu">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    TBSU Wise<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu4">
                                                        <li>
                                                        <?php echo anchor('reports/Gen_TBSS_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                        </li>
                                                        <li class="divider"></li> 
                                                        <li>
                                                        <?php echo anchor('reports/Gen_TBSS_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                        </li>
                                                        
                                                        <li class="divider"></li>                                            
                                                    </ul>
                                                </li>
                                                   <li class="divider"></li>   -->
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Palika Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Munc_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Gen_Munc_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>

                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--General Bridge List End--->

                                                <!--Actual Brigde Cost Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Actual Bridge Cost <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Over All <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4 ">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Overall_DateWise/' . MM_CODE, '
                                                            DateWise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Overall_FYWise/' . MM_CODE, '
                                                           FY Wise Report '); ?>

                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                District Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Dist_DateWise/' . MM_CODE, 'Date Wise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Dist_FYWise/' . MM_CODE, 'FY Wise Report '); ?>
                                                                </li>

                                                                <li class="divider"></li>

                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                State Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Dev_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Dev_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>

                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                TBSU Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_TBSS_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_TBSS_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Supporting Agency Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Supporting_AgencyWise_DateWise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Supporting_AgencyWise_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Palika Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Munc_DateWise/' . MM_CODE, 'Date Wise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Munc_FYWise/' . MM_CODE, 'FY Wise Report '); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--Actual Brigde Cost End--->
                                                <!--Actual Bridge Contribution Commitment Start--->
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Actual Cost Contribution <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Over All <b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4 ">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Overall_datewise/' . MM_CODE, '
                                                            DateWise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Overall_Fywise/' . MM_CODE, '
                                                           FY Wise Report '); ?>

                                                                </li>
                                                                <li class="divider"> </li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>

                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                District Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Districtwise_datewise/' . MM_CODE, 'Date Wise Report'); ?>

                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Districtwise_FYwise/' . MM_CODE, 'FY Wise Report '); ?>
                                                                </li>

                                                                <li class="divider"></li>

                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                State Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Dev_RegionWise_datewise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Dev_RegionWise_fywise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>

                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                TBSU Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_TBSSPRegionWise_datewise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_TBSSPRegionWise_FYwise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Supporting Agency Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Supporting_AgencyWise_datewise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Supporting_AgencyWise_FYwise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="child-menu">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                Palika Wise<b class="caret"></b>
                                                            </a>
                                                            <ul class="dropdown-menu4">
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Munc_datewise/' . MM_CODE, 'DateWise Report'); ?>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <?php echo anchor('reports/Act_Con_Munc_FYWise/' . MM_CODE, 'Fiscal Year Wise Report'); ?>
                                                                </li>

                                                                <li class="divider"></li>
                                                            </ul>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <!--Actual Bridge Contribution Commitment End--->


                                            </ul>

                                        </li>
                                        <li class="divider"></li>
                                        <!----end of complted bridge--->

                                        <!--- start of progress report----->
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Progress Status Report <b class="caret"></b>
                                            </a>

                                            <ul class="dropdown-menu2">
                                                <?php /*<li> 
                                            <?php echo anchor('reports/Pro_Overall_Status/'.MM_CODE, '
                                           Overall Status Report');?>
                                            </li>
                                             <li class="divider"></li>
                                            <li> 
                                            <?php echo anchor('reports/Pro_CarryOver_Status/'.MM_CODE, '
                                           Carry Over Status Report');?>
                                            </li>
                                             <li class="divider"></li>
                                            <li> 
                                            <?php echo anchor('reports/Pro_New_Status/'.MM_CODE, '
                                           New Status Report');?>
                                            </li>
                                             <li class="divider"></li>
                                             */ ?>
                                                <li>
                                                    <?php echo anchor('reports/Pro_Physical_Progress/' . MM_CODE, '
                                           Bridge Wise Progress Report'); ?>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <?php echo anchor('reports/Pro_Cumulative_Overall/' . MM_CODE, '
                                           Summary Progress Report'); ?>
                                                </li>

                                                <li class="divider"></li>
                                            </ul>

                                        </li>
                                        <li class="divider"></li>
                                        <!--- end of progress report---->
                                        <!--- start R7----->

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                R7 Report<b class="caret"></b>
                                            </a>

                                            <ul class="dropdown-menu2">
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Under Construction Report<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction/' . MM_CODE, 'District Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction_Regional/' . MM_CODE, 'TBSU Regional Office Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Under_Construction_Palika' . MM_CODE, 'Palika Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Completed Report<b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu3">
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed/' . MM_CODE, 'District Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed_Regional/' . MM_CODE, 'TBSU Regional Office Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <?php echo anchor('reports/R_Completed_Palika/' . MM_CODE, 'Palika Wise'); ?>
                                                        </li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </li>

                                                <li class="divider"></li>
                                            </ul>
                                        </li>
                                        <li class="divider"></li>
                                        <!--- end of R7--->
                                        <!--Basic Record Start--->
                                        <li class="dropdown">
                                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Basic Records <b class="caret"></b>
                                        </a>-->
                                            <?php echo anchor('reports/Bridgewise/MM', '
                                                            Bridge Wise Basic Report'); ?>
                                        </li>
                                        <li class="divider"></li>
                                    </ul>
                                    <!--end  Committed bridege -->




                                </li>

                                <!--------end major maintain------------->
                            </ul>




                            </li>




                            <li>
                                <?php // echo anchor( 'settings', 'Settings');
                                ?>
                            </li>
                            <!--setting--->
                            <?php
                            //     if  ($this->session->userdata('type') == ENUM_ADMINISTRATOR || $this->session->userdata('type') == ENUM_CENTRAL_MANAGER)
                            // {
                            if (session()->get('user_rights') == ENUM_ADMINISTRATOR) {
                            ?>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Settings <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu Bgset" style="width: 500px;">
                                        <div class="" style="width: 230px; overflow: hidden; float: left; margin-right: 10px; margin-left:10px ;">
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('bridge_type', '<i class="fa  fa-tasks fa-1x"></i> Bridge Types'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('bridge_design_standard', '
                                                                <i class="fa fa-pencil-square-o fa-1x"></i> Bridge Design Standard'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('bridge_designer', '
                                                                <i class="fa fa-pencil fa-1x"></i> Bridge Designer'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li><?php echo anchor('country', ' <i class="fa fa-flag fa-1x"></i> Countries'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('cost_components', '
                                                                <i class="fa fa-money fa-1x"></i> Cost Components'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('construction', '
                                                                <i class="fa fa-comments fa-1x"></i> Contruction Components'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('development_region', '
                                                                <i class="fa fa-align-justify fa-1x"></i> Development Region'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('province', '
                                                                <i class="fa fa-align-justify fa-1x"></i> States'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('district_name', '
                                                                    <i class="fa fa-align-left fa-1x"></i> District Name'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('fiscal_year', '
                                                                <i class="fa fa-comments fa-1x"></i> Fiscal Year'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('handrail_cable', '
                                                                <i class="fa fa-comments fa-1x"></i> Handrail Cable'); ?>
                                            </li>

                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('logo_upload', '
                                                                <i class="fa fa-align-center fa-1x"></i> Logo Upload'); ?>
                                            </li>
                                            <li class="divider"></li>

                                            <li>
                                                <?php echo anchor('vcd_municipality', '
                                                                <i class="fa fa-align-right fa-1x"></i> Municipality and VDC'); ?>

                                            </li>
                                            <li class="divider"></li>


                                        </div>


                                        <div class="" style="width: 230px; overflow: hidden; float: left;">
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('main_walkway_cable_diam', '
                                                                <i class="fa fa-comments fa-1x"></i> Main Walkway Cable Diam'); ?>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <?php echo anchor('main_walkway_cable_number', '
                                                                <i class="fa fa-comments fa-1x"></i> Main Walkway Cable Number'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('rust_prev_measures', '
                                                                <i class="fa fa-comments fa-1x"></i>  Rust Prev Measures'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('regional_office', '
                                                                <i class="fa fa-comment fa-1x"></i>  Regional Office '); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('basic_supporting_agencies', '
                                                            <i class="fa fa-users fa-1x"></i> Supporting Agencies'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('supporting_agencies', '
                                                            <i class="fa fa-users fa-1x"></i> Contributing Agencies'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('site_surveyors', '
                                                                <i class="fa fa-square fa-1x"></i> Site Surveyors'); ?>
                                            </li>
                                            <li class="divider"> </li>

                                            <li>
                                                <?php echo anchor('user', '<i class="fa fa-user fa-1x"></i> Users'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('walkway_width', '
                                                                <i class="fa fa-comments fa-1x"></i> Walk way Width'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('walkway_deck', '
                                                                <i class="fa fa-comments fa-1x"></i> Walk way Deck'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('weighted', '
                                                                <i class="fa fa-align-center fa-1x"></i> Weighted'); ?>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <?php echo anchor('work_category', '
                                                                <i class="fa fa-comments fa-1x"></i> Work Category'); ?>
                                            </li>
                                            <li class="divider"> </li>

                                            <li>
                                                <?php echo anchor('zone', '
                                                                <i class="fa fa-align-center fa-1x"></i> Zone'); ?>
                                            </li>
                                            <li class="divider"></li>


                                        </div>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!--setting end---->
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <!-- /.navbar-collapse -->
        </nav>