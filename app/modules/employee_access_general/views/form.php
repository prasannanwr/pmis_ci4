<?php

	$form_attributes = array(
		'id' => 'access-form',
		'class' => 'form-horizontal'
	);

	$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);


	if (isset($emp_dep_info))
	{
		$user_dprts = array();
		foreach ($emp_dep_info as $key => $d)
		{
			$user_dprts[] = $d['dep_id'];
		}
	}

	if (isset($department_info))
	{
		$dept_set = array('' => '');
		foreach($department_info as $key => $dept)
		{
			if (in_array($dept['id'], $user_dprts))
			{
				$dept_set[$dept['org_name']][$dept['id']] = $dept['name'];
			}
		}
	}
?>

<div class="navbar">
	<div class="navbar-inner">
		<span class="brand">Employee: <?php echo $emp_info->first_name.' '.$emp_info->last_name.' ('.$emp_info->username.')' ?></span>
	</div>
</div>
<div class="well">

<?php echo form_open('employee_access/submit', $form_attributes); ?>

<?php if ($dep_id == FALSE): ?>


	<div class="control-group">
		<label class="control-label" for="dep_id">Department:</label>
		<div class="controls">
		<?php echo form_dropdown('dep_id', $dept_set, '', 'id="dep_id" class="input-block-level input-xlarge"'); ?>
		</div>
	</div>
	
<?php else: ?>
	

<?php if (check_access(array('access_view'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Access</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="acc_all" name="access[]" id="acc_all" class="check_boxes"> All
		</label>
		<?php if (check_access(array('access_org'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_org" name="access[]" id="access_org" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_org'); ?>>Org
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_dep'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_dep" name="access[]" id="access_dep" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_dep'); ?>>Dept
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_emp'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_emp" name="access[]" id="access_emp" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_emp'); ?>>Employee
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_eqp'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_eqp" name="access[]" id="access_eqp" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_eqp'); ?>>Equipment
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_chkst'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_chkst" name="access[]" id="access_chkst" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_chkst'); ?>>Checksheet
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_assign_eqp'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_assign_eqp" name="access[]" id="access_assign_eqp" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_assign_eqp'); ?>>Assign Equipment
		</label>
		<?php endif ?>
		<?php if (check_access(array('access_assign_deg'))): ?>
		<label class="checkbox inline">
			<input type="checkbox" value="access_assign_deg" name="access[]" id="access_assign_deg" class="check_boxes" <?php echo is_checked($emp_access_info, 'access_assign_deg'); ?>>Assign Designation
		</label>
		<?php endif ?>
	</div>
</div>
<?php endif ?>

<?php if (check_access(array('access_org'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Organization</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="org_add" name="access_org[]" id="org_add" class="check_boxes" <?php echo is_checked($emp_access_info, 'org_add'); ?>>Add
		</label>

		<label class="checkbox inline">
			<input type="checkbox" value="org_edit" name="access_org[]" id="org_edit" class="check_boxes" <?php echo is_checked($emp_access_info, 'org_edit'); ?>>Edit
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="org_delete" name="access_org[]" id="org_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'org_delete'); ?>>Delete
		</label>
	</div>
</div>
<?php endif ?>

<?php if (check_access(array('access_dep'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Department</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="dep_add" name="access_dep[]" id="dep_add" class="check_boxes" <?php echo is_checked($emp_access_info, 'dep_add'); ?>>Add
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="dep_edit" name="access_dep[]" id="dep_edit" class="check_boxes" <?php echo is_checked($emp_access_info, 'dep_edit'); ?>>Edit
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="dep_delete" name="access_dep[]" id="dep_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'dep_delete'); ?>>Delete
		</label>
	</div>
</div>
<?php endif ?>
<?php if (check_access(array('access_emp'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Employee</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="emp_add" name="access_emp[]" id="emp_add" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_add'); ?>>Add
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="emp_edit" name="access_emp[]" id="emp_edit" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_edit'); ?>>Edit
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="emp_delete" name="access_emp[]" id="emp_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_delete'); ?>>Delete
		</label>
	</div>
</div>
<?php endif ?>
<?php if (check_access(array('access_eqp'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Equipment</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="eqp_add" name="access_eqp[]" id="eqp_add" class="check_boxes" <?php echo is_checked($emp_access_info, 'eqp_add'); ?>>Add
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="eqp_edit" name="access_eqp[]" id="eqp_edit" class="check_boxes" <?php echo is_checked($emp_access_info, 'eqp_edit'); ?>>Edit
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="eqp_delete" name="access_eqp[]" id="eqp_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'eqp_delete'); ?>>Delete
		</label>
	</div>
</div>
<?php endif ?>
<?php if (check_access(array('access_chkst'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>CheckSheet</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="chkst_add" name="access_chkst[]" id="chkst_add" class="check_boxes" <?php echo is_checked($emp_access_info, 'chkst_add'); ?>>Add
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="chkst_edit" name="access_chkst[]" id="chkst_edit" class="check_boxes" <?php echo is_checked($emp_access_info, 'chkst_edit'); ?>>Edit
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="chkst_delete" name="access_chkst[]" id="chkst_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'chkst_delete'); ?>>Delete
		</label>
	</div>
</div>
<?php endif ?>
<?php if (check_access(array('access_assign_eqp'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Assign equipment</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="emp_eqp_assign" name="access_emp_eqp[]" id="emp_eqp_assign" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_eqp_assign'); ?>>Assign
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="emp_eqp_delete" name="access_emp_eqp[]" id="emp_eqp_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_eqp_delete'); ?>>UnAssign
		</label>
	</div>
</div>
<?php endif ?>
<?php if (check_access(array('access_assign_deg'))): ?>
<div class="control-group check_boxes">
	<label class="check_boxes control-label"><strong>Assign Designation</strong></label>
	<div class="controls">
		<label class="checkbox inline">
			<input type="checkbox" value="emp_deg_assign" name="access_emp_deg[]" id="emp_deg_assign" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_deg_assign'); ?>>Assign
		</label>
		<label class="checkbox inline">
			<input type="checkbox" value="emp_deg_delete" name="access_emp_deg[]" id="emp_deg_delete" class="check_boxes" <?php echo is_checked($emp_access_info, 'emp_deg_delete'); ?>>UnAssign
		</label>
	</div>
</div>
<?php endif ?>

<?php
	echo form_hidden('user_id',$emp_id);
	echo form_hidden('dep_id', $dep_id);
	echo form_hidden('org_id', $org_id);
	echo form_hidden('type', $type);
?>

<div class="form-actions">
		<?php echo form_button($btn_submit); ?>
		<?php echo anchor('employee_access', 'Cancel', array('class' => 'btn')); ?>
</div>

<?php endif ?>

<?php echo form_close(); ?>
</div>

<script>

$('#dep_id').change(function(){
	var did = $(this).val();
	window.location = '<?php echo current_url(); ?>'+'/'+did;
});

$('input[name=access\\[\\]]').on('click', function(){

	if($(this).val() == 'acc_all')
	{
		if($(this).is(':checked'))
		{
			$('input[name=access\\[\\]]').prop('checked', true);
		}
		else
		{
			$('input[name=access\\[\\]]').prop('checked', false);	
		}
	}
	else
	{
		if($(this).is(':checked'))
		{
			//$('input[name=access\\[\\]]').prop('checked', true);
			if($('#access_org').is(':checked') && $('#access_dep').is(':checked') && 
				$('#access_emp').is(':checked') && $('#access_eqp').is(':checked') && 
				$('#access_chkst').is(':checked') && $('#access_assign_eqp').is(':checked') && 
				$('#access_assign_deg').is(':checked'))
			{
				$('#acc_all').prop('checked', true);
			}
		}
		else
		{
			$('#acc_all').prop('checked', false);
		}
	}
});

if($('#access_org').is(':checked') && $('#access_dep').is(':checked') && 
	$('#access_emp').is(':checked') && $('#access_eqp').is(':checked') && 
	$('#access_chkst').is(':checked') && $('#access_assign_eqp').is(':checked') && 
	$('#access_assign_deg').is(':checked'))
{
	$('#acc_all').prop('checked', true);
}

</script>