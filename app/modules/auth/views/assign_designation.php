<?php
$form_attributes = array(
		'id' => 'emp-deg-form',
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

if (isset($logged_emp_dep_info))
{
	$logged_user_dprts = array();
	if ($this->session->userdata('user_id') == 1)
	{
		$indx = 'id';
	}
	else
	{
		$indx = 'dep_id';
	}
	foreach ($logged_emp_dep_info as $key => $d)
	{
		$logged_user_dprts[] = $d[$indx];
	}
}

$dept_common = array_intersect($user_dprts, $logged_user_dprts);

$dept_set = array('' => '');
foreach ($department_info as $key => $dept)
{
	if ($this->session->userdata('user_id') == 1)
	{
		$dept_set[$dept['org_name']][$dept['id']] = $dept['name'];
	}
	else if (in_array($dept['id'], $dept_common) AND check_access(array('emp_deg_assign'), $dept['id']))
	{
		$dept_set[$dept['org_name']][$dept['id']] = $dept['name'];
	}
}

$deg_set = 	array('' => '');
foreach ($designation_info as $key => $deg)
{
	$deg_set[$deg['id']] = $deg['name'];
}

$managers_set = 	array('' => '', '-1' => '--- Head ---');
foreach($managers as $key => $mngr)
{
	$managers_set[$mngr['id']] = $mngr['first_name']. ' '. $mngr['last_name'];
}

$input_name = array(
		'id' => 'emp_name',
		'name' => 'emp_name',
		'value' => $user_info->first_name.' '.$user_info->last_name,
		'class' => 'input-block-level input-xlarge',
		'disabled' => 'disabled'
	);

$input_join_date = array(
		'id' => 'join_date',
		'name' => 'join_date',
		'value' => '',
		'class' => 'input-block-level input-xlarge',
		'data-date-format' => 'yyyy-mm-dd'
	);
?>

<?php echo form_open('employee_designation/assign', $form_attributes); ?>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="emp_name">Employee:</label>
			<div class="controls">
				<?php echo form_input($input_name); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="dep_id">Department:</label>
			<div class="controls">
				<?php echo form_dropdown('dep_id', $dept_set, '', 'id="dep_id" class="input-block-level input-xlarge" autofocus'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="deg_id">Designation:</label>
			<div class="controls">
				<?php echo form_dropdown('deg_id', $deg_set, '', 'id="deg_id" class="input-block-level input-xlarge"'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="mgr_id">Manager:</label>
			<div class="controls">
				<?php echo form_dropdown('mgr_id', $managers_set, '', 'id="mgr_id" class="input-block-level input-xlarge"'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="join_date">Join Date:</label>
			<div class="controls">
				<?php echo form_input($input_join_date); ?>
			</div>
		</div>
		<div class="form-actions">
			<?php echo form_button($btn_submit); ?>
			<?php echo anchor('employee/view/'.$emp_id, 'Cancel', array('class' => 'btn')); ?>
		</div>
		<?php echo form_hidden('emp_id', $emp_id); ?>
</fieldset>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('[autofocus]:not(:focus)').eq(0).focus();
		
		$('#join_date').datepicker();

	    $('#emp-deg-form').validate(
	    	{
			    rules:
			    {
				    dep_id:
				    {
					    required: true
				    },
				    deg_id:
				    {
				    	required: true
				    },
				    mgr_id:
				    {
				    	required: true
				    },
				    join_date:
				    {
				    	required: true
				    }
			    },
			    highlight: function(element)
			    {
			    	$(element).closest('.control-group').removeClass('success').addClass('error');
			    },
			    success: function(element)
			    {
			    	element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
			    }
		});
	});
</script>