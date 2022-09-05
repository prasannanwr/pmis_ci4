<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">

		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12 mainBoard">


				<span class="reportHeader">Bridge wise Physical Progress Report (<?php echo $startyear['fis01year'] . ' to ' . $endyear['fis01year']; ?>) as of <?php echo date("j F, Y"); ?></span>
				<p>
				<h4>Filter by Supporting Agency</h4>
				<form name="frmAgencyFilter" method="post" action="<?php echo site_url(); ?>/reports/Pro_Physical_Progress_report">
					<select name="selAgency" onchange="document.frmAgencyFilter.submit();">
						<option value="">--Select--</option>
						<?php
						foreach ($arrsupportList as $sagency) {
						?>
							<option value="<?php echo $sagency['sup01id']; ?>" <?php echo ($selAgency != '' && $selAgency == $sagency['sup01id']) ? 'selected="selected"' : ''; ?>><?php echo $sagency['sup01sup_agency_name']; ?></option>
						<?php } ?>
						<option value="all">All</option>
					</select>
					<input type="hidden" name="start_year" value="<?php echo $dataStart; ?>">
					<input type="hidden" name="end_year" value="<?php echo $dateEnd; ?>">
				</form>
				</p>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="40px" rowspan="2" class="center">SN</th>
								<th width="430px" colspan="3" class="center">Bridge</th>
								<th width="80px" rowspan="2" class="center">Span(m)</th>
								<th width="230px" colspan="2" class="center">Walk Way</th>
								<th width="400px" rowspan="2" class="center">Progress Status</th>
								<th width="" rowspan="2" class="center">Progress in Percentage</th>
							</tr>
							<tr>
								<th width="150px">Number</th>
								<th width="200px">Name</th>
								<th width="80px">Type</th>
								<th width="130px">Type**</th>
								<th width="100px">Width(cm)</th>
							</tr>



						<tbody>
							<?php
							$j = 1;
							if (is_array($arrPrintList)) {
								foreach ($arrPrintList as $k => $dataRow) {
									$sID = str_replace('sup_', '', $k);
									if (!isset($arrsupportList[$k])) {
										echo '<!-- $k: ' . $k . '/Count: ' . count($dataRow) . ' -->';
										continue;
									}
									$arrSupData = $arrsupportList[$k];

									//var_dump($dataRow);
							?>

									<tr>
										<td colspan="22" class="">Supporting Agency : <?php echo $arrSupData['sup01sup_agency_name']; ?></td>
									</tr>
									<?php
									foreach ($dataRow as $k2 => $dataRow1) {
										$DistId = str_replace('dist_', '', $k2);
										if (isset($arrDistrictList[$k2])) {
											$arrDistInfo = $arrDistrictList[$k2];
											if ($arrDistInfo !== 'dist_') {
												//var_dump($dataRow1);
									?>

												<tr>
													<td colspan="22" class="">District: <?php echo $arrDistInfo['dist01name']; ?></td>
												</tr>
												<?php

												$i = 1;
												foreach ($dataRow1 as $k3 => $dataRow4) {
													//print_r($dataRow3);exit;
													foreach ($dataRow4 as $k3 => $dataRow3) {
														$style = '';

														/* if($dataRow3->bri03project_fiscal_year < $currentfy) {
								   if($dataRow3->bri05bridge_complete_check != 1) {
									$style = 'style="background-color:#ddd;"';   
								   }
							   } else {								   
									$style = '';  								   
							   }
							   if($dataRow3->bri03work_category == 1) { //new bridges
								   $style = '';   
							   } else {
								   if($dataRow3->bri05bridge_complete_check != 1) { //carryover bridges
									$style = 'style="background-color:#ddd;"';   
								   } else {
									   $style = '';  
								   }
								   
							   }*/

												?>
														<tr <?php echo $style; ?>>
															<td width="40px"><?php echo $i; ?></td>
															<td width="150px"><?php echo $dataRow3->bri03bridge_no; ?></td>
															<td width="200px"><?php echo $dataRow3->bri03bridge_name; ?></td>
															<td width="80px"><?php echo $dataRow3->bri01bridge_type_code; ?></td>
															<td width="80px"><?php echo $dataRow3->bri03design; ?></td>
															<td width="130px"><?php echo $dataRow3->wad01walkway_deck_type_name; ?></td>
															<td width="100px"><?php echo $dataRow3->wal01walkway_width; ?></td>
															<td width="400px"><?php echo $dataRow3->maxProLabel; ?></td>
															<td><?php echo $dataRow3->proValue; ?>%</td>
														</tr>

							<?php
														$i++;
														$j++;
													}
												}
											}
										}
									}
								}
							}
							?>
							<tr>
								<td colspan="2">Total Bridges:</td>
								<td colspan="7"><?php echo $j - 1; ?></td>
							</tr>

						</tbody>
					</table>
				</div>
				<?php /*<div class="col-lg-12 reportTabHead"><label style="float:left;"><span style="background-color:#ddd;width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;= Carry-over bridges</label>&nbsp;&nbsp;&nbsp;<label style="float:left;"><span style="background-color:white;width:50px;border:1px solid black;margin-left:5px">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;= New bridges</label><label style="float:right;">Weighted Average of All Bridges <span><?php echo $avgWeightage;?>%</span></label></div>*/ ?>
				<div class="col-lg-12 reportTabHead"><label style="float:right;">Weighted Average of All Bridges <span><?php echo $avgWeightage; ?>%</span></label></div>

				<div class="clear"></div>
			</div>
			<!--mainboard ends-->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->

</div>
<?= $this->endSection() ?>