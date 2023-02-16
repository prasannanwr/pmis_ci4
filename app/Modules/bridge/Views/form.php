<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading 

	<form role="form form-group New_Bridge">-->
		<?php if (session()->getFlashdata('warning')) {
			echo "warning: " . session()->getFlashdata('warning');
		} ?>
		<?php echo form_open_multipart($postURL, array('id' => 'emp-form', 'class' => 'form-horizontal panel-body', 'role' => 'form', 'data-form' => 'validate')) ?>

		<?php // var_dump($objOldRec); 
		?>

		<div class="row add_form_btn">
			<?php $valDisable = ($objOldRec && $objOldRec['bri03id'] != '') ? "readonly" : " "; ?>
			<a href="<?php echo site_url(); ?>/bridge/form" class="btn btn-md btn-primary">Add New</a>

			<!-- <input type="submit" name="cmdSubmitX" class="btn btn-md btn-success btnDisableNSave" value="Save and Close">

    <input type="submit" name="cmdSubmitX" class="btn btn-md btn-primary btnDisableNSave" value="Save"> -->
			<a href="<?php echo site_url('bridge/lists'); ?>" class="btn btn-md btn-danger">Close</a>

		</div>

		<div class="row">

			<div class="NewFormTopHeader">

				<div class="header">

					<ul class="nav navbar-nav tabHeads nav-tabs">

						<li class="active"><a href="#Basic_Data">Basic Data and Geographic Info</a></li>

						<li><a href="#Basic_Technical">Basic Technical Data</a></li>

						<li><a href="#Implementation">Implementation Process</a></li>

						<li><a href="#Personnel_Information">Personnel Information</a></li>

						<li><a href="#Estimated_Cost">Estimated Cost &amp; Contribution</a></li>

						<li><a href="#Actual_Cost">Actual Cost &amp; Contribution</a></li>

					</ul>

					<div class="clear"></div>

				</div>

			</div>

		</div>



		<div id='content' class="tab-content">

			<div class="tab-pane active" id="Basic_Data">

				<!--/ start first Bridge .row-->

				<div class="row">

					<div class="col-lg-12">

						<h1 class="page-header font">

							<u>Basic Bridge Data and Geographic Information</u>

						</h1>

					</div>

				</div>

				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="col-lg-4">



							<input type="hidden" class="form-control" name="bri03id" id="bri03id" value="<?php echo et_setFormVal('bri03id', $objOldRec); ?>" />

							<div class="form-group clearfix ">

								<label class="col-lg-5 ">Bridge Name</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_name" id="bri03bridge_name" value="<?php echo et_setFormValBlank('bri03bridge_name', $objOldRec); ?>" />

								</div>

							</div>

							<?php //print_r(getPermittedDistCondStr());
							?>

							<div class="form-group clearfix">

								<label class="col-lg-5 ">District Name Left Bank</label>

								<div class="col-lg-7 ">
									<?php if ($objOldRec && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableDist = "readonly";
										} else {
											$valDisableDist = "";
										}
									} else {
										$valDisableDist = "";
									} ?>
									<?php echo et_form_dropdown_db_dist(
										'bri03district_name_lb',

										'dist01district',
										'dist01name',
										'dist01id',

										et_setFormVal('bri03district_name_lb', $objOldRec),

										getPermittedDists(),
										//'',

										'class="form-control onChangeDist" data-targetvdc="#bri03municipality_lb" ' . $valDisableDist . ' ',
										array('SortBy' => 'dist01name')
									) ?>

								</div>



							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5">RM/UM LB</label>

								<div class="col-lg-7 ">
									<?php if (isset($objOldRec) && $objOldRec != '') {
										echo et_form_dropdown_db(
											'bri03municipality_lb',

											'muni01municipality_vcd',
											'muni01name',
											'muni01id',

											et_setFormVal('bri03municipality_lb', $objOldRec),

											'',
											'class="form-control" ' . $valDisable . '',
											array('SortBy' => 'muni01name DESC')
										);
									} else {
										//$where_clause = array(0 => array("`muni01name` LIKE '%Ga Pa%'"), 1 => array("`muni01name` LIKE '%Na Pa%'"));
										echo et_form_dropdown_palika(
											'bri03municipality_lb',
											'muni01municipality_vcd',
											'muni01name',
											'muni01id',
											'',
											'',
											'class="form-control" ' . $valDisable . '',
											array('SortBy' => 'muni01name DESC')
										);
									}
									?>

								</div>



							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Ward LB</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03ward_lb" id="bri03ward_lb" value="<?php echo et_setFormVal('bri03ward_lb', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Major RM/UM</label>

								<div class="col-lg-7 ">

									<select class="form-control height" name="bri03major_vdc" <?php echo $valDisable; ?>>

										<option value="<?php echo MAJOR_LEFT; ?>" <?php echo MAJOR_LEFT == et_setFormVal('bri03major_vdc', $objOldRec) ? 'selected' : ''; ?>>Left</option>

										<option value="<?php echo MAJOR_RIGHT; ?>" <?php echo MAJOR_RIGHT == et_setFormVal('bri03major_vdc', $objOldRec) ? 'selected' : ''; ?>>Right</option>

									</select>



								</div>

							</div>



							

							<div class="form-group clearfix">

								<label class="col-lg-5  ">Road Head</label>

								<div class="col-lg-7 ">

									<input type="text" class="form-control height" name="bri03road_head" id="bri03road_head" value="<?php echo et_setFormValBlank('bri03road_head', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5">Bridge Type</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03bridge_type', 'bri01bridge_type_table', 'bri01bridge_type_name', 'bri01id', et_setFormVal('bri03bridge_type', $objOldRec), '', 'class="form-control"') ?>





								</div>

							</div>



							



							<!--<div class="form-group clearfix">

										<label class="col-lg-5">Development Region</label>

										<div class="col-lg-7 ">

                     <?php //echo et_form_dropdown_db('bri03development_region', 'dev01development_region', 'dev01name', 'dev01id', et_setFormVal('bri03development_region', $objOldRec), '', 'class="form-control"') 
						?>

										

										</div>

									</div>-->



							<div class="form-group clearfix">

								<label class="col-lg-5 ">Supporting agency</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03supporting_agency', 'sup03basic_supporting_agency', 'sup03sup_agency_name', 'sup03id', et_setFormVal('bri03supporting_agency', $objOldRec), array(array('sup03status','where',1)), 'class="form-control"', array('SortBy' => 'sup03index')) ?>



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 ">Project Fiscal Year</label>

								<div class="col-lg-7 ">
									<?php
									if (isset($objOldRec['bri03id']) && $objOldRec['bri03id'] != '') {
										if ($is_admin == 0) {
											$valDisableFy = "readonly";
										} else {
											$valDisableFy = "";
										}
									} else {
										$valDisableFy = "";
									}

									?>
									<?php echo et_form_dropdown_db('bri03project_fiscal_year', 'fis01fiscal_year', 'fis01year', 'fis01id', et_setFormVal('bri03project_fiscal_year', $objOldRec), '', 'class="form-control" ', array('SortBy' => 'fis01year desc')) ?>
									<?php if ($valDisableFy == 'readonly') { ?>
										<script type="text/javascript">
											$("#bri03project_fiscal_year").css("pointer-events", "none");
										</script>
									<?php } ?>


								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Coordinate North</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03coordinate_north" id="bri03coordinate_north" value="<?php echo et_setFormVal('bri03coordinate_north', $objOldRec); ?>" />



								</div>

							</div>





						</div>

						<div class="col-lg-5">

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Construction Type</label>

								<div class="col-lg-7 ">

									<?php //echo et_form_radio_db('bri03construction_type', 'con02construction_type_table', 'con02construction_type_name', 'con02construction_type_code', et_setFormVal('bri03construction_type', $objOldRec), '', 'class="form-control"') 
									?>
									<?php foreach ($constypeArr as $constructiontype) : ?>
										<input type="radio" name="bri03construction_type" id="bri03construction_type<?php echo $constructiontype['con02construction_type_code']; ?>" value="<?php echo $constructiontype['con02construction_type_code']; ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == $constructiontype['con02construction_type_code']) ? "checked='checked'" : ''; ?>> <label for="bri03construction_type<?php echo $constructiontype['con02construction_type_code']; ?>"><?php echo $constructiontype['con02construction_type_name']; ?></label>
									<?php endforeach; ?>

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">District Name Right Bank</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db_dist('bri03district_name_rb', 'dist01district', 'dist01name', 'dist01id', et_setFormVal('bri03district_name_rb', $objOldRec), getPermittedDists(), 'class="form-control onChangeDist" data-targetvdc="#bri03municipality_rb" ' . $valDisableDist . '', array('SortBy' => 'dist01name')) ?>

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">RM/UM RB</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03municipality_rb', 'muni01municipality_vcd', 'muni01name', 'muni01id', et_setFormVal('bri03municipality_rb', $objOldRec), '', 'class="form-control" ' . $valDisable . '', array('SortBy' => 'muni01name')) ?>





								</div>

							</div>



							<div class="form-group clearfix" style="display:none">

								<label class="col-lg-5 ">Bridge Series</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_series" id="bri03bridge_series" value="<?php echo et_setFormVal('bri03bridge_series', $objOldRec); ?>" />



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Ward RB</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03ward_rb" id="bri03ward_rb" value="<?php echo et_setFormVal('bri03ward_rb', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Portering Distance(Days)</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03portering_distance" id="bri03portering_distance" value="<?php echo et_setFormVal('bri03portering_distance', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Design Span(m)</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03design" id="bri03design" value="<?php echo et_setFormVal('bri03design', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">WW Deck Type</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03ww_deck_type', 'wad01walkway_deck_type_table', 'wad01walkway_deck_type_name', 'wad01id', et_setFormVal('bri03ww_deck_type', $objOldRec), array(array('wad01status','where',1)), 'class="form-control"') ?>





								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">WW Width(cm)</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03ww_width', 'wal01walkway_width_table', 'wal01walkway_width', 'wal01id', et_setFormVal('bri03ww_width', $objOldRec), '', 'class="form-control"',array('SortBy' => 'wal01walkway_sort')) ?>
								</div>

							</div>

							<div class="form-group clearfix" style="display:none">

								<label class="col-lg-5 ">TBSU Regional Office</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03tbsu_regional_office', 'tbis01regional_office', 'tbis01name', 'tbis01id', et_setFormVal('bri03tbsu_regional_office', $objOldRec), '', 'class="form-control"') ?>



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Work Category</label>

								<div class="col-lg-7 ">

									<?php echo et_form_dropdown_db('bri03work_category', 'wkc01work_category_table', 'wkc01work_category_name', 'wkc01id', et_setFormVal('bri03work_category', $objOldRec), '', 'class="form-control"') ?>

								</div>

							</div>



							<div class="form-group clearfix" style="display:none">

								<label class="col-lg-5 ">Topo Map No</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03topo_map_no" id="bri03topo_map_no" value="<?php echo et_setFormVal('bri03topo_map_no', $objOldRec); ?>" />

								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar" style="text-align: left;">Coordinate East</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03coordinate_east" id="bri03coordinate_east" value="<?php echo et_setFormVal('bri03coordinate_east', $objOldRec); ?>" />

								</div>

							</div>





						</div>

						<div class="col-lg-3">

							<div class="form-group clearfix">

								<label class="col-lg-5 ">Bridge No</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03bridge_no" id="bri03bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" readonly="readonly" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5">River Name</label>

								<div class="col-lg-7 ">

									<input type="text" class=" form-control " name="bri03river_name" id="bri03river_name" value="<?php echo et_setFormValBlank('bri03river_name', $objOldRec); ?>" />

								</div>

							</div>

						</div>



					</div>

				</div>

				<!--  /.row -->



			</div> <!-- end first Bridge -->

			<!----start second Bridge--->

			<div class="tab-pane" id="Basic_Technical">

				<div class="row">

					<div class="col-lg-12">

						<h1 class="page-header font">

							Basic Technical Data

						</h1>

					</div>

					<!-- /.row -->

					<div class="row clearfix">

						<div class="col-lg-12">

							<div class="col-lg-6">

								<input type="hidden" class=" form-control " name="bri04id" id="bri04id" value="<?php echo et_setFormVal('bri04id', $objbasicRec); ?>" />

								<div class="form-group clearfix">

									<label class="col-lg-5 ">Foundation Blocks Left Bank</label>

									<div class="col-lg-7 ">

										<?php //echo et_form_dropdown_db('bri04anchorage_foundation_leftbank', 'anc01main_anchorage_foundation_table', 'anc01maf_type_name', 'anc01id', et_setFormVal('bri04anchorage_foundation_leftbank', $objbasicRec), '', 'class="form-control"') ?>
										<select name="bri04anchorage_foundation_leftbank" id="bri04anchorage_foundation_leftbank" class="form-control">
											<option>--Please Select--</option>
											<?php $anc01maf_btype = '';
											foreach ($brianchorage_foundation as $anchorage_foundation) {
												if($anc01maf_btype != '' && $anchorage_foundation->anc01maf_btype != $anc01maf_btype) { ?>
													<optgroup label="&nbsp;&nbsp;">
												<?php } 
												$anc01maf_btype  = $anchorage_foundation->anc01maf_btype;
												if($anchorage_foundation->anc01maf_type_parent != '') {
												?>
												<optgroup label="<?=$anchorage_foundation->anc01maf_type_name;?>">
												<?php } else { ?>
												<option <?=(is_array($objbasicRec) && $anchorage_foundation->anc01id == $objbasicRec['bri04anchorage_foundation_leftbank'])?'selected="selected"':'';?> value="<?=$anchorage_foundation->anc01id;?>"><?=$anchorage_foundation->anc01maf_type_name;?></option>
											<?php } } ?>
										</select>

									</div>

									<div class="clear"></div>

								</div>



								<div class="form-group clearfix">

									<label class="col-lg-5  ">Foundation Blocks Right Bank</label>

									<div class="col-lg-7 ">

										<?php //echo et_form_dropdown_db('bri04anchorage_foundation_rb', 'anc01main_anchorage_foundation_table', 'anc01maf_type_name', 'anc01id', et_setFormVal('bri04anchorage_foundation_rb', $objbasicRec), '', 'class="form-control"') ?>
										<select name="bri04anchorage_foundation_rb" id="bri04anchorage_foundation_rb" class="form-control">
											<option>--Please Select--</option>
											<?php foreach ($brianchorage_foundation as $anchorage_foundation) { 
												if($anchorage_foundation->anc01maf_type_parent != '') {
												?>
												<optgroup label="<?=$anchorage_foundation->anc01maf_type_name;?>">
												<?php } else { ?>
												<option <?=(is_array($objbasicRec) && $objbasicRec['bri04anchorage_foundation_rb'] == $anchorage_foundation->anc01id)?'selected="selected"':'';?> value="<?=$anchorage_foundation->anc01id;?>"><?=$anchorage_foundation->anc01maf_type_name;?></option>
											<?php } } ?>
										</select>

									</div>

									<div class="clear"></div>

								</div>


								<?php
										if(isset($objbasicRec['bri04slope_protection_lb'])) {
											$bri04slope_protection_lb = strtolower(trim($objbasicRec['bri04slope_protection_lb']));	
										}
										if(isset($objbasicRec['bri04slope_protection_rb'])) {
											$bri04slope_protection_rb = strtolower(trim($objbasicRec['bri04slope_protection_rb']));
										}
										$none_arr = array("no","none","0","NA");
										
										?>
								<div class="form-group clearfix">

									<label class="col-lg-5  ">Bank and Slope Protection Left Bank</label>

									<div class="col-lg-7 ">

										<!-- <input type="text" class=" form-control " name="bri04slope_protection_lb" id="bri04slope_protection_lb" value="<?php //echo et_setFormVal('bri04slope_protection_lb', $objbasicRec); ?>" /> -->
										<select name="bri04slope_protection_lb" id="bri04slope_protection_lb" class="form-control valid">
											<option value="">-Select-</option>
											<option <?php if(isset($objbasicRec['bri04slope_protection_lb']) && ($bri04slope_protection_lb == 'yes' || ($bri04slope_protection_lb != '' && !in_array($bri04slope_protection_lb, $none_arr)))) { echo 'selected="selected"';}?> value="yes">Yes</option>
											<option <?php if(isset($objbasicRec['bri04slope_protection_lb']) && (in_array($bri04slope_protection_lb, $none_arr) || $bri04slope_protection_lb == '')) { echo 'selected="selected"'; } ?> value="no">No</option>
										</select>

									</div>

								</div>

								<div class="form-group clearfix">

									<label class="col-lg-5  ">Bank and Slope Protection Right Bank</label>

									<div class="col-lg-7 ">

										<!-- <input type="text" class=" form-control " name="bri04slope_protection_rb" id="bri04slope_protection_rb" value="<?php //echo et_setFormVal('bri04slope_protection_rb', $objbasicRec); ?>" /> -->
										<select name="bri04slope_protection_rb" id="bri04slope_protection_rb" class="form-control valid">
											<option value="">-Select-</option>
											<option <?php if(isset($objbasicRec['bri04slope_protection_rb']) && ($bri04slope_protection_rb == 'yes' || ($bri04slope_protection_rb != '' && !in_array($bri04slope_protection_rb, $none_arr)))) { echo 'selected="selected"';}?> value="yes">Yes</option>
											<option <?php if(isset($objbasicRec['bri04slope_protection_rb']) && (in_array($bri04slope_protection_rb, $none_arr) || $bri04slope_protection_rb == '')) { echo 'selected="selected"'; } ?> value="no">No</option>
										</select>

									</div>

								</div>



								<div class="form-group clearfix">

									<label class="col-lg-5  ">Rust Prevention Measures</label>

									<div class="col-lg-7 ">

										<?php echo et_form_dropdown_db('bri04rust_prevention_measures', 'rus01rust_prev_measures_table', 'rus01rpm_type_name', 'rus01id', et_setFormVal('bri04rust_prevention_measures', $objbasicRec), '', 'class="form-control"') ?>



									</div>

									<div class="clear"></div>

								</div>



								<div class="form-group clearfix">

									<label class="col-lg-5  ">Bridge Design Standard</label>

									<div class="col-lg-7 ">

										<?php echo et_form_dropdown_db('bri04bridge_design_standard', 'bri02bridge_design_standard_table', 'bri02bds_type_name', 'bri02id', et_setFormVal('bri04bridge_design_standard', $objbasicRec), array(0 => array('bri02_status', 'where', '1')), 'class="form-control"') ?>



									</div>

									<div class="clear"></div>

								</div>

							</div>

							<div class="col-lg-6">

								<div class="form-group clearfix">

									<label class="col-lg-5   col">Bridge Name</label>

									<div class="col-lg-7 ">



										<input type="text" readonly="" class="bri03disp_name form-control " name="bri04bridge_name" id="bri03id" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" />

									</div>

								</div>

								<div class="form-group clearfix">

									<label class="col-lg-5   col">Bridge Number</label>

									<div class="col-lg-7 ">

										<input type="text" readonly="" class=" form-control " name="bri04bridge_no" id="bri04bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" />

									</div>

								</div>

								<div class="form-group clearfix">

									<label class="col-lg-5  ">Handrail Cable 2 nos. Dia(mm)</label>

									<div class="col-lg-7 ">

										<?php echo et_form_dropdown_db('bri04handrail_cable_two', 'hdc01handrail_cable2_diameter_table', 'hdc01hhcn_type_number', 'hdc01id', et_setFormVal('bri04handrail_cable_two', $objbasicRec), '', 'class="form-control"') ?>



									</div>

									<div class="clear"></div>

								</div>



								<div class="form-group clearfix">

									<label class="col-lg-5  ">Main(walkway) Cable Nos</label>

									<div class="col-lg-7 ">

										<?php echo et_form_dropdown_db('bri04main_ww_cable_nos', 'cab01main_cable_number_ww_table', 'cab01mcnww_type_number', 'cab01id', et_setFormVal('bri04main_ww_cable_nos', $objbasicRec), '', 'class="form-control"') ?>



									</div>

									<div class="clear"></div>

								</div>







								<div class="form-group clearfix">

									<label class="col-lg-5  ">Main(walkway) Cable Dia(mm)</label>

									<div class="col-lg-7 ">

										<?php echo et_form_dropdown_db('bri04main_ww_cable_dia', 'cad01main_cable_diam_ww_table', 'cad01mcdww_type_number', 'cad01id', et_setFormVal('bri04main_ww_cable_dia', $objbasicRec), '', 'class="form-control"') ?>



									</div>

									<div class="clear"></div>

								</div>



								<div class="form-group clearfix">

									<label class="col-lg-5  ">Windguy Arrangement</label>

									<div class="col-lg-7 ">
										<!--et_setFormVal('bri03river_name', $objOldRec)-->
										<select class="form-control height" name="bri04windguy_arrangement" id="bri04windguy_arrangement">

											<option value="Yes" <?php echo ('Yes' == et_setFormVal('bri04windguy_arrangement', $objbasicRec)) ? 'selected' : ''; ?>>Yes</option>
											<option value="No" <?php echo ('No' == et_setFormVal('bri04windguy_arrangement', $objbasicRec)) ? 'selected' : ''; ?>>No</option>
										</select>

									</div>

									<div class="clear"></div>

								</div>

							</div>

						</div>

					</div>

					<!-- /.row -->





				</div>

			</div>

			<!----end second Bridge--->

			<!----start third Bridge--->



			<div class="tab-pane" id="Implementation">

				<div class="row">

					<div class="col-lg-12">

						<u>
							<h1 class="page-header font">

								Bridge Implementation Process (Dates)

							</h1>
						</u>

					</div>

				</div>

				<?php $mm_disable_field = ($objOldRec && $objOldRec['bri03construction_type'] == 1) ? "style='display:none'" : ""; ?>
				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="col-lg-4">

							<input type="hidden" class="form-control" name="bri05id" id="bri05id" value="<?php echo et_setFormVal('bri05id', $objImplementationRec); ?>" />



							<div class="form-group clearfix">

								<label class="col-lg-5 nopad">Site Assessment and Survey</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05site_assessment_check" id="bri05site_assessment_check" value="1" <?php echo (et_setFormVal('bri05site_assessment_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05site_assessment" id="bri05site_assessment" value="<?php if (isset($objImplementationRec['bri05site_assessment']) && $objImplementationRec['bri05site_assessment'] != "0000-00-00") {
																																					echo et_setFormVal('bri05site_assessment', $objImplementationRec);
																																				} ?>" />

									</div>

								</div>

								<div class="clear"></div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 nopad">Bridge Design and Estimate</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05bridge_design_estimate_check" id="bri05bridge_design_estimate_check" value="1" <?php echo (et_setFormVal('bri05bridge_design_estimate_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />





									</div>

									<div class="col-lg-10 nopad datetimepicker input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05bridge_design_estimate" id="bri05bridge_design_estimate" value="<?php if (isset($objImplementationRec['bri05bridge_design_estimate']) && $objImplementationRec['bri05bridge_design_estimate'] != "0000-00-00") {
																																									echo et_setFormVal('bri05bridge_design_estimate', $objImplementationRec);
																																								} ?>" />



									</div>



								</div>

								<div class="clear"></div>

							</div>


							<div class="form-group clearfix">

								<label class="col-lg-5 nopad">Community (SSTB) / Contract Agreement (LSTB)</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05community_agreement_check" id="bri05community_agreement_check" value="1" <?php echo (et_setFormVal('bri05community_agreement_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05community_agreement" id="bri05community_agreement" value="<?php if (isset($objImplementationRec['bri05community_agreement']) && $objImplementationRec['bri05community_agreement'] != "0000-00-00") {
																																							echo et_setFormVal('bri05community_agreement', $objImplementationRec);
																																						} ?>" />

									</div>



								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"' : ''); ?>>Excavation and Local Material collection</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05first_phase_constrution_check" id="bri05first_phase_constrution_check" value="1" <?php echo (et_setFormVal('bri05first_phase_constrution_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?>">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05first_phase_constrution" id="bri05first_phase_constrution" value="<?php if (isset($objImplementationRec['bri05first_phase_constrution']) && $objImplementationRec['bri05first_phase_constrution'] != "0000-00-00") {
																																									echo et_setFormVal('bri05first_phase_constrution', $objImplementationRec);
																																								} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

							</div>




							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"' : ''); ?>>Material Delivered at Site</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05second_phase_construction_check" id="bri05second_phase_construction_check" value="1" <?php echo (et_setFormVal('bri05second_phase_construction_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05second_phase_construction" id="bri05second_phase_construction" value="<?php if (isset($objImplementationRec['bri05second_phase_construction']) && $objImplementationRec['bri05second_phase_construction'] != "0000-00-00") {
																																										echo et_setFormVal('bri05second_phase_construction', $objImplementationRec);
																																									} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

							</div>



							<div class="form-group clearfix" <?php echo $mm_disable_field; ?>>

								<label class="col-lg-5 nopad">Foundation Completed</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05third_phase_construction_check" id="bri05third_phase_construction_check" value="1" <?php echo (et_setFormVal('bri05third_phase_construction_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05third_phase_construction" id="bri05third_phase_construction" value="<?php if (isset($objImplementationRec['bri05third_phase_construction']) && $objImplementationRec['bri05third_phase_construction'] != "0000-00-00") {
																																										echo et_setFormVal('bri05third_phase_construction', $objImplementationRec);
																																									} ?>" />

									</div>



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 nopad">Final Inspection</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05final_inspection_check" id="bri05final_inspection_check" value="1" <?php echo (et_setFormVal('bri05final_inspection_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05final_inspection" id="bri05final_inspection" value="<?php if (isset($objImplementationRec['bri05final_inspection']) && $objImplementationRec['bri05final_inspection'] != "0000-00-00") {
																																						echo et_setFormVal('bri05final_inspection', $objImplementationRec);
																																					} ?>" />

									</div>



								</div>

							</div>









						</div>

						<div class="col-lg-4">

							<div class="form-group clearfix" <?php echo $mm_disable_field; ?>>

								<label class="col-lg-5 nopad">SOS Orentation</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05sos_orentation_check" id="bri05sos_orentation_check" value="1" <?php echo (et_setFormVal('bri05sos_orentation_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05sos_orentation" id="bri05sos_orentation" value="<?php if (isset($objImplementationRec['bri05sos_orentation']) && $objImplementationRec['bri05sos_orentation'] != "0000-00-00") {
																																					echo et_setFormVal('bri05sos_orentation', $objImplementationRec);
																																				} ?>" />

									</div>



								</div>

								<div class="clear"></div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab"' : ''); ?>>Design Approval</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05design_approval_check" id="bri05design_approval_check" value="1" <?php echo (et_setFormVal('bri05design_approval_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05design_approval" id="bri05design_approval" value="<?php if (isset($objImplementationRec['bri05design_approval']) && $objImplementationRec['bri05design_approval'] != "0000-00-00") {
																																					echo et_setFormVal('bri05design_approval', $objImplementationRec);
																																				} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

								<div class="clear"></div>

							</div>



							<div class="form-group clearfix">
								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"' : ''); ?>>Bridge Completion Target</label>
								<div class="col-lg-7 datebox-container ">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri05bridge_completion_target_check" id="bri05bridge_completion_target_check" value="1" <?php echo (et_setFormVal('bri05bridge_completion_target_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />
									</div>
									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05bridge_completion_target" id="bri05bridge_completion_target" value="<?php if (isset($objImplementationRec['bri05bridge_completion_target']) && $objImplementationRec['bri05bridge_completion_target'] != "0000-00-00") {
																																										echo et_setFormVal('bri05bridge_completion_target', $objImplementationRec);
																												} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"' : ''); ?>>Contract for Fabrication (SSTB only)</label>
								<div class="col-lg-7 datebox-container ">
									<div class="col-lg-2 checkPad ">
										<input type="checkbox" class=" form-control " name="bri05bridge_fabrication_contract_check" id="bri05bridge_fabrication_contract_check" value="1" <?php echo (et_setFormVal('bri05bridge_fabrication_contract_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />
									</div>
									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05bridge_fabrication_contract" id="bri05bridge_fabrication_contract" value="<?php if (isset($objImplementationRec['bri05bridge_fabrication_contract']) && $objImplementationRec['bri05bridge_fabrication_contract'] != "0000-00-00") {
																																										echo et_setFormVal('bri05bridge_fabrication_contract', $objImplementationRec);
																												} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />
									</div>
								</div>
							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'style="color:#adabab;"':'');
																?>>Steel Parts Fabrication completed</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05material_supply_target_check" id="bri05material_supply_target_check" value="1" <?php echo (et_setFormVal('bri05material_supply_target_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'readonly="readonly"':'');
																																																																											?> />

									</div>

									<div class="col-lg-10 nopad  input-group date<?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? '':'date');
																					?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'style="color:#c6c6c6"':'');
																											?>></i></span>

										<input type="text" class=" form-control " name="bri05material_supply_target" id="bri05material_supply_target" value="<?php if (isset($objImplementationRec['bri05material_supply_target']) && $objImplementationRec['bri05material_supply_target'] != "0000-00-00") {
																																									echo et_setFormVal('bri05material_supply_target', $objImplementationRec);
																																								} ?>" <?php //echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"':'');
																																										?> />

									</div>





								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"' : ''); ?>>Anchorage Concreting</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05anchorage_concreting_check" id="bri05anchorage_concreting_check" value="1" <?php echo (et_setFormVal('bri05anchorage_concreting_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05anchorage_concreting" id="bri05anchorage_concreting" value="<?php if (isset($objImplementationRec['bri05anchorage_concreting']) && $objImplementationRec['bri05anchorage_concreting'] != "0000-00-00") {
																																								echo et_setFormVal('bri05anchorage_concreting', $objImplementationRec);
																																							} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

							</div>






							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php //echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab;"':'');
																?>>Bridge Complete</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05bridge_complete_check" id="bri05bridge_complete_check" value="1" <?php echo (et_setFormVal('bri05bridge_complete_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'readonly="readonly"':'');
																																																																						?> />

									</div>

									<div class="col-lg-10 nopad  input-group date">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'style="color:#c6c6c6"':'');
																											?>></i></span>

										<input type="text" class=" form-control " name="bri05bridge_complete" id="bri05bridge_complete" value="<?php if (isset($objImplementationRec['bri05bridge_complete']) && $objImplementationRec['bri05bridge_complete'] != "0000-00-00") {
																																					echo et_setFormVal('bri05bridge_complete', $objImplementationRec);
																																				} ?>" <?php //echo (isset($objOldRec['bri03construction_type) && $objOldRec['bri03construction_type == 1 ? 'readonly="readonly"':'');
																																						?> />

									</div>



								</div>

							</div>


							<div class="form-group clearfix">

								<label class="col-lg-5 nopad">Work Completion Certificate</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05work_completion_certificate_check" id="bri05work_completion_certificate_check" value="1" <?php echo (et_setFormVal('bri05work_completion_certificate_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05work_completion_certificate" id="bri05work_completion_certificate" value="<?php if (isset($objImplementationRec['bri05work_completion_certificate']) && $objImplementationRec['bri05work_completion_certificate'] != "0000-00-00") {
																																											echo et_setFormVal('bri05work_completion_certificate', $objImplementationRec);
																																										} ?>" />

									</div>



								</div>

							</div>














						</div>

						<div class="col-lg-4">

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label col mar">Bridge Name</label>

								<div class="col-lg-7 datebox-container ">

									<input type="text" readonly="" class="bri03disp_name form-control " name="bri05bridge_name" id="bri05bridge_name" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" />



								</div>

								<div class="clear"></div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 control-label col mar">Bridge Number</label>

								<div class="col-lg-7 datebox-container ">







									<input type="text" readonly="" class="form-control " name="bri05bridge_no" id="bri05bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" />





								</div>

								<div class="clear"></div>

							</div>






							<div class="form-group clearfix" <?php echo $mm_disable_field; ?>>

								<label class="col-lg-5 nopad">DMBT</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05dmbt_check" id="bri05dmbt_check" value="1" <?php echo (et_setFormVal('bri05dmbt_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05dmbt" id="bri05dmbt" value="<?php if (isset($objImplementationRec['bri05dmbt']) && $objImplementationRec['bri05dmbt'] != "0000-00-00") {
																																echo et_setFormVal('bri05dmbt', $objImplementationRec);
																															} ?>" />

									</div>



								</div>

							</div>




							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab"' : ''); ?>>Material Supply to UC</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05material_supply_uc_check" id="bri05material_supply_uc_check" value="1" <?php echo (et_setFormVal('bri05material_supply_uc_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05material_supply_uc" id="bri05material_supply_uc" value="<?php if (isset($objImplementationRec['bri05material_supply_uc']) && $objImplementationRec['bri05material_supply_uc'] != "0000-00-00") {
																																							echo et_setFormVal('bri05material_supply_uc', $objImplementationRec);
																																						} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

							</div>



							<div class="form-group clearfix">

								<label class="col-lg-5 nopad" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#adabab"' : ''); ?>>Cable Pulling</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05cable_pulling_check" id="bri05cable_pulling_check" value="1" <?php echo (et_setFormVal('bri05cable_pulling_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>

									<div class="col-lg-10 nopad  input-group <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? '' : 'date'); ?> ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'style="color:#c6c6c6"' : ''); ?>></i></span>

										<input type="text" class=" form-control " name="bri05cable_pulling" id="bri05cable_pulling" value="<?php if (isset($objImplementationRec['bri05cable_pulling']) && $objImplementationRec['bri05cable_pulling'] != "0000-00-00") {
																																				echo et_setFormVal('bri05cable_pulling', $objImplementationRec);
																																			} ?>" <?php echo (isset($objOldRec['bri03construction_type']) && $objOldRec['bri03construction_type'] == 1 ? 'readonly="readonly"' : ''); ?> />

									</div>



								</div>

							</div>


							<div class="form-group clearfix" <?php //echo ($is_admin == 0)?'style="display:none;"':''; 
																?>>

								<label class="col-lg-5 nopad">Bridge Completion Fiscal Year</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " readonly="readonly" name="bri05bridge_completion_fiscalyear_check" id="bri05bridge_completion_fiscalyear_check" value="1" <?php echo (et_setFormVal('bri05bridge_completion_fiscalyear_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group  ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<?php echo et_form_dropdown_db('bri05bridge_completion_fiscalyear', 'fis01fiscal_year', 'fis01year', 'fis01id', et_setFormVal('bri05bridge_completion_fiscalyear', $objImplementationRec), '', 'class="form-control" readonly="readonly"', array('SortBy' => 'fis01year desc')) ?>



									</div>



								</div>

							</div>




							<div class="form-group clearfix" <?php echo $mm_disable_field; ?>>

								<label class="col-lg-5 nopad">Bridge Warden Appointed</label>

								<div class="col-lg-7 datebox-container ">

									<div class="col-lg-2 checkPad ">

										<input type="checkbox" class=" form-control " name="bri05bmc_formation_check" id="bri05bmc_formation_check" value="1" <?php echo (et_setFormVal('bri05bmc_formation_check', $objImplementationRec) == 1) ? 'checked="checked"' : '' ?> />

									</div>

									<div class="col-lg-10 nopad  input-group date ">

										<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

										<input type="text" class=" form-control " name="bri05bmc_formation" id="bri05bmc_formation" value="<?php if (isset($objImplementationRec['bri05bmc_formation']) && $objImplementationRec['bri05bmc_formation'] != "0000-00-00") {
																																				echo et_setFormVal('bri05bmc_formation', $objImplementationRec);
																																			} ?>" />

									</div>



								</div>

							</div>



						</div>



					</div>

				</div>

			</div>


			<!----ens third Bridge--->

			<!----start forth Bridge--->

			<div class="tab-pane" id="Personnel_Information">

				<!--/.row-->

				<div class="row">

					<div class="col-lg-12">

						<u>
							<h1 class="page-header font">

								Personnel Information

							</h1>
						</u>

					</div>

				</div>

				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<input type="hidden" class="form-control" name="bri06id" id="bri06id" value="<?php echo et_setFormVal('bri06id', $objPersonalRec); ?>" />



						<div class="col-lg-4">

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Site Surveyor(s)</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06site_surveyor" id="bri06site_surveyor" rows="2"><?php echo et_setFormVal('bri06site_surveyor', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Design Approved By (Name/Position)</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06design_approved_by" id="bri06design_approved_by" rows="2"><?php echo et_setFormVal('bri06design_approved_by', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">UC Members</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06uc_members" id="bri06uc_members" rows="2"><?php echo et_setFormVal('bri06uc_members', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">(I)NGO Personnel/consultants Trained</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06ngo_consultants_trained" id="bri06ngo_consultants_trained" rows="2"><?php echo et_setFormVal('bri06ngo_consultants_trained', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Name of Contractor</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06uc_contractor" id="bri06uc_contractor" rows="2"><?php echo et_setFormVal('bri06uc_contractor', $objPersonalRec); ?></textarea>

								</div>

							</div>

						</div>

						<div class="col-lg-4">

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Bridge Designer</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06bridge_designer" id="bri06bridge_designer" rows="2"><?php echo et_setFormVal('bri06bridge_designer', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Site Supervision(s)</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06site_supervision" id="bri06site_supervision" rows="2"><?php echo et_setFormVal('bri06site_supervision', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Bridge Craftpersons Trained</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06bridge_craftpersons_trained" id="bri06bridge_craftpersons_trained" rows="2"><?php echo et_setFormVal('bri06bridge_craftpersons_trained', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">BMC Chairperson Name/Address</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06bmc_chairperson" id="bri06bmc_chairperson" rows="2"><?php echo et_setFormVal('bri06bmc_chairperson', $objPersonalRec); ?></textarea>

								</div>

							</div>



						</div>

						<div class="col-lg-4">

							<div class="form-group clearfix">

								<label class="col-lg-4  col">Bridge Name</label>

								<div class="col-lg-8 ">

									<input type="text" readonly="" class="bri03disp_name form-control " name="bri06bridge_name" id="bri06bridge_name" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-4  col">Bridge Number</label>

								<div class="col-lg-8 ">

									<input type="text" readonly="" class="  form-control " name="bri06bridge_no" id="bri06bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" />



								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">UC Chairperson Name/Address</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06uc_chairperson" id="bri06uc_chairperson" rows="2"><?php echo et_setFormVal('bri06uc_chairperson', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<span class="col-lg-4 ">Palika Technician Trained</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06ddc_technician_trained" id="bri06ddc_technician_trained" rows="2"><?php echo et_setFormVal('bri06ddc_technician_trained', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<div class="form-group clearfix">

								<!-- <span class="col-lg-4 ">BMC Members</span> -->
								<span class="col-lg-4 ">Bridge warden name & contact Number / address</span>

								<div class="col-lg-8 ">

									<textarea class="form-control" name="bri06bmc_members" id="bri06bmc_members" rows="2"><?php echo et_setFormVal('bri06bmc_members', $objPersonalRec); ?></textarea>

								</div>

							</div>

							<!--	<div class="form-group clearfix">

										<span class="col-lg-4 ">Bridge Name</span>

										<div class="col-lg-8 ">

										  <textarea class="form-control" rows="2"></textarea>

										</div>

								</div> -->



						</div>

					</div>

				</div>

				<!-- /.row -->



			</div>



			<!----end forth Bridge--->



			<!----start fifth Bridge---->



			<div class="tab-pane" id="Estimated_Cost">

				<!--/.row-->

				<div class="row form-group">

					<div class="form-group" style="text-align: center;">
						<h3 class="">

							Estimated Cost and Contribution Commitment

						</h3>
					</div>

					<div class="col-lg-12">

						<div class="col-lg-4">

							<div class="form-group clearfix">


								<div class="col-lg-7 marB">


								</div>

							</div>
							<div class="form-group clearfix">


								<div class="col-lg-7 marB">


								</div>

							</div>



						</div>


						<div class="col-lg-4">

							<!-- <h4 class=""style="text-align:center;">contribution of agencies</h4> -->

							<?php if ($objOldRec && $objOldRec['bri03id'] != '') {
								$bridgeid = $objOldRec['bri03id']; ?>

								<div class="form-group clearfix">
									<?php if ($objOldRec['cost_estimated_reference'] != '') { ?>
										<label class="col-lg-5 control-label mar col">Estimated cost for reference</label>

										<div class="col-lg-7 marB">

											<input type="text" name="referencecost" id="referencecost" class="bri03disp_name form-control valid" readonly value="<?php echo $objOldRec['cost_estimated_reference']; ?>">

										</div>
									<?php } else { ?>
										<input class="col-lg-8 mar col" type="button" name="btnref" id="btnref" value="Save estimated cost for reference" />
										<div class="col-lg-4 marB">
											<input type="text" name="referencecost" id="referencecost" class="bri03disp_name form-control valid" readonly value="" style="display:none;">
										</div>
									<?php } ?>

								</div>

								<!-- <div class="form-group clearfix">									

									<div class="marB">
	                                      
					            		<div style="float:right;">
					            			<?php if ($objOldRec['cost_estimated_reference'] != '') { ?>
					            			<label class="col-lg-5 control-label mar col">Estimated cost for reference</label>
					            			<div style="float:right;margin-right:6px;">
					            				<input type="text" name="referencecost" id="referencecost" class="bri03disp_name form-control valid" readonly value="<?php echo $objOldRec['cost_estimated_reference']; ?>">
					            			</div>
					            			<?php } else { ?>
					            			<div style="float:right;margin-right:6px;">
					            				<input type="button" name="btnref" id="btnref" value="Save estimated cost for reference" />&nbsp;<input type="text" name="referencecost" id="referencecost" class="bri03disp_name form-control valid" readonly value="" style="display:none;">
					            			</div>
					            			<?php } ?>
					            		</div>			            		

            		   				</div>

								</div> -->
							<?php } else {
								$bridgeid = '';
							} ?>
						</div>


						<div class="col-lg-4">

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar col">Bridge Name</label>

								<div class="col-lg-7 marB">

									<input type="text" readonly="" class="bri03disp_name form-control " name="bri07bridge_name" id="bri07bridge_name" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" />

								</div>

							</div>
							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar col">Bridge Number</label>

								<div class="col-lg-7 marB">

									<input type="text" readonly="" class="  form-control " name="bri07bridge_no" id="bri07bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" />

								</div>

							</div>



						</div>

					</div>

				</div>

				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="table-responsive">

							<table class="table table-hover">

								<thead>



									<tr>
										<?php $restrict_arr = array("sdc","raidp","drilp","rrrsdp","rap","unnati","ingo");?>
										<th class="cost width center" rowspan="2">Cost Components</th>
										<?php if (is_array($countLocal)) {
											foreach ($countLocal as $LocalRow) { 
												$agency_name = strtolower(trim($LocalRow['sup01sup_agency_name']));
												if(!(in_array($agency_name, $restrict_arr))) {
												?>
												<th class="LSA center" rowspan="2"><?php echo $LocalRow['sup01sup_agency_name']; ?></th>
										<?php
												}
											}
										}
										?>

										<!-- <th class="GON center" colspan="<?php //echo count($countGovt); ?>">Government of Nepal</th> -->
										<th class="GON center" colspan="<?php echo count($countGovt); ?>">&nbsp;</th>

										<?php if (is_array($countOther)) {
											foreach ($countOther as $OtherRow) { 
												$agency_name = strtolower(trim($OtherRow['sup01sup_agency_name']));
												if(!(in_array($agency_name, $restrict_arr))) {
												?>
												<th class="others center" rowspan="2"><?php echo $OtherRow['sup01sup_agency_name']; ?></th>
										<?php
												}
											}
										}
										?>

										<th class="Tcost center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

									</tr>

									<tr>
										<?php if (is_array($countGovt)) {
											foreach ($countGovt as $GovtRow) {
												$agency_name = strtolower(trim($GovtRow['sup01sup_agency_name']));
												if(!(in_array($agency_name, $restrict_arr))) {
											 ?>
												<th class="GON center"><?php echo $GovtRow['sup01sup_agency_name']; ?></th>
										<?php
												}
											}
										}
										?>

									</tr>



									<!--  <tr>

                                        <th class="cost width center" rowspan="2">Cost Components</th>

                                      <?php // if(is_array( $arrSupList)): 
										?>

                                            <?php // foreach( $arrSupList as $dr){

											// echo '<th class="LSA center " rowspan="2">'.$dr['sup01sup_agency_code'].'</th>'; -->

											// }
											?>

                                        <?php // endif;
										?>

                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

                                    </tr> -->

								</thead>

								<tbody>

									<?php if (is_array($arrCostCompList)) : ?>

										<?php foreach ($arrCostCompList as $dr) : ?>

											<?php // find the respective data of this cid and sid 
											?>

											<tr>

												<td class="align">

													<?php echo $dr['cmp01component_name']; ?>

												</td>



												<?php if (is_array($arrSupList)) : ?>

													<?php foreach ($arrSupList as $dr1) {

														//query and find its data

														$blnFound = false;

														$selrec = null;

														if (isset($arrEstCost) && is_array($arrEstCost)) {

															foreach ($arrEstCost as $k => $v) {

																if (
																	$v['bri07cmp01id'] == $dr['cmp01id'] &&

																	$v['bri07sup01id'] == $dr1['sup01id']
																) {

																	$selrec = $v;

																	$blnFound = true;

																	//var_dump( $selrec );

																	break;
																}
															}
														}

														$cName = 'est_cost[C_' . $dr['cmp01id'] . '][S_' . $dr1['sup01id'] . ']';
														$amt = et_setFormVal('bri07amount', $selrec);
														if ($amt == '')
															$amt = 0;

														echo '<td>

                                                    <input type="text" class="number form-control EstimatedAmt r_' . $dr['cmp01id'] . ' s_' . $dr1['sup01id'] . '" 

                                                        data-row = "r_' . $dr['cmp01id'] . '"

                                                        data-col = "s_' . $dr1['sup01id'] . '"

                                                        name="' . $cName . '" 

                                                        value="' . $amt . '">

                                                    </td>';
													} ?>

												<?php endif; ?>
												<td><span class="EstimatedTotal s_<?php echo $dr1['sup01id']; ?> r_<?php echo $dr['cmp01id']; ?> sumCalc" data-sum=".EstimatedAmt.r_<?php echo $dr['cmp01id']; ?>">0</span></td>


												<td class="EstimatedTotalPercent calcPerc center" data-numerator=".EstimatedTotal.r_<?php echo $dr['cmp01id']; ?>" data-denominator=".EstimatedOverallTotal.Tcost" rowspan="">0</td>

											</tr>

										<?php endforeach; ?>

									<?php endif; ?>

									<tr>

										<th class="cost width center" rowspan="2">Total Cost in Rs</th>

										<?php if (is_array($arrSupList)) : ?>

											<?php foreach ($arrSupList as $dr) {

												echo '<th class="sumCalc Sup_EstimatedTotal LSA center s_' . $dr['sup01id'] . '" rowspan="2" data-sum=".EstimatedAmt.s_' . $dr['sup01id'] . '" >0.00</th>';
											} ?>

										<?php endif; ?>

										<th class="Tcost EstimatedOverallTotal totalEstimated_for_actual sumCalc center" data-sum=".Sup_EstimatedTotal" rowspan="2">Total in NRs.</th>

										<th class="Tcost  center" data-sum=".EstimatedTotalPercent" rowspan="2"></th>
										<!--	<th class="Tcost sumCalc center" data-sum=".EstimatedTotalPercent" rowspan="2">Cost in %</th>-->

									</tr>

								</tbody>

							</table>

						</div>

					</div>

				</div>

				<!-- /.row -->



				<!-- /.row -->



			</div>



			<!----end fifth Bridge---->



			<!----start six Bridge---->



			<div class="tab-pane" id="Actual_Cost">

				<!--/.row-->

				<div class="row">

					<h3 class="form-group" style="text-align:center;">contribution of agencies</h3>

					<div class="col-lg-12 ">



						<div class="col-lg-4">

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar col">Total Estimated Cost</label>

								<div class="col-lg-7 marB">

									<input type="text" readonly="" class="SameVal form-control" data-out=".totalEstimated_for_actual" value="0.00" />

									<!---	<input class="form-control height col"> -->

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar">Actual Span</label>

								<div class="col-lg-7 marB">
									<input type="text" class="form-control " name="bri03e_span" id="bri03e_span" value="<?php echo et_setFormVal('bri03e_span', $objOldRec); ?>" />

									<!--	<input class="form-control height"> -->

								</div>

							</div>



						</div>

						<div class="col-lg-4">



						</div>

						<div class="col-lg-4">

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar col">Bridge Name</label>

								<div class="col-lg-7 marB">

									<input type="text" readonly="" class="bri03disp_name form-control " name="bri08bridge_name" id="bri08bridge_name" value="<?php echo et_setFormVal('bri03bridge_name', $objOldRec); ?>" />

								</div>

							</div>

							<div class="form-group clearfix">

								<label class="col-lg-5 control-label mar col">Bridge Number</label>

								<div class="col-lg-7 marB">

									<input type="text" readonly="" class="  form-control " name="bri08bridge_no" id="bri08bridge_no" value="<?php echo et_setFormVal('bri03bridge_no', $objOldRec); ?>" />

								</div>

							</div>



						</div>

					</div>

				</div>

				<!-- /.row -->

				<div class="row clearfix">

					<div class="col-lg-12">

						<div class="table-responsive">

							<table class="table table-hover">

								<thead>

									<!--

                                    <tr>

                                        <th class="cost width center" rowspan="2">Cost Components</th>

                                        <th class="LSA center" rowspan="2">DDC</th>

                                        <th class="LSA center" rowspan="2">VDC</th>

                                        <th class="LSA center" rowspan="2">Community</th>

										<th class="LSA center" rowspan="2">TBSU</th>

										<th class="GON center" colspan="4">Government of Nepal</th>                               

                                        <th class="others center" rowspan="2">(I)NGO</th>

                                        <th class="others center" rowspan="2">OTHERS</th>

                                        <th class="Tcost center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

                                    </tr>

									<tr>

										<th class="GON center">RAIDP</th>

                                        <th class="GON center">DRILP</th>

                                        <th class="GON center">RRRSDP</th>

										<th class="GON center">SWAP</th>								

									</tr>

                                    -->

									<tr>

										<th class="cost width center" rowspan="2">Cost Components</th>
										<?php if (is_array($countLocal)) {
											foreach ($countLocal as $LocalRow) { ?>
												<th class="LSA center" rowspan="2"><?php echo $LocalRow['sup01sup_agency_name']; ?></th>
										<?php
											}
										}
										?>

										<!-- <th class="GON center" colspan="<?php //echo count($countGovt); ?>">Government of Nepal</th> -->
										<th class="GON center" colspan="<?php echo count($countGovt); ?>">&nbsp;</th>

										<?php if (is_array($countOther)) {
											foreach ($countOther as $OtherRow) { ?>
												<th class="others center" rowspan="2"><?php echo $OtherRow['sup01sup_agency_name']; ?></th>
										<?php
											}
										}
										?>

										<th class="Tcost center" rowspan="2">Total in NRs.</th>

										<th class="Tcost center" rowspan="2">Cost in %</th>

									</tr>
									<tr>
										<?php if (is_array($countGovt)) {
											foreach ($countGovt as $GovtRow) { ?>

												<th class="GON center"><?php echo $GovtRow['sup01sup_agency_name']; ?></th>
										<?php
											}
										}
										?>

									</tr>

								</thead>

								<tbody>

									<?php if (is_array($arrCostCompList)) : ?>

										<?php foreach ($arrCostCompList as $dr) : ?>

											<?php // find the respective data of this cid and sid 
											?>

											<tr>

												<td class="align">

													<?php echo $dr['cmp01component_name']; ?>

												</td>

												<?php if (is_array($arrSupList)) : ?>

													<?php foreach ($arrSupList as $dr1) {

														//query and find its data

														$blnFound = false;

														$selrec = null;

														if (isset($arrCstCost) && is_array($arrCstCost)) {

															foreach ($arrCstCost as $k => $v) {

																if (
																	$v['bri08cmp01id'] == $dr['cmp01id'] &&

																	$v['bri08sup01id'] == $dr1['sup01id']
																) {

																	$selrec = $v;

																	$blnFound = true;

																	//var_dump( $selrec );

																	break;
																}
															}
														}

														$cName = 'cst_cost[C_' . $dr['cmp01id'] . '][S_' . $dr1['sup01id'] . ']';
														$amt = et_setFormVal('bri08amount', $selrec);
														if ($amt == '')
															$amt = 0;

														echo '<td>

                                                    <input type="text" class="number form-control ContributionAmt r_' . $dr['cmp01id'] . ' s_' . $dr1['sup01id'] . '" 

                                                        data-row = "r_' . $dr['cmp01id'] . '"

                                                        data-col = "s_' . $dr1['sup01id'] . '"

                                                        name="' . $cName . '" 

                                                        value="' . $amt . '">

                                                    </td>';
													} ?>

												<?php endif; ?>

												<td><span class="ContributionTotal s_<?php echo $dr1['sup01id']; ?> <?php echo 'r_' . $dr['cmp01id']; ?> sumCalc" data-sum=".ContributionAmt.<?php echo 'r_' . $dr['cmp01id']; ?>">0</span></td>

												<td class="ContributionTotalPercent calcPerc center" data-numerator=".ContributionTotal.r_<?php echo $dr['cmp01id']; ?>" data-denominator=".ContributionOverallTotal.Tcost" rowspan="">0</td>

											</tr>

										<?php endforeach; ?>

									<?php endif; ?>



								</tbody>

								<tr>

									<th class="cost width center" rowspan="2">Total Cost in Rs</th>

									<?php if (is_array($arrSupList)) : ?>

										<?php foreach ($arrSupList as $dr) {

											echo '<th class="sumCalc Sup_ContributionTotal LSA center  s_' . $dr['sup01id'] . '" rowspan="2" data-sum=".ContributionAmt.s_' . $dr['sup01id'] . ' " >0.00</th>';
										} ?>

									<?php endif; ?>

									<th class="Tcost ContributionOverallTotal sumCalc TotalCont center" data-sum=".Sup_ContributionTotal" rowspan="2">Total in NRs.</th>

									<!--<th class="  center" data-sum=".ContributionTotalPercent" rowspan="2"></th>-->
									<!--<th class=" sumCalc center" data-sum=".ContributionTotalPercent" rowspan="2">Cost in %</th>-->

								</tr>

							</table>

						</div>

					</div>

				</div>

				<!-- /.row -->



				<!-- /.row -->





			</div>



			<!----end six Bridge---->



		</div>
		<div class="row add_form_btn">
			<?php $valDisable = ($objOldRec && $objOldRec['bri03id'] != '') ? "readonly" : " "; ?>
			<input type="button" name="cmd_Submit" class="btn btn-md btn-success btnDisableNSave" value="Save and Close">
			<input type="button" name="cmd_Submit" class="btn btn-md btn-primary btnDisableNSave" value="Save">
			<input type="hidden" name="cmdSubmit" value="" class="tgSubmit">
			<a href="<?php echo site_url(); ?>bridge" class="btn btn-md btn-danger">Close</a>
		</div>


		</form>

	</div> <!-- /.container-fluid -->


</div>
<script>
	$(document).ready(function() {

		$('.tabHeads li a').click(function(e) {
			e.preventDefault()
			$(this).tab('show')
		});
		//iterate through each textboxes and add keyup

		//handler to trigger sum event
		$(".EstimatedAmt").each(function() {
			$(this).keyup(function() {
				calculateSum1($(this), 'Estimated');
				//calculate grand total
				//calculate percent
				reCalc();
			});
		});

		$(".ContributionAmt").each(function() {
			$(this).keyup(function() {
				calculateSum1($(this), 'Contribution');
				reCalc();
			});
		});
	});

	function sumNum($selector) {
		sum = 0;
		$($selector).each(function() {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				sum += parseFloat(this.value);
			}
		});
		// console.log($selector);
		// console.log(sum);
		return sum;
	}

	function calculateSum1($obj, $strRef) {
		colId = $obj.data('col');
		rowId = $obj.data('row');
		x = sumNum('.' + $strRef + 'Amt.' + colId).toFixed(2);
		y = sumNum('.' + $strRef + 'Amt.' + rowId).toFixed(2);
		$('.' + $strRef + 'Total.' + colId).html(x);
		$('.' + $strRef + 'Total.' + rowId).html(y);
	}

	function calculateSum() {
		return;
	}
</script>

<script>
	$arrVDCList = <?php echo json_encode($arrVDCList); ?>;
	$fcase = <?php echo ($objOldRec && $objOldRec['bri03id'] != '') ? 1 : 0; ?>;
	//$lVDCID = <?php // echo (property_exists($objOldRec, 'bri03municipality_lb') && $objOldRec['bri03municipality_lb'] =='')? 1: 0  ;
				?>;
	//$rVDCID = <?php // echo (property_exists($objOldRec, 'bri03municipality_rb') && $objOldRec['bri03municipality_rb'] =='')? 1: 0  ;
				?>;
	$lVDCID = <?php echo ($objOldRec && $objOldRec['bri03municipality_lb'] != '') ? $objOldRec['bri03municipality_lb'] : 0; ?>;
	$rVDCID = <?php echo ($objOldRec && $objOldRec['bri03municipality_rb'] != '') ? $objOldRec['bri03municipality_rb'] : 0; ?>;

	function popCombo($strTarget, $arrList, $strBind, $strDisp, $strSel) {
		$strRet = '';
		$.each($arrList, function() {
			$strRet += '<option value="' + this[$strBind] + '">' + this[$strDisp] + '</option>';
		});
		$($strTarget).append($strRet);
	}

	function onChangeDistrict($targetObj, $srcSelDist) {
		items = $arrVDCList.filter(function(item) {
			return (item.dist01id == $srcSelDist);
		});
		$($targetObj).html('');
		popCombo($targetObj, items, 'muni01id', 'muni01name');
	}

	$('.onChangeDist').on('change', function() {
		$target = $(this).data('targetvdc');
		onChangeDistrict($target, $(this).val());
	});

	//$arrDistList = <?php //echo ''; 
						?>;

	$(document).ready(function() {

		$('#bri03bridge_name').on('change', function() {
			$('.bri03disp_name').val($(this).val());
		});

		//$('.onChangeDist').trigger('change');
		if ($fcase == 1) {
			$('#bri03municipality_lb').val($lVDCID);
			$('#bri03municipality_rb').val($rVDCID);
		} else {}

		$('.datebox-container .checkPad input').on('change', function() {

			if ($(this).is(":checked")) {

				$target = $(this).closest('.datebox-container');

				$target.find('.date input').val('<?php echo _day(); ?>');

			} else {
				$target = $(this).closest('.datebox-container');

				$target.find('.date input').val('');
			}

		});

		$('#btnref').on('click', function(e) {
			e.preventDefault();
			//alert('tst');
			var estimatedtotal = $(".EstimatedOverallTotal").val();
			var bri03id = '<?php echo $bridgeid; ?>';
			var savecostURL = '<?php echo $savecostURL; ?>';

			$.ajax({
				method: 'POST',
				url: savecostURL,
				data: {
					bid: bri03id,
					cost: estimatedtotal
				},
				success: function(msg) {
					$("#referencecost").show();
					$("#referencecost").val(estimatedtotal);
				}
			});
		});

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$('.btnDisableNSave').on('click', function(e) {
			$(this).attr('readonly', 'readonly');
			$('.tgSubmit').val($(this).attr('value'));
			$(this).closest('form').submit();
		});
		$('[autofocus]:not(:focus)').eq(0).focus();

		$('#emp-form').validate({
			rules: {
				EstimatedAmt: {
					number: true,
					maxlength: 10
				},
				ContributionAmt: {
					required: true,
					maxlength: 10
				},
				bri03e_span: {
					number: true,
					maxlength: 10
				},
			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element.addClass('valid').closest('.form-group').removeClass('error');
			}
		});

		//bridge type on change
		$("#bri03bridge_type").on('change', function() {
			var anchorage_url = '<?php echo $anchorageUrl; ?>';
			var btype = $(this).val();
			//console.log(anchorage_url);
			$.ajax({
				method: 'GET',
				url: anchorage_url,
				data: {
					btype: btype
				},
				success: function(msg) {
					if (msg) {
						$("#bri04anchorage_foundation_rb,#bri04anchorage_foundation_leftbank").html(msg);
					}
				}
			});
		});

	});
</script>
<?= $this->endSection() ?>