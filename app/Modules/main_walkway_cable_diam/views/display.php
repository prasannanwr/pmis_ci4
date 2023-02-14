<table id="table-grid">
<thead>
	<tr>
		<th width="50">S.N</th>
		<th>Name</th>
		<th>Description</th>
	</tr>
</thead>
<tbody>
	<?php $i = 1; foreach ($check_sheet as $chk): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $chk->name; ?></td>
			<td><?php echo $chk->description; ?></td>
		</tr>
	<?php endforeach ?>
</tbody>
</table>