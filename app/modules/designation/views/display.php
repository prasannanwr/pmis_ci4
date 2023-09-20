<p><?php echo anchor('/designation/create', '<button type="button" class="btn btn-small"><i class="icon-plus"></i> Add Designation</button>'); ?></p>

<table id="table-grid">
<thead>
	<tr>
		<th width="50">S.N</th>
		<th>Name</th>
		<th width="125">Action</th>
	</tr>
</thead>
<tbody>
	<?php $i = 1; foreach ($designation as $deg): ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $deg->name ?></td>
			<td>
				<i class="icon-edit"></i><?php echo anchor('/designation/create/'.$deg->id, 'Edit') ?> / 
				<i class="icon-trash"></i><?php echo anchor('/designation/delete/'.$deg->id, 'Delete', 'class="del-deg"') ?>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
	    $('.del-deg').click(function(e){
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
