<table id="table-grid">
<thead>
	<tr>
		<th width="50">S.N</th>
		<th>Organization</th>
		<th>Department</th>
		<th>Designation</th>
		<?php if ($type != 'profile'): ?>
		<th width="125">Action</th>
		<?php endif ?>
	</tr>
</thead>
<tbody>
	<?php $i = 1; foreach ($designation_info as $deg):  ?>
    
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $deg->org_name ?></td>
			<td><?php echo $deg->dep_name ?></td>
			<td><?php echo $deg->deg_name ?></td>
			<?php if ($type != 'profile'): ?>
			<td>
			<?php if ($deg->status == 0): ?>
				<span>Deleted</span>
			<?php else: ?>
				<?php if (check_access(array('emp_deg_delete'))): ?>
				<i class="icon-trash"></i><?php echo anchor('employee_designation/delete/'.$emp_id.'/'.$deg->id, 'Delete', 'class="del-emp-deg"'); echo anchor('employee_designation/leave/'.$emp_id.'/'.$deg->id, 'Leave', 'class="del-emp-deg"') ; ?>
				<?php endif ?>

			<?php endif ?>
			</td>	
			<?php endif ?>
		</tr>
	<?php endforeach ?>
</tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
	    $('.del-emp-deg').click(function(e){
	    	var link = this.href;
	    	e.preventDefault();
	    	bootbox.confirm('<p class="alert alert-error">Are you sure?</p>', function(result){
	    		if(result) {
	    			window.location = link;
	    		}
	    	});
	    });
	});
</script>