<?php
$search_frm_attr = array('method' => 'get', 'class' => 'navbar-search form-search');
$q_box = array(
		'id' => 'q',
		'name' => 'q',
		'placeholder' => $q,
		'class' => 'search-query'
	);
?>
<div class="navbar">
	<div class="navbar-inner">
	    <?php echo form_open('employee_access/index', $search_frm_attr); ?>
		    <div class="input-append">
				<?php echo form_input($q_box); ?>
				<button type="submit" class="btn">Search</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php if (empty($users)): ?>
<?php if ($q != 'Employee'): ?>
<div id="infoMessage" class="alert alert-info">No employee found.</div>
<?php endif ?>
<?php else: ?>
<table id="table-grid">
	<tr>
		<th width="50">S.N</th>
		<th>Name</th>
	</tr>
	<?php $i=1; foreach ($users as $user):?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td>
				<?php echo anchor('employee_access/view/'.$user->id, $user->first_name.' '.$user->last_name); ?>
			</td>
		</tr>
	<?php endforeach;?>
</table>

<?php endif ?>