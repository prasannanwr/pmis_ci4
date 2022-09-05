<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">
   <?php //var_dump($arrDevInfo); ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    
                </div>
                <!-- /.row -->

				<div class="row">
					<!--mainBoard starts-->
					<div class="col-lg-12 mainBoard">
                    <div class="alignRight"> 
                     <?php // var_dump($startyear); ?>
                            <form method="post" action="<?php echo site_url();?>/reports/Overall_datewise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
                               <input type="hidden" name="start_date" value="<?php echo $startyear->fis01id; ?>" />
                               <input type="hidden" name="end_date" value="<?php echo $endyear->fis01id; ?>" />
                               <input type="submit"  class="btn btn-md btn-success" name="submit" value="Print" onclick="window.print();return false;" />
                           </form>
                 </div>                    
                             <div class="center bdrBridge">
        						<p class="">Bridge Wise Report</p>
                                <p class="reportSubHeader  ">Basic Record</p>                             
                             </div>

                        <!-- Start Loop -->  
                        
                        <?php
                           
  
                         if(is_array( $arrAllBridgeList)){
                            foreach( $arrAllBridgeList as $k=>$v){
                                foreach( $v as $k1=>$v1){
                                    $arrDevInfo = $v1;
                                    //print_r( $arrAllBridgeList );
                        ?>

                             <div class="D_<?php echo $arrDevInfo->bri03id;?>">
							<section class="rptInfo mrgTop clearfix distcol"  id="BasicData">
                               <h2 style=" margin-top: 20px; text-align: center;">district name:<?php echo $arrDevInfo->dist01name; ?></h2>
								<h3 class="reportSubHeader">BASIC DATA</h3>
                                
							<div class="col-lg-12">
									<div class="row mrgTop">
									<div class="col-lg-4">
									<label class="reportLabel">Bridge Number:</label>
									<span><?php echo $arrDevInfo->bri03bridge_no; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Bridge name:</label>
									<span><?php echo $arrDevInfo->bri03bridge_name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Bridge Type*:</label>
									<span><?php echo $arrDevInfo->bri03bridge_type; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12 bdrBridge">
									<div class="row">
									<div class="col-lg-4">
									<label>Span(m):</label>
									<span><?php echo $arrDevInfo->bri03design; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Walkway Deck Type:</label>
									<span><?php echo $arrDevInfo->wad01walkway_deck_type_name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Walkway W=width(cm):</label>
									<span><?php echo $arrDevInfo->wal01walkway_width; ?></span>
									</div>
									</div>
								</div>
							</section>
							<section class="rptInfo clearfix" id="Location">
								<h3 class="reportSubHeader bdrInline bdrBridge">LOCATION</h3>
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-4">
									<label>District Name-Main:</label>
									<span><?php echo $arrDevInfo->dist01name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>District at left Bank:</label>
									<span><?php echo $arrDevInfo->left_dist01name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>District at right Bank:</label>
									<span><?php echo $arrDevInfo->right_dist01name; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-4">
									<label>Ilaka Number-Main:</label>
									<span><?php echo $arrDevInfo->bri03ward_rb; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Ilaka No.at Left Bank:</label>
									<span><?php echo $arrDevInfo->bri03ward_lb; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Ilaka No.at Right Bank:</label>
									<span><?php echo $arrDevInfo->bri03ward_rb; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-4">
									<label>VDC/Municipality at Left Bank:</label>
									<span><?php echo $arrDevInfo->left_muni01name; ?></span>									
									</div>
									<div class="col-lg-4">
									<label>VDC/Municipality at Right Bank:</label>
									<span><?php echo $arrDevInfo->right_muni01name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Coordinate East:</label>
									<span><?php echo $arrDevInfo->bri03coordinate_east; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-4">
									<label>River Name:</label>
									<span><?php echo $arrDevInfo->bri03river_name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Topo Map Sheet No:</label>
									<span><?php echo $arrDevInfo->bri03topo_map_no; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Coordinate North:</label>
									<span><?php echo $arrDevInfo->bri03coordinate_north; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
									<div class="col-lg-4">
									<label>Development Region:</label>
									<span><?php echo $arrDevInfo->dev01name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>TBSU Region:</label>
									<span><?php echo $arrDevInfo->tbis01name; ?></span>
									</div>
									<div class="col-lg-4">
									<label>Road Head:</label>
									<span><?php // echo $arrDevInfo->tbis01name; ?></span>
									</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-4">
										<label></label>
										<span></span>
										</div>
										<div class="col-lg-4">
										<label></label>
										<span></span>
										</div>
										<div class="col-lg-4">
										<label>Porter Distance(Days):</label>
										<span><?php  echo $arrDevInfo->bri03portering_distance; ?></span>
										</div>
									</div>
								</div>
							</section>
							<section class="rptInfo2 clearfix" id="BasicTechnicalData">
								<h3 class="reportSubHeader bdrInline bdrBridge">BASIC TECHNICAL DATA:</h3>
									<div class="col-lg-12">
										<label>Main Anchorage Foundation Type at Left Bank:</label>
										<span><?php  echo $arrDevInfo->left_anc01maf_type_name; ?></span>									
									</div>
									<div class="col-lg-12">
										<label>Main Anchorage Foundation Type at Right Bank:</label>
										<span><?php  echo $arrDevInfo->right_anc01maf_type_name; ?></span>									
									</div>
									<div class="col-lg-12">
										<label>Bank and Slope Protection Structure at Left Bank:</label>
										<span><?php  echo $arrDevInfo->bri04slope_protection_lb; ?></span>												
									</div>
									<div class="col-lg-12">
										<label>Bank and Slope Protection Structure at Right Bank:</label>
										<span><?php  echo $arrDevInfo->bri04slope_protection_rb; ?></span>
									</div>
								
								<div class="col-lg-12 rptBTDrow2">
									<div class="row">
									<div class="col-lg-3 main">
									<label>Main(Walkway)Cable Nos:</label>
									<span><?php  echo $arrDevInfo->cab01mcnww_type_number; ?></span>
									</div>
									<div class="col-lg-5 mid">
									<label>Main(Walkway)Cable Diameter(mm):</label>
									<span><?php  echo $arrDevInfo->cad01mcdww_type_number; ?></span>
									</div>
									<div class="col-lg-4 mid">
									<label>Handrail Cables 2 Nos. Diameter(mm):</label>
									<span><?php  echo $arrDevInfo->hdc01hhcn_type_number; ?></span>
									</div>
									</div>														
								</div>
								<div class="col-lg-12 rptBTDrow2">
									<div class="row">
									<div class="col-lg-3 main">
									<label>Windguy Arrangement:</label>
									<span><?php  echo $arrDevInfo->bri04windguy_arrangement; ?></span>
									</div>
									<div class="col-lg-5 mid">
									<label>Design Standard:</label>
									<span><?php  echo $arrDevInfo->bri02bds_type_name; ?></span>
									</div>
									<div class="col-lg-4 mid">
									<label>Rust Prevention Type:</label>
									<span><?php  echo $arrDevInfo->rus01rpm_type_name; ?></span>
									</div>			
									</div>									
								</div>
							</section>						
							<div class="costNContri">
								<h3 class="reportSubHeader bdrInline">Actual Bridge Cost and Contribution</h3>
								<div class="table-responsive col-lg-12">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="3" class="center"></th>
												<th colspan="14" class="center">Actual Bride Cost in NRs.</th>
											</tr>
                                            
											<tr>
                                            
                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class="LSA center " rowspan="2">'.$dr->sup01sup_agency_code.'</th>';

                                            }?>

                                        <?php endif;?>
                                        		<th class="center" rowspan="2">Cost In NRs.</th>
												<th class="center" rowspan="2">Cost In %</th> 

                                            </tr>
                                            </thead>
                                            <tbody>

                                    <?php if(is_array( $arrCostCompList )): //var_dump($arrCostCompList); ?>

                                        <?php  $i=1; foreach( $arrCostCompList as $dr): ?>

                                            <?php // find the respective data of this cid and sid ?>

                                    <tr class="row<?php echo $i;?>">

                                        <td class="align">

                                            <?php echo $dr->cmp01component_name;?>

                                        </td>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr1){
                                               //var_dump($arrCstCost);

                                                $cName = 'cst_cost[C_'.$dr->cmp01id.'][S_'.$dr1->sup01id.']';

                                                echo '<td>
                                                <label class="costAmt number bri_'.$arrDevInfo->bri03id.' ContributionAmt r_'.$dr->cmp01id.' s_'.$dr1->sup01id.'" >'.
                                                        (isset($arrCstCost[$arrDevInfo->bri03bridge_no]['cmp_'.$dr->cmp01id]['sup_'.$dr1->sup01id])
                                                        ?$arrCstCost[$arrDevInfo->bri03bridge_no]['cmp_'.$dr->cmp01id]['sup_'.$dr1->sup01id]: 0) 
                                                        .'
                                                        </label>

                                                    

                                                    </td>';

                                            }//end foreach of supplier list
                                        endif; //end if of supplier list 
                                        ?>

										<td><span class="sumCalc ContributionTotal  bri_<?php echo $arrDevInfo->bri03id; ?> <?php echo 's_'.$dr1->sup01id;?> <?php echo 'r_'.$dr->cmp01id;?>" data-sum=".<?php echo 'r_'.$dr->cmp01id;?>.costAmt.bri_<?php echo $arrDevInfo->bri03id; ?>" >0</span></td>

										<td> <label class="calcPerc color" data-numerator=".<?php echo 'r_'.$dr->cmp01id;?>.ContributionTotal.bri_<?php echo $arrDevInfo->bri03id; ?>" data-denominator=".ContAllTotal.bri_<?php echo $arrDevInfo->bri03id;?>"></label> </td>

                                    </tr>
                                    <?php 
                                    $i++;
                                        endforeach; //end foreach of cost comp list
                                    endif; //end if of cost cmp list
                                    ?>



                                </tbody>

                                    <tr>

                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class="sumCalc ContributionTotalB bri_'. $arrDevInfo->bri03id.' LSA center s_'.$dr->sup01id.'" data-sum=" '.'.s_'.$dr->sup01id.'.costAmt.bri_'. $arrDevInfo->bri03id.'" rowspan="2" >0.00</th>';

                                            }?>

                                        <?php endif;?>

                                        <th id="FullTotal_CONT" class="sumCalc ContAllTotal bri_<?php echo $arrDevInfo->bri03id;?> center" rowspan="2" data-sum=".<?php echo 's_'.$dr->sup01id;?>.ContributionTotal.bri_<?php echo $arrDevInfo->bri03id; ?>" >Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

                                    </tr>
                                            
                                                
                                                                                        
                                                                                                                  
                                       
									</table>
									<div class="row">
									<section class="rptTC clearfix" id="TotalCost">
										<div class="col-lg-12">
											<div class="row">
											<div class="col-lg-6">
											<label>Total Estimated Cost in NRs:</label>
											<span class="SameVal EstCostAllTotal bri_<?php echo $arrDevInfo->bri03id;?>" data-out=".FullTotal_EST.bri_<?php echo $arrDevInfo->bri03id;?>">0.00</span>
											</div>
											<div class="col-lg-6">
											<label>Total Actual Bridge Cost in NRs:</label>
											<span class="SameVal ContActAllTotal bri_<?php echo $arrDevInfo->bri03id;?>" data-out=".ContAllTotal.bri_<?php echo $arrDevInfo->bri03id;?>">0.00</span>
											</div>
											</div>
										</div>
										<div class="col-lg-12">
                                         <label style="display: none;" class="bri07totalSpan bri_<?php echo $arrDevInfo->bri03id;?>"><?php  echo $arrDevInfo->bri03design; ?></label>
											<div class="row">
											<div class="col-lg-6">
											<label>Total Estimated Cost per meter Span in NRs:</label>
											<span class="divCalc EsttBYspan" data-numerator=".EstCostAllTotal.bri_<?php echo $arrDevInfo->bri03id;?>" data-denominator=".bri07totalSpan.bri_<?php echo $arrDevInfo->bri03id;?>" >0.00</span>
											</div>
											<div class="col-lg-6">
											<label>Total Actual Cost per meter Span in NRs:</label>
											<span class="divCalc ContBYspan" data-numerator=".ContActAllTotal.bri_<?php echo $arrDevInfo->bri03id;?>" data-denominator=".bri07totalSpan.bri_<?php echo $arrDevInfo->bri03id;?>">0.00</span>
											</div>
											</div>									
										</div>
									</section>
									</div>									
								</div>
							</div>													
						<div class="clear">
						</div>
								
                             <div class="footer_border1 " style="height:5px;"></div> 
                             <div class="clear"></div> 
           						
			<div style="display:none;">/*daya awal*/
            <table>
            <tbody>

                                    <?php if(is_array( $arrCostCompList )): ?>

                                        <?php foreach( $arrCostCompList as $dr): ?>

                                            <?php // find the respective data of this cid and sid ?>

                                    <tr>

                                        <td class="align">

                                            <?php echo $dr->cmp01component_name;?>

                                        </td>

                                       

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr1){


                                                $cName = 'est_cost[C_'.$dr->cmp01id.'][S_'.$dr1->sup01id.']';

                                                echo '<td>
                                                <label class="estAtm number bri_'.$arrDevInfo->bri03id.' form-control EstimatedAmt r_'.$dr->cmp01id.' s_'.$dr1->sup01id.'" >'.
                                                        (isset($arrEstCost[$arrDevInfo->bri03bridge_no]['cmp_'.$dr->cmp01id]['sup_'.$dr1->sup01id])
                                                        ?$arrEstCost[$arrDevInfo->bri03bridge_no]['cmp_'.$dr->cmp01id]['sup_'.$dr1->sup01id]: 0) 
                                                        .'
                                                        </label>

                                                    

                                                    </td>';

                                            }?>

                                        <?php endif;?>
                                        <td><span class="sumCalc EstimatedTotal  bri_<?php echo $arrDevInfo->bri03id; ?> <?php echo 's_'.$dr1->sup01id;?> <?php echo 'r_'.$dr->cmp01id;?>" data-sum=".<?php echo 'r_'.$dr->cmp01id;?>.estAtm.bri_<?php echo $arrDevInfo->bri03id; ?>" >0</span></td>
				

                                    </tr>

                                        <?php endforeach;?>

                                    <?php endif;?>

                                 <tr>

                                        <th class="cost width center" rowspan="2">Total Cost in Rs</th>

                                        <?php if(is_array( $arrSupList)): ?>

                                            <?php foreach( $arrSupList as $dr){

                                                echo '<th class=" LSA center s_'.$dr->sup01id.'" rowspan="2" >0.00</th>';

                                            }?>

                                        <?php endif;?>
                                     <th id="" class="sumCalc FullTotal_EST bri_<?php echo $arrDevInfo->bri03id;?> center" rowspan="2" data-sum=".<?php echo 's_'.$dr->sup01id;?>.EstimatedTotal.bri_<?php echo $arrDevInfo->bri03id; ?>" >Total in NRs.</th>


                                      

										<th class="Tcost center" rowspan="2">Cost in %</th>

                                    </tr>

                                </tbody>
                                </table>
            
            
            </div>
            </div><!-- close of dist bridge -->
            <?php					
                                } //end loop of bridge list
                            
                            } //end loop of dist list ?>
                             
                       <?php  } //end loop for data list
                             
                        ?>
			
            <!-- end loop -->				 
							
					</div>
					<!--mainBoard ends-->				
				</div>
                <!-- /.row -->               
            </div>
			<!-- /.container-fluid -->

		</div>
		<?=$this->endSection();?>       