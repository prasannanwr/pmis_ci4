<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
<div id="page-wrapper" class="largeRpt">
<div class="alignLeft noPrint" style="float:left;">
    <form name="frmDistrictFilter" method="post" action="<?php echo site_url();?>/reports/Gen_Dist_FYWise_report">
         <select name="selFilterByDistrict" class="form-control" onchange="this.form.submit();">
            <option value="">--Filter by District--</option>
       <?php foreach($selDist as $k=>$v){        
        ?>
        <option value="<?php echo $v->dist01id;?>" <?php echo ($v->dist01id == $sel_district_filter)?'selected="selected"':'';?>><?php echo $v->dist01name;?></option>
        <?php
        }
        ?>       
   </select>
   <input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
       <input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
       </form>
   </div>
	<div class="alignRight">
		<form method="post" action="<?php echo site_url();?>/reports/Gen_Dist_FYWise_print<?php echo (isset($blnMM) && $blnMM)? '/'.MM_CODE: ''; ?>" target="_blank">
			<input type="hidden" name="start_year" value="<?php echo $startyear->fis01id; ?>" />
			<input type="hidden" name="end_year" value="<?php echo $endyear->fis01id; ?>" />
			<input type="submit" class="btn btn-md btn-success btn-print" name="submit" value="Print" data-target="printArea" />
		</form>
	</div>
	<div class="container-fluid" id="printArea">
		<div class="row">
			<div class="col-lg-12 mainBoard">
				
				
				<h2 class="reportHeader center">List of Completed Bridges (FY <?php echo $startyear->fis01year."-".$endyear->fis01year;?>)</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:55px;" rowspan="2" class="center">SN</th>
								<th colspan="4" class="center">Bridge</th>
								<th style="width:150px;" rowspan="2" class="center">River Name</th>
								<th colspan="2" class="center">Walk Way Deck</th>
								<th rowspan="2">Topo Map sheet Number</th>
								<th colspan="2" class="center">Co-ordinate</th>
								<th colspan="2" class="center">VCD/Municipality</th>
								<th rowspan="2">Completion Date</th>
							</tr>
							<tr>
								<th style="width:120px;" class="center">Number</th>
								<th style="width:120px;" class="center">Name</th>
								<th style="width: 60px;" class="center">Type*</th>
								<th style="width:75px;" class="center">Span(m)</th>
								<th style="width:120px;" class="center">Type</th>
								<th style="width:100px;" class="center">Width(cm)</th>
								<th style="width: 120px;" class="center">North</th>
								<th style="width: 120px;" class="center">East</th>
								<th style="width: 120px;" class="center">Left Bank</th>
								<th style="width: 120px;" class="center">Right Bank</th>
							</tr>
						</thead>
						
						
						<?php
						if(is_array($arrPrintList)){
							$sum1 = 0;
							foreach($arrPrintList as $dataRow){

						
						?>
						<tr>
							<td colspan="22">
								<div class="col-lg-12"><b><span>District:<?php echo $dataRow['dist']->dist01name;  ?></span></b></div>
								<div class="col-lg-6"><b><span>TBSU Region:<?php // echo $dataRow['dist']->tbis01name;  ?></span></b></div><div class="col-lg-6"><b><span style="float:right;">Development Region:<?php echo $dataRow['dist']->dev01name;  ?></span></b></div>
							</td>
						</tr>
						<tbody>
							<?php
							$i=0; foreach($dataRow['data'] as $dataRow1){
							//var_dump($dataRow1);
							
							?>
							<tr>
								<td style="width:55px;"><?php echo $i + 1; ?></td>
								<td style="width:120px;"><?php echo $dataRow1->bri03bridge_no; ?></td>
								<td style="width:120px;"><?php echo $dataRow1->bri03bridge_name; ?></td>
								<td style="width:60px;"><?php echo $dataRow1->bri01bridge_type_name; ?></td>
								<td style="width:75px;"><?php echo $dataRow1->bri03design; ?></td>
								<td style="width:150px;"><?php echo $dataRow1->bri03river_name; ?></td>
								<td style="width:120px;"><?php echo $dataRow1->wad01walkway_deck_type_name; ?></td>
								<td style="width:100px;"><?php echo $dataRow1->wal01walkway_width; ?></td>
								<td><?php echo $dataRow1->bri03topo_map_no; ?></td>
								<td><?php echo $dataRow1->bri03coordinate_north; ?></td>
								<td><?php echo $dataRow1->bri03coordinate_east; ?></td>
								<td style="width: 120px;"><?php echo $dataRow1->left_muni01name; ?></td>
								<td style="width: 120px;"><?php echo $dataRow1->right_muni01name; ?></td>
								<td><?php echo $dataRow1->bri05bridge_complete; ?></td>
							</tr>
							<?php $i++;} ?>
							<tr>
								<td colspan="14">Total District Bridge: <?php echo $i;?></td>
							</tr>
						</tbody>
						<?php
							$sum1 += $i;
						}	//end for loop of overall
						
						}
						?>
						<tr>
							<td colspan="14">Total Overall Bridge: <?php echo $sum1;?></td>
						</tr>
					</table>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		<!-- /.row -->
		
	</div>
	<!-- /.container-fluid -->
</div>
<?=$this->endSection();?>