<table id="table-grid">
<thead>
	<tr>
		<th width="50">S.N</th>
		<th>Cable Number Type Code</th>
		<th>Type Number</th>
		<th>Description</th>
	</tr>
</thead>
<tbody>
	<?php $i = 1; foreach ($check_sheet as $chk): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $chk->cab01mcnww_type_code; ?></td>
			<td><?php echo $chk->cab01mcnww_type_number; ?></td>
			<td><?php echo $chk->cab01description; ?></td>
		</tr>
	<?php endforeach ?>
</tbody>
</table>