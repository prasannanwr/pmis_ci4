<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" style="font-size:11px;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->

				<div class="row">
					<!--mainBoard starts-->
					<div class="col-lg-12 mainBoard">
                             <div class="col-lg-12 alignRight">
                                <!--<a target="_blank" class="btn btn-md btn-success" href="<?php //echo site_url();?>/reports/Bridgewise_print?id=<?php //echo $arrDevInfo['bri03id'];?>"><span>Print</span></a>-->
								<a target="_blank" class="btn btn-md btn-success no-print" href="" onClick="window.print();return false;"><span>Print</span></a>
                              </div>                    
                             <div class="center bdrBridge">
        						<p class="">Bridge Wise Report</p>
                                <p class="reportHeader ">Basic Record</p>                             
                             </div>

                        
							<!--<section class="rptInfo mrgTop clearfix" id="BasicData">-->
							<section class="mrgTop clearfix" id="BasicData">
								<h3 class="reportSubHeader bdrInline bdrBridge">BASIC DATA</h3>
                                
							<!--<div class="col-lg-12 ">
									<div class="row mrgTop">
									<div class="col-lg-4">
									<label class="reportLabel">Bridge Number:</label>
									<span><?php echo $arrDevInfo['bri03bridge_no']; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Bridge name:</label>
									<span><?php echo $arrDevInfo['bri03bridge_name']; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Bridge Type*:</label>
									<span><?php echo $arrDevInfo['bri03bridge_type']; ?></span>
									</div>
									</div>
								</div>
								
								<div class="col-lg-12 bdrBridge">
									<div class="row">
									<div class="col-lg-4">
									<label>Span(m):</label>
									<span><?php echo $arrDevInfo['bri03design']; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Walkway Deck Type:</label>
									<span><?php echo $arrDevInfo['wad01walkway_deck_type_name']; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Walkway W=width(cm):</label>
									<span><?php echo $arrDevInfo['wal01walkway_width']; ?></span>
									</div>
									</div>
								</div>-->
								<table class="basic_bridge" cellspacing="5" cellpadding="5">
								<tr>
								<td><label>Bridge Number:</label></td>
								<td><?php echo $arrDevInfo['bri03bridge_no']; ?></td>
								<td>&nbsp;</td>
								<td><label>Bridge Name:</label></td>
								<td><?php echo $arrDevInfo['bri03bridge_name']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Bridge Type*:</label></td>
								<td><?php echo $bridgeType['bri01bridge_type_code']; ?></td>
								</tr>
								
								<tr>
								<td><label>Span(m):</label></td>
								<td><?php echo $arrDevInfo['bri03design']; ?></td>
								<td>&nbsp;</td>
								<td><label>Walkway Deck Type:</label></td>
								<td><?php echo $arrDevInfo['wad01walkway_deck_type_name']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Walkway W=width(cm):</label></td>
								<td><?php echo $arrDevInfo['wal01walkway_width']; ?></td>
								</tr>
								
								</table>
							</section>
							<section class="rptInfo clearfix" id="Location">
								<h3 class="reportSubHeader bdrInline bdrBridge">LOCATION</h3>
								
								<table class="basic_bridge" cellspacing="5" cellpadding="5">
								<tr>
								<td><label>District Name-Main:</label></td>
								<td><?php echo $arrDevInfo['dist01name']; ?></td>
								<td>&nbsp;</td>
								<td><label>District at left Bank:</label></td>
								<td><?php echo $arrDevInfo['left_dist01name']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>District at right Bank:</label></td>
								<td><?php echo $arrDevInfo['right_dist01name']; ?></td>
								</tr>
								
								<tr>
								<td><label>Ilaka Number-Main:</label></td>
								<td><?php echo $arrDevInfo['bri03ward_rb']; ?></td>
								<td>&nbsp;</td>
								<td><label>Ilaka No.at Left Bank:</label></td>
								<td><?php echo $arrDevInfo['bri03ward_lb']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								</tr>

								<tr>
								<td><label>RM/UM at Left Bank:</label></td>
								<td><?php echo $arrDevInfo['left_muni01name']; ?></td>
								<td>&nbsp;</td>
								<td><label>RM/UM at Right Bank:</label></td>
								<td><?php echo $arrDevInfo['right_muni01name']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Coordinate East:</label></td>
								<td><?php echo $arrDevInfo['bri03coordinate_east']; ?></td>
								</tr>

								<tr>
								<td><label>River Name:</label></td>
								<td><?php echo $arrDevInfo['bri03river_name']; ?></td>
								<td>&nbsp;</td>
								<td><label>Topo Map Sheet No:</label></label></td>
								<td><?php echo $arrDevInfo['bri03topo_map_no']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Coordinate North:</label></td>
								<td><?php echo $arrDevInfo['bri03coordinate_north']; ?></td>
								</tr>

								<tr>
								<td><label>State:</label></td>
								<td><?php echo $arrDevInfo['province_name'];//$arrDevInfo->dev01name; ?></td>
								<td>&nbsp;</td>
								<td><label>TBSU Region:</label></td>
								<td><?php echo $arrDevInfo['tbis01name']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Road Head:</label></td>
								<td><?php //echo $arrDevInfo->bri03coordinate_north; ?></td>
								</tr>

								<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><label>Porter Distance(Days):</label></td>
								<td><?php echo $arrDevInfo['bri03portering_distance']; ?></td>
								</tr>								
								
								</table>
																
								
							</section>
							<section class="rptInfo2 clearfix" id="BasicTechnicalData">
								<h3 class="reportSubHeader bdrInline bdrBridge">BASIC TECHNICAL DATA:</h3>
								<table class="basic_bridge" cellspacing="5" cellpadding="5">
								<tr>
								<td><label>Main Anchorage Foundation Type at Left Bank:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['left_anc01maf_type_name']; ?></td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td><label>Main Anchorage Foundation Type at Right Bank:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['right_anc01maf_type_name']; ?></td>
								<td>&nbsp;</td>								
								<tr>								
								<td><label>Bank and Slope Protection Structure at Left Bank:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['bri04slope_protection_lb']; ?></td>
								<td>&nbsp;</td>
								</tr>
								<tr>								
								<td><label>Bank and Slope Protection Structure at Right Bank:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['bri04slope_protection_rb']; ?></td>
								<td>&nbsp;</td>
								</tr>
								
								<tr>								
								<td><label>Main(Walkway)Cable Nos:</label></td>
								<td><?php echo $arrDevInfo['cab01mcnww_type_number']; ?></td>
								<td><label>Main(Walkway)Cable Diameter(mm):</label></td>
								<td><?php echo $arrDevInfo['cad01mcdww_type_number']; ?></td>
								<td><label>Handrail Cables 2 Nos. Diameter(mm):</label></td>
								<td><?php echo $arrDevInfo['hdc01hhcn_type_number']; ?></td>
								</tr>
								<tr>								
								<td><label>Windguy Arrangement:</label></td>
								<td><?php echo $arrDevInfo['bri04windguy_arrangement']; ?></td>
								<td><label>Design Standard:</label></td>
								<td><?php echo $arrDevInfo['bri02bds_type_name']; ?></td>
								<td><label>Rust Prevention Type:</label></td>
								<td><?php echo $arrDevInfo['rus01rpm_type_name']; ?></td>
								</tr>
								</table>
																																							
							</section>						
							<div class="costNContri ">
								<h3 class="reportSubHeader  bdrInline">Actual Bridge Cost and Contribution</h3>
								<div class="table-responsive col-lg-12" style="padding:3px;">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="3" class="center"></th>
												<th colspan="14" class="center">Actual Bride Cost in NRs.</th>
											</tr>
                                            
											<tr>
                                            
                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class="LSA center " rowspan="2">'.$dr['sup01sup_agency_code'].'</th>';

                                            }?>

                                        <?php endif;?>
                                        		<th class="center" rowspan="2">Cost In NRs.</th>
												<th class="center" rowspan="2">Cost In %</th> 


											<!--	<th class="center" rowspan="2">DDC:</th>
												<th class="center" rowspan="2">VDC:</th>
												<th class="center" rowspan="2">Community</th>
												<th class="center" rowspan="2">TBSU</th>	
												<th colspan="4" class="center">Nepal Government</th>
												<th class="center" rowspan="2">(I)NGO</th>	
												<th class="center" rowspan="2">Others</th>
												                                                                                                                                              	
											</tr>
                                            <tr>
												<th class="center">RAIDP</th>	
												<th class="center">DRILP</th>
												<th class="center">RRRSDP</th>
												<th class="center">SWAP</th> -->
                                            
                                            </tr>
                                            </thead>
                                            <tbody>

                                    <?php if(is_array( $arrCostCompList )): ?>

                                        <?php foreach( $arrCostCompList as $dr): ?>

                                            <?php // find the respective data of this cid and sid ?>

                                    <tr>

                                        <td class="align">

                                            <?php echo $dr['cmp01component_name'];?>

                                        </td>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr1){

                                                //query and find its data

                                                $blnFound = false;

                                                $selrec = null;

                                                if(isset($arrCstCost) && is_array( $arrCstCost)){

                                                    foreach( $arrCstCost as $k=>$v){

                                                        if( $v['bri08cmp01id'] == $dr['cmp01id'] && 

                                                            $v['bri08sup01id'] == $dr1['sup01id']){

                                                            $selrec = $v;

                                                            $blnFound = true;

                                                          //var_dump( $selrec['bri08amount'] );

                                                            break;

                                                        }

                                                    }

                                                }

                                                $cName = 'cst_cost[C_'.$dr['cmp01id'].'][S_'.$dr1['sup01id'].']';

                                                echo '<td>
                                                    <label style="border:none; background-color: none; "  class="number  ContributionAmt r_'.$dr['cmp01id'].' s_'.$dr1['sup01id'].'" 

                                                        data-row = "r_'.$dr['cmp01id'].'"

                                                        data-col = "s_'.$dr1['sup01id'].'"

                                                        name="'.$cName.'" >
                                                     '.et_setFormVal( 'bri08amount', $selrec).'
                                                    </label>

                                                    </td>';

                                            }?>

                                        <?php endif;?>

										<td><span class="ContributionTotal sub_ContributionTotal <?php echo 'r_'.$dr['cmp01id'];?>">0</span></td>

										<td><label class="color per-ContributionTotal calcPerc" data-denominator=".ContAllTotal.Super_Total" data-numerator=".ContributionTotal.<?php echo 'r_'.$dr['cmp01id'];?>"></label></td>

                                    </tr>

                                        <?php endforeach;?>

                                    <?php endif;?>



                                </tbody>

                                    <tr>

                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class="ContributionTotal LSA center s_'.$dr['sup01id'].'" rowspan="2" >0.00</th>';

                                            }?>

                                        <?php endif;?>

                                        <th class="ContAllTotal Super_Total center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center sumCalc " data-sum=".per-ContributionTotal" rowspan="2">Cost in %</th>

                                    </tr>
                                            
                                                
                                                                                        
                                                                                                                  
                                       
									</table>
									<div class="row">
									<section class="clearfix" id="TotalCost">
									<table class="basic_bridge" cellspacing="5" cellpadding="5">
								<tr>
								<td><label>Total Estimated Cost in NRs:</label></td>
								<td><span class="EsttAllTotal ">0.00</span></td>
								<td><label>Total Actual Bridge Cost in NRs:</label></td>
								<td><span class="ContAllTotal ">0.00</span></td>
								</tr>
								<tr>
								<td><label>Total Estimated Cost per meter Span in NRs:</label></td>
								<td><span class="EsttBYspan">0.00</span></td>
								<td><label>Total Actual Cost per meter Span in NRs:</label></td>
								<td><span class="ContBYspan">0.00</span></td>
								</tr>
								</table>
										<!--<div class="col-lg-12">
											<div class="row">
											<div class="col-lg-6">
											<label>Total Estimated Cost in NRs:</label>
											<span class="EsttAllTotal ">0.00</span>
											</div>
											<div class="col-lg-6">
											<label>Total Actual Bridge Cost in NRs:</label>
											<span class="ContAllTotal ">0.00</span>
											</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row">
											<div class="col-lg-6">
											<label>Total Estimated Cost per meter Span in NRs:</label>
											<span class="EsttBYspan">0.00</span>
											</div>
											<div class="col-lg-6">
											<label>Total Actual Cost per meter Span in NRs:</label>
											<span class="ContBYspan">0.00</span>
											</div>
											</div>									
										</div>-->
									</section>
									</div>									
								</div>
							</div>													
						<div class="clear">
						</div>
							<section class="rptPersonal bdrBridgeTop clearfix" id="PersonnelInvolved">
								<h3 class="reportSubHeader bdrInline bdrBridge">Personnel Involved:</h3>
								
								<table class="basic_bridge" cellspacing="5" cellpadding="5">
								<tr>
								<td><label>Surveyor:</label></td>
								<td><?php echo $arrDevInfo['bri06site_surveyor']; ?></td>
								<td><label>Supervisor:</label></td>
								<td><?php echo $arrDevInfo['bri06site_supervision']; ?></td>
								<td><label>Designer:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['bri06bridge_designer']; ?></td>
								</tr>
								
								<tr>
								<td><label>BMC Chairperson:</label></td>
								<td><?php echo $arrDevInfo['bri06bmc_chairperson']; ?></td>
								<td><label>Community Agreement:</label></td>
								<td><?php echo $arrDevInfo['bri05community_agreement']; ?></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								</tr>
								
								<tr>
								<td><label>UC. Members for Construction:</label></td>
								<td><?php echo $arrDevInfo['bri06uc_members']; ?></td>
								<td><label>BMC Members:</label></td>
								<td><?php echo $arrDevInfo['bri06bmc_members']; ?></td>
								
								<td colspan="4">&nbsp;</td>
								</tr>
								
								<tr>								
								<td><label>Bridge Completion Date:</label></td>
								<td colspan="3"><?php echo $arrDevInfo['bri05bridge_complete']; ?></td>
								<td colspan="4">&nbsp;</td>
								</tr>
								</table>
								
								
							
							
							</section>							
			<div style="display:none;">
            
            <tbody>

                                    <?php if(is_array( $arrCostCompList )): ?>

                                        <?php foreach( $arrCostCompList as $dr): ?>

                                            <?php // find the respective data of this cid and sid ?>

                                    <tr>

                                        <td class="align">

                                            <?php echo $dr['cmp01component_name'];?>

                                        </td>

                                       

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr1){

                                                //query and find its data

                                                $blnFound = false;

                                                $selrec = null;

                                                if(isset($arrEstCost) && is_array( $arrEstCost)){

                                                    foreach( $arrEstCost as $k=>$v){

                                                        if( $v->bri07cmp01id == $dr->cmp01id && 

                                                            $v->bri07sup01id == $dr1->sup01id){

                                                            $selrec = $v;

                                                            $blnFound = true;

                                                            //var_dump( $selrec );

                                                            break;

                                                        }

                                                    }

                                                }

                                                $cName = 'est_cost[C_'.$dr['cmp01id'].'][S_'.$dr1['sup01id'].']';

                                                echo '<td><label class="number form-control EstimatedAmt r_'.$dr['cmp01id'].' s_'.$dr1['sup01id'].'" 

                                                        data-row = "r_'.$dr['cmp01id'].'"

                                                        data-col = "s_'.$dr1['sup01id'].'">
                                                      '.et_setFormVal( 'bri07amount', $selrec).'
                                                   </label>

                                                   
                                                    </td>';

                                            }?>

                                        <?php endif;?>

                                        	<td><span class="EstimatedTotal <?php echo 'r_'.$dr['cmp01id'];?>">0</span></td>

										<td><input class="form-control color"></td>

                                    </tr>

                                        <?php endforeach;?>

                                    <?php endif;?>

                                 <tr>

                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class="EstimatedTotal LSA center s_'.$dr['sup01id'].'" rowspan="2" >0.00</th>';

                                            }?>

                                        <?php endif;?>

                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

                                    </tr>

                                </tbody>
            
            
            </div>					
							
						 <!---footer-->  
         <div class="clear"></div>
         <div class="footer_border1">
            <div class="col-lg-8"><span>Bridge Type*: </span><span>SD=Suspended</span>&nbsp;<span> SN=Suspension </span>&nbsp;<span> ST=Steel Truss </span>&nbsp;</div>
               
         </div>  
         <div class="clear"></div>                                
	<div class="col-lg-4 right"></div>   
                <div class="footer_border2">
 		<div class="col-lg-3"><?php echo _day(); ?></div><div class="col-lg-6 "><span class="center">TBSU Programme Monitoring and Information System (PMIS)</span></div><div class="col-lg-3 right"><!--<span>Page 1 of 3<span> --></div>
               </div>                           
        <!---footer-->   
							
					</div>
					<!--mainBoard ends-->				
				</div>
                <!-- /.row -->               
            </div>
			<!-- /.container-fluid -->

		</div>
 <script>
	
    $(document).ready(function(){


        $(".EstimatedAmt").each(function() {

 

            //$(this).keyup(function(){

                calculateSum1( $(this), 'Estimated' );

            //});

        });

        $(".ContributionAmt").each(function() {

 

            //$(this).keyup(function(){

                calculateSum1( $(this), 'Contribution' );

            //});

        }); 
        $(".R_ContributionAmt").each(function() {

 

            //$(this).keyup(function(){

                calculateSum1( $(this), 'Contribution' );

            //});

        }); 
        //console.log('hhhh');
         $span=<?php  echo $arrDevInfo['bri03design']; ?>;
        $x = sumNum('.sub_ContributionTotal').toFixed(2);
        $('.ContAllTotal').text( $x );
		$xspan = $x/$span;
        $('.ContBYspan').text( $xspan.toFixed(2) );
        
         $spanEst=<?php  echo $arrDevInfo['bri03design']; ?>;
        $xx = sumNum('.EstimatedTotal').toFixed(2);
        $('.EsttAllTotal').text( $xx );
		$xxspan = $xx/$span;
        $('.EsttBYspan').text( $xxspan.toFixed(2) );
        
        //console.log(y);
    });

    function sumNum($selector){

        sum = 0;

        $($selector).each(function() {

            //add only if the value is number

            if(!isNaN(this.value) && this.value.length!=0) {

            sum += parseFloat(this.value);

            }else{
                if(!isNaN($(this).text())){
                    sum += parseFloat($(this).text());
                }
            }

        });

        return sum;

    } 

    function calculateSum1( $obj, $strRef ) {

        colId = $obj.data('col'); 

        rowId = $obj.data('row');
				
		x = sumNum('.'+ $strRef +'Amt.'+ colId).toFixed(2);		       
		y = sumNum('.'+ $strRef +'Amt.'+ rowId).toFixed(2);
				
        $('.'+ $strRef +'Total.'+colId).html(x);

        $('.'+ $strRef +'Total.'+rowId).html(y);

    }

    function calculateSum() {

        return;

    }

</script>       
<?= $this->endSection() ?>