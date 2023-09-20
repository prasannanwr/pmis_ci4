<?php
	$form_attributes = array(
		'id' => 'deg-del-form',
		'class' => 'form-horizontal'
	);

	$input_emp_name = array(
		'id' => 'emp_name',
		'name' => 'emp_name',
		'value' => $user_info->first_name. ' '. $user_info->last_name,
		'class' => 'input-block-level input-xlarge',
		'disabled' => 'disabled'
	);


	$input_leave_date = array(
		'id' => 'leave_date',
		'name' => 'leave_date',
		'value' => '',
		'class' => 'input-block-level input-xlarge',
		'data-date-format' => 'yyyy-mm-dd'
	);

	$input_remarks = array(
		'id' => 'remarks',
		'name' => 'remarks',
		'value' => '',
		'class' => 'input-block-level input-xlarge',
		'rows' => '3'
	);

	$btn_submit = array(
		'id' => 'btn_submit',
		'name' => 'btn_submit',
		'value' => 'submit',
		'type' => 'submit',
		'content' => 'Submit',
		'class' => 'btn btn-primary'
	);
?>

<?php echo form_open('employee_designation/del_up_deg', $form_attributes) ?>
	<?php if (validation_errors() != ""): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>

	<div class="control-group">
		<label class="control-label" for="emp_name">Employee Name:</label>
		<div class="controls">
			<?php echo form_input($input_emp_name); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="leave_date">Leave Date:</label>
		<div class="controls">
			<?php echo form_input($input_leave_date); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="remarks">Remarks:</label>
		<div class="controls">
			<?php echo form_textarea($input_remarks); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php echo form_button($btn_submit); ?>
		<?php echo anchor('employee/view/'.$emp_id, 'Cancel', array('class' => 'btn')); ?>
	</div>

	<?php
		echo form_hidden('emp_id', $emp_id);
		echo form_hidden('delete_id', $delete_id);
	?>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('[autofocus]:not(:focus)').eq(0).focus();
		 $('#leave_date').datepicker();
		
	    $('#deg-del-form').validate(
	    	{
			    rules:
			    {
				    leave_date:
				    {
					    required: true
				    },
				    remarks:
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