<?php

	$log_set = array();
	
	foreach($log_info as $l)
	{
		$log_set[$l->org_name][$l->dep_name][] = $l;
	}
?>

<?php if (empty($log_set)): ?>
	<div class="alert">No log found</div>
<?php endif ?>

<?php foreach ($log_set as $o => $org): ?>
	<?php foreach ($org as $d => $dep): ?>
		<div class="navbar">
			<div class="navbar-inner">
				<span class="brand"><?php echo $o.":: ".$d; ?></span>
			</div>
		</div>
		<table id="table-grid" width="100%">
			<thead>
				<tr>
					<th width="50">S.N</th>
					<th>Designation</th>
					<th>Join Date</th>
					<th>Leave Date</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($dep as $l => $log): ?>
				<tr>
					<td><?php echo ++$l; ?></td>
					<td><?php echo $log->deg_name; ?></td>
					<td><?php echo $log->join_date; ?></td>
					<td><?php echo $log->leave_date; ?></td>
					<td><?php echo $log->remarks; ?></td>
				</tr>
			<?php endforeach ?> <!-- dep close -->
			</tbody>
		</table>
	<?php endforeach ?> <!-- org close -->
<?php endforeach ?> <!-- eqp_item_code_set close-->
